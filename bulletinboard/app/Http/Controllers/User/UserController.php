<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Contracts\Services\User\UserServicesInterface;
use Illuminate\Support\Facades\DB;
use App\Services\User\UserService;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use App\Http\Requests\UserConfirmRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\UserUpdateComfirmRequest;
use App\Http\Requests\ChangePassword;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Auth;
use Image;

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
    
    public function createUser()
    {
        return view('users.create-user');
    }

    /**
     * User Create Confirm Function
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
     * User Create Confirm Function
     *
     * @param EmailRequest $request
     * @return void
    */
    public function storeUser(EmailRequest $request) 
    {
        $validator = $request->validated();
        $user = $this->userService->storeUser($request);
        return redirect('userlist');
    }
    
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

    public function searchUser(Request $request) 
    {
        
        $user = $this->userService->searchUser($request);
        return view('users.user-list',compact('user'));
    }

    public function destroy($id) 
    {
        $user = User::find($id);
        $user->deleted_user_id = Auth::user()->id;
        $user->save();
        $this->userService->destroy($id);
        return redirect('userlist');
    }

    public function profile()
    {
        return view('users.user-profile');
    }

    public function updateUser()
    {
        return view('users.update-user');
    }

    /**
     * User Create Confirm Function
     *
     * @param UserUpdateComfirmRequest $request
     * @return void
    */
    public function updateconfirmUser(UserUpdateComfirmRequest $request)
    {
        $user = $this->userService->updateconfirmUser($request);
        return view('users.update-user-comfirm', compact('user'));
    }

    public function userUpdate(Request $request)
    {
        $user = $this->userService->userUpdate($request);
        return redirect('userlist');
    }

    public function password()
    {
        return view('users.change-password');
    }

    /**
     * User Create Confirm Function
     *
     * @param UserUpdateComfirmRequest $request
     * @return void
    */
    public function changePassword(ChangePassword $request)
    {
        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect('updateuser');
    }

}

