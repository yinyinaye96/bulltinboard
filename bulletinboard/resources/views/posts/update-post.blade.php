@extends('layouts.app')
@section('content')
  <div class="update-post create-post my-5">
    <h2>{{__('Update Post')}}</h2>
    <form class="mt-3" action="{{ url('posts/updateconfirm') }}" method="post" >
      @csrf
      <input type="hidden" name="id" value="{{ $post->id }}">
      <div class="form-group row">
        <p class="form-txt">{{__('Title')}}</p>
        <div class="form-input">
         <input type="text" name="title" id="title" value="{{ $post->title }}">
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Description')}}</p>
        <div class="form-input">
          <textarea name="description" id="description" cols="30" rows="10">{{ $post->description }}</textarea>
        </div>
        <label class="label">*</label>
      </div>
      <div class="form-group row">
        <p class="form-txt">{{__('Status')}}</p>
        <input value="1" name="status" class="custom-control-input" id="customSwitches" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive" {{ $post->status == 1 ? 'checked' : '' }} >
      </div>
      <div class="form-group row">
        <div class="col-sm-10 text-center">
          <button type="submit" class="btn btn-primary">{{__('Comfirm')}}</button>
          <button type="reset" class="btn btn-default" onclick="resetForm();">{{__('Clear')}}</button>
        </div>
      </div>
    </form>
  </div>
@endsection