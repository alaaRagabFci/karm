<?php

namespace App\Services;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\UserAddress;

class UserAddressService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listUserAddreses($userId)
    {
        return UserAddress::where('the_user_id', $userId)->get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($userAddresses)
    {
        $tableData = Datatables::of($userAddresses)
            ->addColumn('region', function (UserAddress $address){
                return $address->getRegion->name;
            })
            ->addColumn('actions', function ($data)
            {
                return view('user-addresses.actionBtns')->with('controller','user-addresses')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'region'])->make(true);

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
    public function createUserAddress($parameters)
    {
        try {
            $user = new UserAddress();
            $user->create($parameters);
            return response(array('msg' => 'Entity created'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity already exist'), 404);
        }
    }


    /**
     * Get User.
     * @param $userAddressId
     * @return User
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getUserAddress($userAddressId)
    {
        try {
            $user = UserAddress::findOrFail($userAddressId);
            return $user;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'User address not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $username
     * @return User
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateUserAddress($parameters, $userAddressId)
    {
        try {
            $user = UserAddress::findOrFail($userAddressId);
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
    public function deleteUserAddress($userAddressId)
    {
        return UserAddress::find($userAddressId)->delete();
    }
}
