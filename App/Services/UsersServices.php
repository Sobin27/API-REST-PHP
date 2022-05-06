<?php

namespace App\Services;

use App\Models\User;

class UsersServices
{
    public function get($id = null)
    {
        if ($id) {
            return User::getUser($id);
        } else {
            return User::getUsersALL();
        }
    }

    public function post()
    {
        $infos = $_POST;
        return User::Insert($infos);
    }
}
