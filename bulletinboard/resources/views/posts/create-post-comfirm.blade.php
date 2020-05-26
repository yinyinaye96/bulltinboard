@extends('layouts.app')
@section('content')
<div class="create-post-comfirm my-5">
  <h2>{{ __('Create Post Comfirm') }}</h2>
  <div class="mt-3">
    <form class="mt-3" action="{{ route('storepost') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
        <p class="form-txt">{{ __('Post Title') }}</p>
        <div class="form-input">
          <p>{{$post->title}}</p>
          <input type="hidden" name="title" id="title" value="{{$post->title}}">
        </div>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{ __('Post Description') }}</p>
        <div class="form-input">
          <p>{{$post->description}}</p>
          <input type="hidden" name="description" id="description" value="{{$post->description}}">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10 text-center">
          <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
          <button type="button" class="btn btn-default">
            <a href="{{ route('createpost') }}">{{ __('Cancel') }}</a>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection