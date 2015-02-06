@extends('layouts.admin')

@section('heading')
User Detail <small> {{$user->firstname or $user->email}}</small>
@stop

@section('breadcrumb')
@parent
<li><a href="{{ route('admin.users.index')}}"><i class="fa fa-user"></i> User</a></li>
<li>Detail</li>
@stop



@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
    <div class="box box-primary">
      
        <!-- form start -->
    <div class="row">        
         <div class="col-md-8">
            <div class="box-body">
				<table class="table table-bordered">
					<tbody>						
					<tr>
						<th>First Mame</th>
						<td>{{ucfirst($user->firstname)}}</td>
					</tr>
					<tr>
						<th>Last Name</th>
						<td>{{ucfirst($user->lastname)}}</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>{{$user->email}}</td>
					</tr>

					<tr>
						<th>Address</th>
						<td>{{$user->address}}</td>
					</tr>
					<tr>
						<th>Date of birth</th>
						<td>{{date('F d, Y', strtotime($user->dob))}}</td>
					</tr>
					<tr>
						<th>Gander</th>
						<td>{{($user->gender==1) ? 'Male' : 'Female'; }}</td>
					</tr>
					<tr>
						<th>Status</th>
						<td>{{($user->activated == "true") ? 'Activated': 'Deactivated'}}</td>
					</tr>
					<tr>
						<th>Role</th>
						<td>{{ucfirst($user->role)}}</td>
					</tr>

					@if($user->role=='admin')
					<tr>
						<th>Capability</th>
						<td>{{ucfirst($user->capability)}}</td>
					</tr>
					@endif
					
					@if($user->social!='')
					<tr>
						<th>Social</th>
						<td>{{$user->social}}</td>
					</tr>
					@endif

					@if($user->avatar!='')
					<tr>
						<th>Avatar</th>
						<td>{{$user->avatar}}</td>
					</tr>
					@endif

					<tr>
						<th>Join Date</th>
						<td>{{date('F d, Y \a\t h:i A', strtotime($user->created_at))}}</td>
					</tr>
					<tr>
						<th>Last updated</th>
						<td>{{date('F d, Y  \a\t h:i A', strtotime($user->updated_at))}}</td>

					</tr>
					<tr>
						<th>Bio</th>
						<td>{{$user->bio or ""}}</td>
					</tr>
					
					</tbody>
				</table>

           </div>

        </div>
    </div>

    </div><!-- /.box -->

    </div><!--/.col (right) -->
</div>


@stop