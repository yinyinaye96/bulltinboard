@extends('layouts.app')
@section('content')
<div class="update-post create-post my-5">
  <h2>{{__('Update Post')}}</h2>
  <form class="mt-3" action="{{route('updatepost')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="form-group row">
      <p class="form-txt">{{__('Title')}}</p>
      <div class="form-input">
        <input type="hidden" name="title" id="title" value="{{ $post->title }}">
        <p>{{ $post->title }}</p>
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{__('Description')}}</p>
      <div class="form-input">
        <input type="hidden" name="description" id="description" value="{{ $post->description }}">
        <p>{{ $post->description }}</p>
      </div>
    </div>
    <div class="form-group row">
      <p class="form-txt">{{__('Status')}}</p>
      <input type="checkbox" data-toggle="toggle" data-on="active" data-off="inactive" name="status" value="1" class="custom-control-input" id="customSwitches" @if(old('status', $post->status)=='1' ) {{"checked"}} @endif>
    </div>
    <input type="hidden" name="id" value="{{ $post->id }}">
    <div class="form-group row">
      <div class="col-sm-10 text-center">
        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
        <button type="button" class="btn btn-default"><a href="/posts/postlist">{{__('Cancel')}}</a></button>
      </div>
    </div>
  </form>
</div>
@endsection