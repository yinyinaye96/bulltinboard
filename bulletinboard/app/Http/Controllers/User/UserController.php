<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Contracts\Services\User\UserServicesInterface;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserConfirmRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\UserUpdateComfirmRequest;
use App\Http\Requests\ChangePassword;
use Illuminate\Support\Facades\Hash;

/**
 * SystemName : bulletinboard
 * ModuleName : User
 */

class UserController extends Controller
{
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserServicesInterface $userService
     */
    public function __construct(UserServicesInterface $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }
    /**
     * Show Create User Form
     *
     * @return void
     */
    public function createUser(Request $request)
    {
        return view('users.create-user');
    }

    /**
     *Create User Confirm Function
     *
     * @param UserConfirmRequest $request
     * @return void
     */
    public function userconfirm(UserConfirmRequest $request)
    {
        $validator = $request->validated();
        $user = $this->userService->userconfirm($request);
        return view('users.create-user-comfirm', compact('user'));
    }

    /**
     * Store User Function
     *
     * @param EmailRequest $request
     * @return void
     */
    public function storeUser(EmailRequest $request)
    {
        session()->forget([
            'name',
            'email',
            'password',
            'type',
            'phone',
            'dob',
            'address'
        ]);
        $validator = $request->validated();
        $user = $this->userService->storeUser($request);
        return redirect('userlist');
    }
    /**
     * Show User List
     *
     * @return void
     */
    public function showUser()
    {
        session()->forget([
            'name',
            'email',
            'fromDate',
            'toDate'

        ]);
        $user = new User;
        $user = $this->userService->showUser($user);
        return view('users.user-list', compact('user'));
    }

    /**
     * Search User Function
     *
     * @param Request $request
     * @return void
     */
    public function searchUser(Request $request)
    {
        $user = $this->userService->searchUser($request);
        return view('users.user-list', compact('user'));
    }

    /**
     * Soft Delete User Function
     *
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->deleted_user_id = auth()->user()->id;
        $user->save();
        $this->userService->destroy($id);
        return redirect('userlist');
    }

    /**
     * Show User Profile Funaction
     *
     * @return void
     */
    public function profile()
    {
        return view('users.user-profile');
    }

    /**
     * Show User Update Funaction
     *
     * @return void
     */
    public function updateUser()
    {
        return view('users.update-user');
    }

    /**
     *Create Update User Confirm Function
     *
     * @param UserUpdateComfirmRequest $request
     * @return void
     */
    public function updateconfirmUser(UserUpdateComfirmRequest $request)
    {
        $user = $this->userService->updateconfirmUser($request);
        return view('users.update-user-comfirm', compact('user'));
    }

    /**
     *Create Update User Function
     *
     * @param Request $request
     * @return void
     */
    public function userUpdate(Request $request)
    {
        $user = $this->userService->userUpdate($request);
        return redirect('userlist');
    }

    /**
     *Show User Password 
     *
     * @return void
     */
    public function password()
    {
        return view('users.change-password');
    }

    /**
     *Create Change Password Function
     *
     * @param ChangePassword $request
     * @return void
     */
    public function changePassword(ChangePassword $request)
    {
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        return redirect('updateuser');
    }
}
