@extends('layouts.main')

@section('content')

    <h3>My data</h3>

    {{ Form::open(array('method' => 'PUT')) }}
        <p>{{ Form::text('firstname', $user['firstname'], array('placeholder' => 'Firstname')) }}</p>
        <p>{{ Form::text('lastname', $user['lastname'], array('placeholder' => 'Lastname')) }}</p>
        <p>{{ Form::text('dob', $user['dob'], array('placeholder' => 'Date of birth')) }}</p>

        <p>{{ Form::select('gender', array('male' => 'Male', 'female' => 'Female', 'other' => 'Orther'),  $user['gender'], array('placeholder' => 'Gender')) }}</p>

        <p>{{ Form::text('address', $user['address'], array('placeholder' => 'Where are you')) }}</p>

        <p>{{ Form::text('email', $user['email'], array('placeholder' => 'Email')) }}</p>
        <p>{{ Form::password('password', null, array('placeholder' => 'Password')) }}</p>
        <p>{{ Form::submit('Update')  }}</p>
    {{ Form::close()  }}

    <h3>My Accounts</h3>
    <ul>
        @if ($user['social'])
            @foreach ($user['social'] as $name => $social)
                <li>{{ $name }}</li>
            @endforeach
        @endif
    </ul>

    {{ HTML::link('/auth/assign/linkedin', 'click here') }} to add a LinkedIn profile to your account <br />
    {{ HTML::link('/auth/assign/facebook', 'click here') }} to add a Facebook profile to your account <br />
    {{ HTML::link('/auth/assign/google', 'click here') }} to add a Google profile to your account <br />
    {{ HTML::link('/auth/assign/twitter', 'click here') }} to add a Twitter profile to your account <br />

@stop