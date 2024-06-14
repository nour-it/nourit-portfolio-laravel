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
        @if ($project->id)
            <form action="{{ route('projects.update', ['project' => $project->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
            @else
                <form action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div style="display: flex">
            <input type="file" name="icon" id="icon" multiple>
            @foreach ($project->images as $image)
                <img src="{{ url($image->path) }}" alt="" height="30" />
            @endforeach
        </div>
        @includeIf('components.input', ['name' => 'name', 'value' => $project->name])
        @includeIf('components.select', [
            'options' => $categories,
            'label' => 'project_category_id',
            'value' => $project->project_category_id,
            'field' => 'name',
        ])
        @includeIf('components.text-editor', ['name' => 'description', 'value' => $project->description])
        <button type="submit" class="btn">
            @if ($project->id)
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