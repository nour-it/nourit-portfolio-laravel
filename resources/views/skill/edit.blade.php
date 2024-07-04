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
        @includeIf('components.core.input', ['name' => 'name', 'value' => $skill->name, 'holder' => "Skill name"])
        @include('components.core.select', [
            'label' => 'skill_category_id',
            'options' => $categories,
            'value' => $skill->skill_category_id,
            'field' => "name"
        ])
        @includeIf('components.core.text-editor', ['name' => 'description', 'value' => $skill->description])
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
