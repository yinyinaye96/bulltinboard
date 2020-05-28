@extends('layouts.app')
@section('content')
  <div class="create-user create-user-comfirm create-post my-5">
    <h2>{{__('Update User Comfirm')}}</h2>
    <form class="mt-3" action="/userupdate" method="post" enctype="multipart/form-data">
    @csrf
      <div class="form-group row">
        <p class="form-txt">{{__('Name')}}</p>
        <div class="form-input">
          <input type="hidden" name="name" id="name" value="{{ $user->name }}">
          <p>{{ $user->name }}</p>
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Email Address')}}</p>
        <div class="form-input">
          <input type="hidden" name="email" id="email" value="{{ $user->email }}">
          <p>{{ $user->email }}</p>
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Type')}}</p>
        <div class="form-input">
          <input type="hidden" name="type" value="{{ $user->type }}">
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
          <input type="hidden" name="phone" id="phone" value="{{ $user->phone }}">
          <p>{{ $user->phone }}</p>
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Date Of Birth')}}</p>
        <div class="form-input">
          <input type="hidden" name="dob" id="dateofbirth" value="{{ $user->dob }}">
          <p>{{ $user->dob }}</p>
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Address')}}</p>
        <div class="form-input">
          <input type="hidden" name="address" value="{{ $user->address }}">
          <p>{{ $user->address }}</p>
        </div>
      </div>
      <div class="form-group from-profile">
        <input type="hidden" name="profile" value="{{ $user->profile }}">
        <img src="/img/upload/{{ $user->profile }}" alt="default" alt="default" />
      </div>
      <input type="hidden" name="id" value = "{{ Auth::user()->id }}">
      <div class="form-group row">
        <div class="col-sm-10 text-center">
          <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
          <button type="button" class="btn btn-default"><a href="/updateuser">{{__('Cancel')}}</a></button>
        </div>
      </div>
    </form>
  </div>
@endsection