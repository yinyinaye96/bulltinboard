@extends('layouts.app')
@section('content')
  <div class="create-user create-post my-5">
    <h2>{{__('Create User')}}</h2>
    <form id="myForm" method="post" action="{{ url('userconfirm') }}" class="mt-3" enctype="multipart/form-data">
    @csrf
      <div class="form-group row">
        <label for="name" class="form-txt">{{ __('Name') }}</label>
        <div class="form-input">
          <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
          @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <label for="email" class="form-txt">{{ __('Email Address') }}</label>
        <div class="form-input">
          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
          @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <label for="password" class="form-txt">{{ __('Password') }}</label>
        <div class="form-input">
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" autofocus>
          @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <label for="confirm-password" class="form-txt">{{ __('Comfirm Password') }}</label>
        <div class="form-input">
          <input id="confirm-password" type="password" class="form-control{{ $errors->has('confirm-password') ? ' is-invalid' : '' }}" name="confirm-password" value="{{ old('confirm-password') }}" autofocus>
          @if ($errors->has('confirm-password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('confirm-password') }}</strong>
            </span>
          @endif
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <label for="type" class="form-txt">{{ __('Type') }}</label>
        <div class="form-input">
          <select name="type" id="type">
            <option value="0"  {{ old('type') == 0 ? 'selected' : '' }}>Admin</option>
            <option value="1"  {{ old('type') == 1 ? 'selected' : '' }}>User</option>
          </select>
          @if ($errors->has('type'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @endif
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <label for="phone" class="form-txt">{{ __('Phone') }}</label>
        <div class="form-input">
          <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" autofocus>
          @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('phone') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label for="dob" class="form-txt">{{ __('Date Of Birth') }}</label>
        <div class="form-input">
          <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" autofocus>
          @if ($errors->has('dob'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('dob') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label for="address" class="form-txt">{{ __('Address') }}</label>
        <div class="form-input">
          <textarea class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" cols="30" rows="10" name="address"></textarea>
          @if ($errors->has('address'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('address') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row">
        <label for="profile" class="form-txt">{{ __('Profile') }}</label>
        <div class="form-input preview">
          <input id="profile" type="file" class="profile form-control @error('profile') is-invalid @enderror" name="profile" autocomplete="profile" />
          @if ($errors->has('profile'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('profile') }}</strong>
          </span>
          @endif
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <div class="col-sm-10 text-center">
          <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
          <button type="reset" class="btn btn-default reset-btn" onclick="resetForm();">{{ __('Clear') }}</button>
        </div>
      </div>
    </form>
  </div>
  <style>
    .preview img {
      margin-top:10px;
      width:200px;
      height:150px;
    }
  </style>
  <script>
    $("#profile").change(function(e) {
      for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
        var file = e.originalEvent.srcElement.files[i];
        var img = document.createElement("img");
        var reader = new FileReader();
        reader.onloadend = function() {
          img.src = reader.result;
        }
        reader.readAsDataURL(file);
        $("#profile").after(img);
      }
    });
  </script>
@endsection
