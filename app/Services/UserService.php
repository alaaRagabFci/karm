<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\User;

class UserService
{
    public function __construct(){
    }

    /**
     * Get User.
     * @param $userId
     * @return User
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getUser($settingId)
    {
        try {
            $user = User::findOrFail($settingId);
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
    public function updateUser($userId, $parameters)
    {
        try {
            $user = User::findOrFail($userId);

            $user->update($parameters);
            return array('status' => 'true', 'message' => 'User updated');
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'User not found');
        }
    }

}
