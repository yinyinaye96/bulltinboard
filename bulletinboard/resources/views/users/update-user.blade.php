@extends('layouts.app')
@section('content')
<div class="create-user create-user-comfirm create-post my-5">
  <h2>{{__('Update User')}}</h2>
  <form class="mt-3" method="post" action="/updateconfirm" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
      <p class="form-txt">{{__('Name')}}</p>
      <div class="form-input">
        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}">
        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
      </div>
      <label class="label">*</label>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{__('Email Address')}}</p>
      <div class="form-input">
        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}">
        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>
      <label class="label">*</label>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{__('Type')}}</p>
      <div class="form-input">
        <select name="type" id="type">
          <option value="0" {{ old('type') == 0 ? 'selected' : '' }}>Admin</option>
          <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>User</option>
          <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Vistor</option>
        </select>
      </div>
      <label class="label">*</label>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{__('Phone')}}</p>
      <div class="form-input">
        <input type="tel" name="phone" id="phone" value="{{ Auth::user()->phone }}">
        @if ($errors->has('phone'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('phone') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{__('Date Of Birth')}}</p>
      <div class="form-input">
        <input type="date" name="dob" id="dateofbirth" value="{{ Auth::user()->dob }}">
        @if ($errors->has('dob'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('dob') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{__('Address')}}</p>
      <div class="form-input">
        <textarea name="address" id="" cols="30" rows="10"> {{ Auth::user()->address }}</textarea>
        @if ($errors->has('address'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('address') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{__('Profile')}}</p>
      <div class="form-input preview">
        <input id="profile" type="file" class="profile form-control @error('profile') is-invalid @enderror" name="profile" required autocomplete="profile" />
        @error('profile')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <label class="label">*</label>
    </div>
    <div class="form-group from-profile">
      <img id="output" src="img/upload/{{ Auth::user()->profile }}" alt="default" />
    </div>
    <div class="form-group row">
      <a href="{{ route('password-change') }}">{{__('Change Password')}}</a>
    </div>
    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
    <div class="form-group row">
      <div class="col-sm-10 text-center">
        <button type="submit" class="btn btn-primary">{{__('Comfirm')}}</button>
        <button type="reset" class="btn btn-default" onclick="resetForm();">{{__('Clear')}}</button>
      </div>
    </div>
  </form>
</div>
<style>
  .preview img {
    margin-top: 10px;
    width: 200px;
    height: 150px;
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