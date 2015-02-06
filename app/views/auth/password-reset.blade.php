    {{ Form::open(['url' => '/auth/password/reset', 'method' => 'POST']) }}

        {{ Form::hidden('token', $token) }}

        {{ Form::password('password', array('placeholder' => 'Password')) }}

        {{ Form::password('password_confirmation', array('placeholder' => 'Confirm password')) }}

        {{ Form::submit('Reset') }}

    {{ Form::close() }}

