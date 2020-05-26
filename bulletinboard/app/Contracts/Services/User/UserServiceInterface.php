<?php

namespace App\Contracts\Services\User;

interface UserServicesInterface
{
    public function userconfirm($request);

    public function storeUser($request);

    public function showUser($user);

    public function searchUser($request);

    public function destroy($id);

    public function updateconfirmUser($request);

    public function userUpdate($request);

}


?>