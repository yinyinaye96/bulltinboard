@extends('layouts.app')
@section('content')
<div class="create-user create-user-comfirm create-post my-5">
  <h2>{{__('Create User Comfirm')}}</h2>
  <form class="mt-3" method="post" action="{{ url('storeuser') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
      <p class="form-txt">{{ __('Name')}}</p>
      <div class="form-input">
        <label for="name">{{$user->name}}</label>
        <input type="hidden" name="name" id="name" value="{{$user->name}}">
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{ __('Email Address')}}</p>
      <div class="form-input">
        <label for="email">{{$user->email}}</label>
        <input type="hidden" name="email" id="email" value="{{$user->email}}">
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{ __('Password')}}</p>
      <div class="form-input">
        <input type="password" name="password" value="{{$user->password}}" class="pwd-hide" disabled>
        <input type="hidden" name="password" id="password" value="{{$user->password}}">
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{ __('Type')}}</p>
      <div class="form-input">
        @if($user->type == 1)
        <label for="type">User</label>
        @else
        <label for="type">Admin</label>
        @endif
        <input type="hidden" name="type" value="{{$user->type}}">
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{ __('Phone')}}</p>
      <div class="form-input">
        <label for="phone">{{$user->phone}}</label>
        <input type="hidden" name="phone" id="phone" value="{{$user->phone}}">
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{ __('Date Of Birth')}}</p>
      <div class="form-input">
        <label for="dob">{{$user->dob}}</label>
        <input type="hidden" name="dob" id="dob" value="{{$user->dob}}">
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{ __('Address')}}</p>
      <div class="form-input">
        <label for="address">{{$user->address}}</label>
        <input type="hidden" name="address" value="{{$user->address}}">
      </div>
    </div>
    <div class="form-group from-profile">
      <img id="output" src="/img/upload/{{ $user->profile }}" alt="image" width="100" heigth="100">
      <input type="hidden" name="profile" value="{{$user->profile}}">
    </div>
    <div class="form-group row">
      <div class="col-sm-10 text-center">
        <button type="submit" class="btn btn-primary">{{ __('Create')}}</button>
        <a href="{{ route('createuser')}}" class="btn btn-default">{{__('Cancel')}}</a>
      </div>
    </div>
  </form>
</div>
@endsection