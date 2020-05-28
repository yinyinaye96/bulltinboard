<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{

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
     *Create Update User Function
     *
     * @param $request
     * @return void
     */
    public function userUpdate($request);
}
