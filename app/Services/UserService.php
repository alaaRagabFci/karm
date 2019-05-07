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
            ->addColumn('addresses', function (TheUser $user){
                if(count($user->getAddresses) > 0 )
                    return '<a href="user-addresses/'.$user->id.'"> <span class="label label-sm label-primary"> عرض العناوين </span></a>';
                else
                    return '<a href="user-addresses/'.$user->id.'"> <span class="label label-sm label-success"> اضافة عناوين </span></a>';
            })
            ->addColumn('orders', function (TheUser $user){
                if(count($user->getOrders) > 0 )
                    return '<button type="button" class="user-orders Btn btn btn-primary btn-xs" data-id="'.$user->id.'">عرض التفاصيل</button>';
                else
                    return '<span class="label label-sm label-success"> لا يوجد طلبات </span>';
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','users')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'is_blocked', 'is_active', 'addresses', 'orders'])->make(true);

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

            if(TheUser::where('username', $parameters['username'])->first())
                return \Response::json(['msg'=>'أسم المستخدم موجود بالفعل'],404);

            if(TheUser::where('phone', $parameters['phone'])->first())
                return \Response::json(['msg'=>'رقم الجوال موجود بالفعل'],404);

            $user = new TheUser();
            $user->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
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

            if(TheUser::where('username', $parameters['username'])->where('id', '!=', $userId)->first())
                return \Response::json(['msg'=>'أسم المستخدم موجود بالفعل'],404);

            if(TheUser::where('phone', $parameters['phone'])->where('id', '!=', $userId)->first())
                return \Response::json(['msg'=>'رقم الجوال موجود بالفعل'],404);

            $user->update($parameters);
            return \Response::json(['msg'=>'تم التحديث بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
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
