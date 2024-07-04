@extends('auth')

@section('content')
    <div class="edit center" style="margin-top: 0; width: 100%">
        <div>
            <img src="{{ url('assets/img/logo512.png') }}" alt="user" height="100">
        </div>
        <form action="{{ route('login.attempt') }}" method="post" enctype="multipart/form-data">
            @csrf
            @includeIf('components.core.input', [
                'name' => 'email',
                'holder' => 'user name or email',
            ])
            @includeIf('components.core.input', [
                'name' => 'password',
                'holder' => 'password',
                'type' => 'password',
            ])
            <div class="center">
                <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                    Login
                </button>
                <a href="{{ route('login.social') }}?type=google" class="border rounded"
                    style="padding: 5px 20px; width: 100%;">
                    <div style="display: flex; justify-content: space-evenly; padding-block: var(--space)">
                        <img src="{{ url('assets/icon/google.png') }}" alt="user" height="24">
                        <span> continue with google</span>
                    </div>
                </a>
                <p>
                    If you have an acount you can create one <a href="{{ route('register') }}"
                        style="color: var(--color-red)">here</a>
                </p>
            </div>
        </form>
    </div>
@endsection
