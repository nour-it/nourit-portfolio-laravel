@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
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
                @includeIf('components.core.input', [
                    'name' => 'username',
                    'holder' => 'user name',
                    'value' => $user->username,
                ])
                @includeIf('components.core.input', [
                    'name' => 'email',
                    'holder' => 'email',
                    'value' => $user->email,
                ])
                @includeIf('components.core.text-editor', ['name' => 'bio', 'value' => $user->bio])
                @includeIf('components.core.text-editor', ['name' => 'about', 'value' => $user->about])

            </form>
            <form action="" method="post">
                <h2>Danger Zone</h2>
                <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                    Delete Account
                </button>
            </form>
        </div>
        <div class="edit">
            <form action="{{ route('profile.update', ['profile' => $user->id]) }}" method="post">
                @csrf @method('PUT')
                <h2>Reset Password</h2>
                @includeIf('components.core.input', [
                    'name' => 'password',
                    'holder' => 'New Password',
                ])
                @includeIf('components.core.input', [
                    'name' => 'confirmation',
                    'holder' => 'Confirmation password',
                ])
                <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                    Update
                </button>
            </form>
            <div class="social">
                <form action="" method="post" class="">
                    <h2>Socials</h2>
                    <table>
                        <tbody>
                            @foreach ($socials as $social)
                                <tr>
                                    <td>icon</td>
                                    <td>
                                        @includeIf('components.core.input', [
                                            'name' => 'social_' . $social->id,
                                            'holder' => $social->name,
                                        ])
                                    </td>
                                    <td>
                                        @includeIf('components.core.select', [
                                            'options' => $types,
                                            'label' => 'type_id',
                                            'value' => '',
                                            'field' => 'name',
                                        ])
                                    </td>
                                    <td>on/off</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
