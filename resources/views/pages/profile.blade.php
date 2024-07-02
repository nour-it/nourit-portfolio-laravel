@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.$header")
    @else
        @includeIf('components.admin-header')
    @endisset
@endsection

@section('content')
    <main style="padding-top: calc(var(--space) * 1.5); display: flex; gap: calc(var(--space) * 4)">
        <div class="edit">
            <form action="{{ route('profile.update', ['profile' => $user->id]) }}" method="post">
                @csrf @method('PUT')
                <div style="display: flex; justify-content: space-between">
                    <h2>Personnal Information</h2>
                    <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                        Update
                    </button>
                </div>
                @includeIf('components.input', [
                    'name' => 'username',
                    'holder' => 'user name',
                    'value' => $user->username,
                ])
                @includeIf('components.input', [
                    'name' => 'email',
                    'holder' => 'email',
                    'value' => $user->email,
                ])
                @includeIf('components.text-editor', ['name' => 'bio', 'value' => $user->bio])
                @includeIf('components.text-editor', ['name' => 'about', 'value' => $user->about])

            </form>
            <h2>Danger Zone</h2>
            <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                Delete Account
            </button>
        </div>
        <div class="edit">
            <form action="{{ route('profile.update', ['profile' => $user->id]) }}" method="post">
                @csrf @method('PUT')
                <h2>Reset Password</h2>
                @includeIf('components.input', [
                    'name' => 'password',
                    'holder' => 'New Password',
                ])
                @includeIf('components.input', [
                    'name' => 'confirmation',
                    'holder' => 'Confirmation password',
                ])
                <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                    Update
                </button>
            </form>
        </div>
    </main>
@endsection
