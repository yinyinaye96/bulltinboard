<?php

namespace App\Service\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServicesInterface;
use App\Models\User;
use Auth;
use Hash;

/**
 * SystemName : bulletinboard
 * ModuleName : User
*/class UserService implements UserServicesInterface
{
    private $UserDao;

    /**
    * Class Constructor
    * @param UserDaoInterface $UserDao
    * @return
    */
    public function __construct(UserDaoInterface $UserDao)
    {
        $this->UserDao = $UserDao;
    }
    
    /**
     *Create  User Confirm Function
     * @param $request
     * @return void
    */
    public function UserConfirm($request)
    {
        session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => $request->type,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'address' => $request->address
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $profile = $request->file('profile');
        $profileImage = $profile -> getClientOriginalName();
        $path = public_path('/img/upload');
        $profile -> move($path, $profileImage);
        $user->profile = $profileImage;
        return $user;
    }

    /**
     * Store User Function
     *
     * @param $request
     * @return void
    */
    public function storeUser($request) 
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $password = $request->input('password');
        $hash = bcrypt($password);
        $user->password = $hash;
        $user->profile = $request->profile;
        $user->type = $request->type;
        $user->phone = $request->input('phone');
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->create_user_id = Auth::user()->id;
        $user->updated_user_id = Auth::user()->id;
        $user->created_at = now();
        $user->updated_at = now();
        return $this->UserDao->storeUser($user);
    }

    /**
     * Show User List
     *
     * @param $user
     * @return void
    */
    public function showUser($user) 
    {
        return $this->UserDao->showUser($user);
    }

    /**
     * Search User Function
     *
     * @param $request
     * @return void
    */
    public function searchUser($request)
    {
        return $this->UserDao->searchUser($request);
    }

    /**
     * Soft Delete User Function
     *
     * @param $id
     * @return void
    */
    public function destroy($id)
    {
        return $this->UserDao->destroy($id);
    }

    /**
     *Create Update User Confirm Function
     *
     * @param $request
     * @return void
    */
    public function updateconfirmUser($request)
    {
        $user = User::find($request->id);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $profile = $request->file('profile');
        $profileImage = $profile -> getClientOriginalName();
        $path = public_path('/img/upload');
        $profile->move($path, $profileImage);
        $user->profile = $profileImage;
        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        return $user;
    }

    /**
     *Create Update User Function
     *
     * @param $request
     * @return void
    */
    public function userUpdate($request)
    {
        return $this->UserDao->userUpdate($request);
    }
}




















?>