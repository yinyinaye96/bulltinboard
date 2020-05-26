@extends('layouts.app')
@section('content')
<div class="user-profile create-user my-5">
    <h2>{{__('User Profile')}}</h2>
    <form class="mt-3" method="get" action="/updateuser" enctype="multipart/form-data">
    @csrf
      <div class="form-group row">
        <p class="form-txt">{{__('Name')}}</p>
        <div class="form-input">
         <input type="hidden" name="name" id="name" value="{{ Auth::user()->name }}">
         <p>{{ Auth::user()->name }}</p>
         <img id="output" src="img/upload/{{ Auth::user()->profile }}" alt="default" />
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Email Address')}}</p>
        <div class="form-input">
          <input type="hidden" name="email" id="email" value="{{ Auth::user()->email }}">
          <p>{{ Auth::user()->email }}</p>
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Type')}}</p>
        <div class="form-input">
          <input type="hidden" name="type" value="{{ Auth::user()->type }}">
          @if(Auth::user()->type == '0')
          <p>Admin</p>
          @elseif(Auth::user()->type == '1')
          <p>User</p>
          @else
          <p>Vistor</p>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Phone')}}</p>
        <div class="form-input">
          <input type="hidden" name="phone" id="phone" value="{{ Auth::user()->phone }}">
          <p>{{ Auth::user()->phone }}</p>
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Date Of Birth')}}</p>
        <div class="form-input">
          <input type="hidden" name="dob" id="dateofbirth" value="{{ Auth::user()->dob}}">
          <p>{{ Auth::user()->dob }}</p>
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Address')}}</p>
        <div class="form-input">
          <input type="hidden" name="address" value="{{ Auth::user()->address }}">
          <p>{{ Auth::user()->address }}</p>
        </div>
      </div>
      <div class="profile-edit">
        <a href="/updateuser" class="btn btn-primary">{{__('Edit')}}</a>
      </div>
    </form>
  </div>
@endsection