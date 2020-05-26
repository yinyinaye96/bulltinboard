@extends('layouts.app')
@section('content')
  <div class="create-post my-5">
    <h2>{{ __('Create Post') }}</h2>
    <form class="mt-3" action="{{ route('postconfirm') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
        <p class="form-txt">{{ __('Post Title') }}</p>
        <div class="form-input">
         <input type="text" name="title" id="title" value="{{ old('title') }}"  class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" >
          @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('title') }}</strong>
            </span>
          @endif
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{ __('Post Description') }}</p>
        <div class="form-input">
          <textarea name="description" id="description" cols="30" rows="10" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"></textarea>
          @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('description') }}</strong>
            </span>
          @endif
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <div class="col-sm-10 text-center">
          <button type="submit" class="btn btn-primary">{{ __('Comfirm') }}</button>
          <button type="reset" class="btn btn-default" onclick="resetForm();">{{ __('Clear') }}</button>
        </div>
      </div>
    </form>
  </div>
@endsection