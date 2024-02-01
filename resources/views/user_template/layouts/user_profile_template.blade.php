@extends('user_template.layouts.template')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="box_main">
                    <ul>
                        <li><a href="{{ route('user_profile') }}">Dashboard</a></li>
                        <li><a href="{{ route('pending_orders') }}">Pending orders</a></li>
                        <li><a href="{{ route('history') }}">History</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_main">@yield('profile_content')</div>
            </div>
        </div>
    </div>
@endsection
