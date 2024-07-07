@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
    @endisset
@endsection

@section('content')
    <main style="padding-top: calc(var(--space) * 1.5); display: flex; gap: calc(var(--space) * 4); flex-direction: column">
        <form action="{{ route('profile.update', ['profile' => $user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="edit">
                <div style="display: flex; justify-content: space-between">
                    <h2>Personnal Information</h2>
                </div>
                <div>
                    @includeIf('components.core.input', [
                        'name' => 'profile',
                        'holder' => 'user name',
                        'type' => 'file',
                        'class' => '',
                    ])
                    @foreach ($user->images as $image)
                        @if ($image->category->first()->name == 'Profile')
                            @includeIf('components.core.img', ['src' => url($image->path), 'alt' => 'user'])
                            @includeIf('components.core.input', [
                                'name' => 'profile_id',
                                'holder' => 'user name',
                                'type' => 'hidden',
                                'class' => '',
                                'value' => $image->id,
                            ])
                        @endif
                    @endforeach
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
                @includeIf('components.core.input', [
                    'name' => 'post',
                    'holder' => 'role',
                    'value' => $user->post,
                ])
                @includeIf('components.core.text-editor', ['name' => 'bio', 'value' => $user->bio])
                <div>
                    @includeIf('components.core.input', [
                        'name' => 'about_img',
                        'holder' => 'about',
                        'type' => 'file',
                        'class' => '',
                    ])
                    @foreach ($user->images as $image)
                        @if ($image->category->first()->name == 'About')
                            @includeIf('components.core.img', ['src' => url($image->path), 'alt' => 'user'])
                            @includeIf('components.core.input', [
                                'name' => 'about_id',
                                'holder' => 'user name',
                                'type' => 'hidden',
                                'class' => '',
                                'value' => $image->id,
                            ])
                        @endif
                    @endforeach
                </div>
                @includeIf('components.core.text-editor', ['name' => 'about', 'value' => $user->about])
            </div>
            <div class="edit">
                <h2>Reset Password</h2>
                @includeIf('components.core.input', [
                    'name' => 'password',
                    'holder' => 'New Password',
                    'type' => 'password',
                ])
                @includeIf('components.core.input', [
                    'name' => 'confirmation',
                    'holder' => 'Confirmation password',
                    'type' => 'password',
                ])
                <div class="resume">
                    <h2>Resumes</h2>
                    @includeIf('components.core.input', [
                        'name' => 'resume',
                        'holder' => 'user name',
                        'type' => 'file',
                        'class' => '',
                        'multiple' => true,
                    ])
                    <ul>
                        @foreach ($user->resume as $resume)
                            <li>
                                {{ $resume->path }}
                                <input type="radio" name="resume_id" id="resume_id" value="{{ $resume->id }}"
                                    @if (!$resume->remove_at) checked @endif>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="social">
                    <input type="hidden" name="social_count" id="social_count" value="{{ $socials->count() }}">
                    <h2>Socials</h2>
                    <table>
                        <tbody>
                            @foreach ($socials as $social)
                                @php
                                    $link = $user->link->where('social_id', $social->id)->first();
                                    $category = $link?->category->first();
                                @endphp
                                <tr>
                                    <td><img src="{{ url($social->images[0]->path) }}" alt="" height="24"
                                            width="24" /></td>
                                    <td>
                                        @includeIf('components.core.input', [
                                            'name' => 'social_' . $social->id,
                                            'holder' => $social->name,
                                            'value' => $link?->link,
                                        ])
                                    </td>
                                    <td>
                                        @includeIf('components.core.select', [
                                            'options' => $types,
                                            'label' => 'type_id_' . $social->id,
                                            'value' => $category?->id,
                                            'field' => 'name',
                                        ])
                                    </td>
                                    <td>
                                        <input type="checkbox" name="on_{{ $social->id }}" id="on_{{ $social->id }}"
                                            @if (is_null($link?->remove_at)) checked @endif>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                Update
            </button>
        </form>
        <form action="" method="post">
            <h2>Danger Zone</h2>
            <button type="submit" class="btn" style="margin-bottom: calc(var(--space) * 2)">
                Delete Account
            </button>
        </form>
    </main>
@endsection
