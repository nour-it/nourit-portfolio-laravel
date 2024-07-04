@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
    @endisset
@endsection

@section('content')
    <div class="edit">
        @if ($service->id)
            <form action="{{ route('services.update', ['service' => $service->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
            @else
                <form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div style="display: flex">
            <input type="file" name="image" id="image" multiple>
            @foreach ($service->images as $image)
                <img src="{{ url($image->path) }}" alt="" height="30" />
            @endforeach
        </div>
        @includeIf('components.core.input', ['name' => 'title', 'value' => $service->title])
        @includeIf('components.core.select', [
            'options' => $categories,
            'label' => 'service_category_id',
            'value' => $service->service_category_id,
            'field' => 'name',
        ])
        @includeIf('components.core.text-editor', ['name' => 'description', 'value' => $service->description])
        <button type="submit" class="btn">
            @if ($service->id)
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
@endsection
