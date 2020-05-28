<?php

namespace App\Contracts\Services\User;

interface UserServicesInterface
{
    /**
     *Create  User Confirm Function
     * @param $request
     * @return void
    */
    public function userconfirm($request);

    /**
     * Store User Function
     *
     * @param $request
     * @return void
    */
    public function storeUser($request);

    /**
     * Show User List
     *
     * @param $user
     * @return void
    */
    public function showUser($user);

    /**
     * Search User Function
     *
     * @param $request
     * @return void
    */
    public function searchUser($request);

    /**
     * Soft Delete User Function
     *
     * @param $id
     * @return void
    */
    public function destroy($id);

     /**
     *Create Update User Confirm Function
     *
     * @param $request
     * @return void
    */
    public function updateconfirmUser($request);

    /**
     *Create Update User Function
     *
     * @param $request
     * @return void
    */
    public function userUpdate($request);

}
