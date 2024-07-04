@extends('auth')

@section('content')
    <div class="edit center" style="margin-top: 0; width: 100%">
        <div>
            <img src="{{ url('assets/img/logo512.png') }}" alt="user" height="100">
        </div>
        <form action="{{ route('register.new') }}" method="post" enctype="multipart/form-data">
            @csrf
            @includeIf('components.core.input', [
                'name' => 'username',
                'holder' => 'user name',
            ])
            @includeIf('components.core.input', [
                'name' => 'email',
                'holder' => 'email',
            ])
            @includeIf('components.core.input', [
                'name' => 'password',
                'holder' => 'password',
                'type' => 'password',
            ])
            <div class="center">
                <button type="submit" class="btn">
                    Register
                </button>
                <a href="{{ route('login.social') }}?type=google" class="border rounded"
                    style="padding: 5px 20px; width: 100%;">
                    <div style="display: flex; justify-content: space-evenly; padding-block: var(--space)">
                        <img src="{{ url('assets/icon/google.png') }}" alt="user" height="24">
                        <span> continue with google</span>
                    </div>
                </a>
                <p>
                    If you already have an acount you can login <a href="{{ route('login') }}"
                        style="color: var(--color-red)">here</a>
                </p>
            </div>
        </form>
    </div>
@endsection
