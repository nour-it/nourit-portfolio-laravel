@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.$header")
    @else
        @includeIf('components.admin-header')
    @endisset
@endsection

@section('content')
    <div class="edit">
        @if ($skill->id)
            <form action="{{ route('skills.update', ['skill' => $skill->id]) }}" method="post" enctype="multipart/form-data">
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
        <input name="name" id="name" class="border rounded" placeholder="Skill name"
            value="{{ old('name') ?? $skill->name }}">
        @error('name')
            <span>name should not be empty</span>
        @enderror
        <input name="skill_category_id" id="skill_category_id" class="border rounded" placeholder="category"
            value="{{ old('skill_category_id') ?? $skill->skill_category_id }}">
        @error('skill_category_id')
            <span>category should not be empty</span>
        @enderror
        @includeIf('components.text-editor', ['name' => 'description', 'value' => $skill->description])
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
    <script>
        window.addEventListener("load", function() {
            $iconField = document.querySelector("input#icon")
            if ($iconField) {
                $iconField.addEventListener("change", function(e) {
                    e.target.parentElement.querySelectorAll("img").forEach(img => {
                        e.target.parentElement.removeChild(img)
                    });
                    const files = e.target.files;
                    for (let file in files) {
                        if (file !== 'item' && file !== 'length') {
                            let $img = document.createElement("img")
                            $img.src = URL.createObjectURL(files[file]);
                            $img.height = 50;
                            e.target.parentElement.appendChild($img);
                        }
                    }
                })
            }
        })
    </script>
@endsection
