@section('head')
    @include('layouts.partials.head')
@show


@section('sidebar')
    @include('layouts.partials.sidebar')
@show

    <section class="content-header">
        <h1> @yield('heading')</h1>
        <ol class="breadcrumb">
            @section('breadcrumb')
                <li><a href="{{ route('cms.index')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            @show
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @yield('content')                    
    </section><!-- /.content -->

@section('footer')
    @include('layouts.partials.footer')
@show