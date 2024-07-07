@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
    @endisset
@endsection

@section('content')

    @if (Str::contains(request()->url(), 'dashboard/social'))
        {{-- USER --}}
        <div class="edit">
            @if ($_social->id)
                <form action="{{ route('_socials.update', ['_social' => $_social->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form action="{{ route('_socials.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf
            <div style="display: flex">
                <input type="file" name="icon" id="icon" multiple>
                @foreach ($_social->images as $image)
                    @includeIf('components.core.img', [
                        'src' => url($image->path),
                        'alt' => 'social' . $_social->name,
                    ])
                @endforeach
            </div>
            @includeIf('components.core.input', [
                'name' => 'name',
                'value' => $_social->name,
                'holder' => 'Social name',
            ])
            @includeIf('components.core.text-editor', [
                'name' => 'description',
                'value' => $_social->description,
            ])
            <button type="submit" class="btn">
                @if ($_social->id)
                    Edit
                @else
                    Create
                @endif
                <svg id="prime_send-svg" width="24" height="24">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#prime_send-svg') }}"></use>
                </svg>
            </button>
            </form>
        </div>
    @else
        {{-- ADMIN --}}
        <div class="edit">
            @if ($_social->id)
                <form action="{{ route('_socials.update', ['_social' => $_social->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form action="{{ route('_socials.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf
            <div style="display: flex">
                @includeIf('components.core.input', [
                    'name'  => 'icon',
                    'type'  => 'file',
                    'class' => '',
                ])
                @foreach ($_social->images as $image)
                    @includeIf('components.core.img', [
                        'src' => url($image->path),
                        'alt' => 'social' . $_social->name,
                    ])
                @endforeach
            </div>
            @includeIf('components.core.input', [
                'name' => 'name',
                'value' => $_social->name,
                'holder' => 'Social name',
            ])
            @includeIf('components.core.text-editor', [
                'name' => 'description',
                'value' => $_social->description,
            ])
            <button type="submit" class="btn">
                @if ($_social->id)
                    Edit
                @else
                    Create
                @endif
                <svg id="prime_send-svg" width="24" height="24">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#prime_send-svg') }}"></use>
                </svg>
            </button>
            </form>
        </div>
    @endif
@endsection
