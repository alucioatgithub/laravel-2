@extends('layouts.admin')


@section('heading')
Manage User
@stop


@section('breadcrumb')
@parent
<li><a href="{{ route('admin.users.index')}}"><i class="fa fa-user"></i> User</a></li>
@stop


@section('content')

@if (Session::has('message'))
    <div class="alert alert-info">{{{ Session::get('message') }}}</div>
@endif

<style type="text/css">
.btn-left{
float: left;
margin-right: 7px;
}
</style>

<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                   
                                    <div class="box-tools">
                                         
                                     <a style="float:right" href="{{route('admin.users.create')}}" class="btn btn-info btn-sm btn-left " data-toggle="tooltip" title="Create new user"><i class="fa fa-plus fa-white"></i> Add user</a>
                                      
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover table-striped">
                                      <thead>
                                      <tr>
                                           
                                            <th>User ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)                                      
                                        <tr>
                                          
                                                <td>{{ $user->userid or ''  }}</td>
                                                <td>{{ $user->firstname or ''  }}</td>
                                                <td>{{ $user->lastname or ''  }}</td>
                                                <td>{{ $user->email or ''  }}</td>
                                                <td>{{ $user->address or ''  }}</td>
                                                <td>{{ $user->role or ''  }}</td>
                                                <td>
                                                    @if($user->activated=='true')
                                                    <a href="{{route('admin.users.deactivate', array($user->userid))}}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Click here to deactivate">Activate</a>
                                                    @else
                                                    <a href="{{route('admin.users.activate', array($user->userid))}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Click here to activate">Deactivate</a>
                                                    @endif
                                                <td>
                                     

                                                <div class="box-tools" data-toggle="btn-toggle">
                                                    <a href="{{route('admin.users.show', array($user->userid))}}" class="btn btn-info btn-sm btn-left " data-toggle="tooltip" title="View User detail"><i class="fa fa-eye"></i></a>

                                                    <a href="{{route('admin.users.edit', array($user->userid))}}" class="btn btn-info btn-sm btn-left " data-toggle="tooltip" title="Edit User"><i class="fa fa-edit"></i></a>
                                                     {{Form::open(array('url' => 'admin/users/'.$user->userid, 'method' => 'DELETE')) }}
                                                        {{ Form::button('<i class="fa fa-trash-o"></i>', array( 'data-toggle'=> 'tooltip',  'title'=> 'Delete User', 'class' => 'btn btn-danger btn-sm',  'onclick' => 'if(confirm("Are you sure you want to delete this user?")) this.form.submit(); else return false;')) }}
                                                    {{Form::close()}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

 
@stop