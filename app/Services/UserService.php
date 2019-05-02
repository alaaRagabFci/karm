<?php

namespace App\Services;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\TheUser;

class UserService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listUsers()
    {
        return TheUser::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($users)
    {
        $tableData = Datatables::of($users)
            ->addColumn('is_active', function (TheUser $user){
                if($user->is_active)
                    return '<span class="label label-sm label-primary"> مفعل </span>';
                else
                    return '<span class="label label-sm label-warning"> غير مفعل </span>';
            })
            ->addColumn('is_blocked', function (TheUser $user){
                if($user->is_blocked)
                    return '<span class="label label-sm label-warning"> محظور </span>';
                else
                    return '<span class="label label-sm label-primary"> غير محظور </span>';
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','users')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'is_blocked', 'is_active'])->make(true);

        return $tableData ;
    }

    /**
     * Create client.
     * @param $clientId
     * @param $title_ar
     * @param $title_en
     * @param $description_ar
     * @param $description_en
     * @param $icon
     * @param $page
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function createUser($parameters)
    {
        try {
            $token = $this->generateUserToken($parameters);
            $parameters['token'] = $token["token"];
            $user = new TheUser();
            $user->create($parameters);
            return response(array('msg' => 'Entity created'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity already exist'), 404);
        }
    }

    public function generateUserToken($data) {
        $encrypted = base64_encode(sha1($data['username'] . $data['phone'] . time(), true));
        $encrypted = str_replace("/","",$encrypted);
        $hash = array("token" => $encrypted);
        return $hash;
    }

    /**
     * Get User.
     * @param $userId
     * @return User
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getUser($userId)
    {
        try {
            $user = TheUser::findOrFail($userId);
            return $user;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'User not found');
        }
    }

    /**
     * Get admin info.
     * @param $userId
     * @return User
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getAdmin($userId)
    {
        try {
            $user = User::findOrFail($userId);
            return $user;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'User not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $username
     * @return User
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateUser($parameters, $userId)
    {
        try {
            $user = TheUser::findOrFail($userId);
            $user->update($parameters);
            return array('status' => 'true', 'message' => 'User updated');
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'User not found');
        }
    }

    /**
     * Delete client.
     * @param $clientId
     * @return Client
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteUser($userId)
    {
        return TheUser::find($userId)->delete();
    }
}
