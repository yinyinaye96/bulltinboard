@extends('layouts.app')
@section('content')
  <div class="change-password create-user my-5">
    <h2>{{__('Change Password')}}</h2>
    <form method="POST" action="{{ route('password-change') }}" class="mt-5">
    @csrf 
      <div class="form-group row">
        <p class="form-txt">{{__('Old Password')}}</p>
        <div class="form-password">
          <input type="password" name="current_password" value="">
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('New Password')}}</p>
        <div class="form-password">
          <input type="password" name="new_password">
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('omfirm New Password')}}</p>
        <div class="form-password">
          <input type="password" name="new_confirm_password">
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">{{__('Change')}}</button>
          <button type="submit" class="btn btn-default">{{__('Clear')}}</button>
        </div>
      </div>
    </form>
  </div>
@endsection