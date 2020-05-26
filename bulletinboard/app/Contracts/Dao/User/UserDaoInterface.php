<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{

    public function storeUser($request);

    public function showUser($user);

    public function searchUser($request);

    public function destroy($id);

    public function userUpdate($request);



}





































?>