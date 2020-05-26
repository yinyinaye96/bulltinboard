<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use DB;
use Auth;
// use Carbon\Carbon;

class UserDao implements UserDaoInterface
{
    public function storeUser($user)
    {
        $store_user = new User ([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'profile' => $user->profile,
            'type' => $user->type,
            'phone' => $user->phone,
            'dob' => $user->dob,
            'address' => $user->address,
            'create_user_id' => $user->create_user_id,
            'updated_user_id' => $user->updated_user_id,
        ]);
        $store_user -> save();
        return back();
    }

    public function showUser($user)
    {
        $user = new User;
        $user = User::with('users')->paginate(10);
        return $user;
    }

    public function searchUser($request)
    {
        session([
            'name' => $request->name,
            'email' => $request->email,
            'fromDate' => $request->fromDate,
            'toDate' => $request->toDate

        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $from = $request->input('fromDate');
        $to = $request->input('toDate');
        if(empty($from) && empty($to))
        {
            $user = User::where ('name', 'LIKE', '%' . $name . '%' )
            ->where ('email', 'LIKE', '%' . $email . '%' )
            ->orderby('id', 'ASC')
            ->paginate(10);
        }
        else 
        {
            $user = User::whereBetween('created_at', [$from." 00:00:00",$to." 23:59:59"])
            ->orderby('id', 'ASC')
            ->paginate(10);
        }
        return $user;


    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return back();
    }

    public function userUpdate($request)
    {
        $user = new User();
        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        $user->phone = $request->input('phone');
        $user->dob = $request->input('dob');
        $user->address = $request->input('address');
        $user->profile = $request->input('profile');
        $user->updated_user_id = Auth::user()->id;
        $user->updated_at = now();
        $user->save();
        return back();
    }

}




















?>