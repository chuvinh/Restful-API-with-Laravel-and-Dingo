<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function find($id) : User
    {
        return User::findOrFail($id);
    }

    public function create(array $data) : User
    {
        $user = new User();

        return $this->update($user, $data);
    }

    public function delete(User $user)
    {
        return $user->delete();
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Update the given data to the user model
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data) : User
    {
        if(isset($data['password']))
        {
            $user->password = $data['password'];
        }

        if(isset($data['name']))
        {
            $user->name = $data['name'];
        }

        if(isset($data['email']))
        {
            $user->email = $data['email'];
        }

        $user->save();
        return $user;
    }
}
