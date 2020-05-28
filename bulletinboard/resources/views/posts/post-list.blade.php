@extends('layouts.app')
@section('content')
<div class="post-list table-responsive my-5">
  <h2>{{ __('Posts List')}}</h2>
  <div class="my-3">
    <form class="search-form" action="{{ route('postlist') }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="text" placeholder="Search.." name="search" value="{{old('search', session('search'))}}">
      <button type="submit" class="btn btn-primary">{{ __('Search')}}</button>
      @if (Auth::user())
      <button type="button" class="btn btn-primary">
        <a href="{{ route('createpost') }}" class="color-white">{{ __('Add')}}</a>
      </button>
      <button type="button" class="btn btn-primary">
        <a href="{{ url('posts/uploadpost') }}" class="color-white">{{ __('Upload')}}</a>
      </button>
      @endif
      <button type="button" class="btn btn-primary">
        <a href="{{ route('download') }}" class="color-white">{{ __('Download')}}</a>
      </button>
    </form>
  </div>
  <table class="table table-bordered">
    <tr>
      <th>{{ __('Post Title')}}</th>
      <th>{{ __('Post Description')}}</th>
      <th>{{ __('Post Users')}}</th>
      <th>{{ __('Post Date')}}</th>
      @if (Auth::user())
      <th colspan="2" class="text-center">{{ __('Action')}}</th>
      @endif
    </tr>
    @if($postdata->count())
    @foreach($postdata as $post)
    <tr>
      <td><a href="#" data-toggle="modal" data-target="#Modal-{{ $post->id }}">{{ $post->title }}</a></td>
      <td>{{ $post->description }}</td>
      @if($post->users)
      <td>{{ $post->users->name }}</td>
      @else
      <td>-</td>
      @endif
      <td>04/20/2020</td>
      @if (Auth::user())
      <td><a href="/posts/editpost/{{ $post->id }}" class="btn btn-primary">Edit</a></td>
      <td><a href="#" data-toggle="modal" data-target="#detete-{{ $post->id }}" class="btn btn-danger">Delete</a></td>
      @endif
    </tr>
    @endforeach
    @endif
  </table>
  <div aria-label="Page navigation example" class="page-paginate">
    {{ $postdata->appends(request()->except('page'))->links() }}
  </div>
  <!-- Modal -->
  @foreach($postdata as $post)
  <div class="modal fade" id="Modal-{{ $post->id }}" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h2>{{ __('Post Detail')}}</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <ul class="user-detail">
            <li><span>Title:</span>{{ $post->title }}</li>
            <li><span>Deacription:</span>{{ $post->description }}</li>
            <li><span>Status:</span>
              @if( $post->status == 1)
              Active
              @else
              Inactive
              @endif
            </li>
            <li><span>Create Date:</span>{{ $post->created_at->format('Y/m/d') }}</li>
            @if($post->users)
            <li><span>Create User:</span>{{ $post->users->name }}</li>
            @endif
            <li><span>Update Date:</span>{{ $post->updated_at->format('Y/m/d') }}</li>
            @if($post->updateUsers)
            <li><span>Update User:</span>{{ $post->updateUsers->name }}</li>
            @endif
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @foreach($postdata as $post)
  <div class="modal fade" id="detete-{{ $post->id }}" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <p>Delete Post</p>
          <p>Delete at : {{ now()->format('h:m:s') }} </p>
          @if(Auth::user())
          <p>Deleted User ID : {{ Auth::user()->id}} </p>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
          <a href="delete/{{ $post->id }}" class="btn btn-danger">Yes</a>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection