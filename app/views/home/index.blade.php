@extends('layouts.main')

@section('content')
    <p>
        <h3>Basic</h3>
        {{ HTML::link('/auth/basic/login', 'Login') }}
        {{ HTML::link('/auth/basic/register', 'Register') }}
        {{ HTML::link('/auth/password/remind', 'Reset password') }}
    </p>

    <p>
        <h3>Social</h3>
        by {{ HTML::link('/auth/facebook/login', 'Facebook') }} <br />
        by {{ HTML::link('/auth/google/login', 'Google+') }} <br />
        by {{ HTML::link('/auth/twitter/login', 'Twitter') }} <br />
        by {{ HTML::link('/auth/linkedin/login', 'LinkedIn') }} <br />
    </p>
@stop