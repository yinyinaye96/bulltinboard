@extends('layouts.app')
@section('content')
  <div class="upload-csv my-5">
    <h2>{{__('Upload CSV File')}}</h2>
    <div class="upload-file mt-5">
      <p>{{__('Import File From:')}}</p>
      <div class="border upload-inner">
        <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file">
          @if($errors->has('file'))
            <span class="help-block">
              <strong>{{ $errors->first('file') }}</strong>
            </span>
          @endif
          @if (session('duplicate'))
            <div class="alert alert-danger">
                {{ session('duplicate') }}
            </div>
          @endif
          <div class="text-center">
            <button type="submit" class="btn btn-primary">{{__('Import File')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
