@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
    @endisset
@endsection

@section('content')
@if (Str::contains(request()->url(), 'dashboard/qualifications'))
{{-- USER --}}
    <div class="edit">
        @if ($qualification->id)
            <form action="{{ route('qualifications.update', ['qualification' => $qualification->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
            @else
                <form action="{{ route('qualifications.store') }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div style="display: flex">
            <input type="file" name="image" id="image" multiple>
            @foreach ($qualification->images as $image)
                <img src="{{ url($image->path) }}" alt="" height="30" />
            @endforeach
        </div>
        @includeIf('components.core.input', ['name' => 'name', 'value' => $qualification->name])
        @includeIf('components.core.select', [
            'options' => $categories,
            'label' => 'qualification_category_id',
            'value' => $qualification->qualification_category_id,
            'field' => 'name',
        ])
        @includeIf('components.core.text-editor', ['name' => 'description', 'value' => $qualification->description])
        <button type="submit" class="btn">
            @if ($qualification->id)
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
        @if ($_qualification->id)
            <form action="{{ route('_qualifications.update', ['_qualification' => $_qualification->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
            @else
                <form action="{{ route('_qualifications.store') }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div style="display: flex">
            <input type="file" name="image" id="image" multiple>
            @foreach ($_qualification->images as $image)
                <img src="{{ url($image->path) }}" alt="" height="30" />
            @endforeach
        </div>
        @includeIf('components.core.input', ['name' => 'name', 'value' => $_qualification->name])
      
        @includeIf('components.core.text-editor', ['name' => 'description', 'value' => $_qualification->description])
        <button type="submit" class="btn">
            @if ($_qualification->id)
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
