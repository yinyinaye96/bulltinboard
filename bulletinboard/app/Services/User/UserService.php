<?php

namespace App\Service\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServicesInterface;
use App\Models\User;
use Auth;
use Hash;

class UserService implements UserServicesInterface
{
    private $UserDao;

    /**
    * Class Constructor
    * @param OperatorUserDaoInterface
    * @return
    */
    public function __construct(UserDaoInterface $UserDao)
    {
        $this->UserDao = $UserDao;
    }
    
    /**
     * User Create Confirm
     * @param UserRequest $request
     * @return void
    */

    public function UserConfirm($request)
    {
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
     * @param EmailRequest $request
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

    public function showUser($user) 
    {
        return $this->UserDao->showUser($user);
    }

    public function searchUser($request)
    {
        return $this->UserDao->searchUser($request);
    }

    public function destroy($id)
    {
        return $this->UserDao->destroy($id);
    }

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

    public function userUpdate($request)
    {
        return $this->UserDao->userUpdate($request);
    }
}




















?>