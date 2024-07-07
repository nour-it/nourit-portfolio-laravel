@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
    @endisset
@endsection

@section('content')

    @if (Str::contains(request()->url(), 'dashboard/skills'))
        {{-- USER --}}
        <div class="edit">
            @if ($skill->id)
                <form action="{{ route('skills.update', ['skill' => $skill->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form action="{{ route('skills.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf
            <div style="display: flex">
                <input type="file" name="icon" id="icon" multiple>
                @foreach ($skill->images as $image)
                    <img src="{{ url($image->path) }}" alt="" height="30" />
                @endforeach
            </div>
            @includeIf('components.core.input', [
                'name' => 'name',
                'value' => $skill->name,
                'holder' => 'Skill name',
            ])
            @include('components.core.select', [
                'label' => 'category_id',
                'options' => $categories,
                'value' => $skill->skill_category_id,
                'field' => 'name',
            ])
            @includeIf('components.core.text-editor', [
                'name' => 'description',
                'value' => $skill->description,
            ])
            <button type="submit" class="btn">
                @if ($skill->id)
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
            @if ($_skill->id)
                <form action="{{ route('_skills.update', ['_skill' => $_skill->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('PUT')
                @else
                    <form action="{{ route('_skills.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf
            <div style="display: flex">
                <input type="file" name="icon" id="icon" multiple>
                @foreach ($_skill->images as $image)
                    <img src="{{ url($image->path) }}" alt="" height="30" />
                @endforeach
            </div>
            @includeIf('components.core.input', [
                'name' => 'name',
                'value' => $_skill->name,
                'holder' => 'Skill name',
            ])
            @includeIf('components.core.text-editor', [
                'name' => 'description',
                'value' => $_skill->description,
            ])
            <button type="submit" class="btn">
                @if ($_skill->id)
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
