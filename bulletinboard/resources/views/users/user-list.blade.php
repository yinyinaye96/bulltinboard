@extends('layouts.app')
@section('content')
<div class="user-list table-responsive my-5">
  <h2>{{__('Userlist List')}}</h2>
  <div class="my-3">
    <form class="search-form" method="post" action="{{ url('userlist') }}" enctype="multipart/form-data">
      @csrf
      <input type="text" placeholder="Name" name="name" id="search" value="{{old('name', session('name'))}}">
      <input type="text" placeholder="Email" name="email" value="{{old('email', session('email'))}}">
      <input type="date" placeholder="Created To" name="fromDate" value="{{old('fromDate', session('fromDate'))}}" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
      <input type="date" placeholder="Created From" name="toDate" value="{{old('toDate', session('toDate'))}}" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">
      <button type="submit" class="btn btn-primary">{{__('Search')}}</button>
      @if (Auth::user()->type == '0')
      <a href="{{ url('createuser') }}" class="btn btn-primary color-white">{{__('Add')}}</a>
      @endif
    </form>
  </div>
  <table class="table table-bordered mt-3">
    <tr>
      <th>{{__('Name')}}</th>
      <th>{{__('Email')}}</th>
      <th>{{__('Created User')}}</th>
      <th>{{__('Phone')}}</th>
      <th>{{__('Address')}}</th>
      <th>{{__('Birth Of Date')}}</th>
      <th>{{__('Created Date')}}</th>
      <th>{{__('Updated Date')}}</th>
      <th>{{__('Action')}}</th>
    </tr>
    @if($user->count())
    @foreach($user as $item)
    <tr>
      <td><a href="#" data-toggle="modal" data-target="#Modal-{{ $item->id }}">{{ $item->name }}</a></td>
      <td>{{ $item->email }}</td>
      @if($item->users)
      <td>{{ $item->users->name }}</td>
      @else
      <td>-</td>
      @endif
      <td>{{ $item->phone }}</td>
      <td>{{ $item->address }}</td>
      <td>{{ $item->dob }}</td>
      <td>{{ $item->created_at->format('Y-m-d') }}</td>
      <td>{{ $item->updated_at->format('Y-m-d') }}</td>
      <td><a href="#" class="btn btn-danger" data-toggle="modal" data-target="#detete-{{ $item->id }}">{{__('Delete')}}</a></td>
    </tr>
    @endforeach
    @else
    <div class="alert alert-danger">{{__('No record found.')}}
      <a href="userlist" class="close" aria-label="close">x</a>
    </div>
    @endif
  </table>
  <div aria-label="Page navigation example" class="page-paginate">
    {{ $user->appends(Request::except('page'))->links() }}
  </div>
  <!-- Modal -->
  @foreach($user as $item)
  <div class="modal fade" id="Modal-{{ $item->id }}" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h2>User Detail</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <ul class="user-detail">
            <li><span>Name:</span>{{ $item->name }}</li>
            <li><span>Email Address:</span>{{ $item->email }}</li>
            <li>
              <span>Type:</span>
              @if($item->type == 1)
              User
              @else
              Admin
              @endif
            </li>
            <li><span>Phone:</span>{{ $item->phone }}</li>
            <li><span>Date Of Birth:</span>{{ $item->dob }}</li>
            <li><span>Address:</span>{{ $item->address }}</li>
            <li><span>Create Date:</span>{{ $item->created_at->format('Y-m-d') }}</li>
            @if($item->users)
            <li><span>Create User:</span>{{ $item->users->name }}</li>
            @endif
            <li><span>Update Date:</span>{{ $item->updated_at->format('Y-m-d') }}</li>
            @if($item->updateUsers)
            <li><span>Upadte User:</span>{{ $item->updateUsers->name }}</li>
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
  @foreach($user as $item)
  <div class="modal fade" id="detete-{{ $item->id }}" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <p>Delete User</p>
          <p>Delete at : {{ now()->format('h:m:s A e') }} </p>
          <p>Deleted User ID : {{ Auth::user()->id}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
          <a href="delete/{{ $item->id }}" class="btn btn-danger">Yes</a>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection