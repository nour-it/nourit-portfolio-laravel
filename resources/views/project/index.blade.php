<div class="ctn-projects">
    <div class="projects">
        @foreach ($projects as $project)
            <x-project-component :project="$project" />
        @endforeach
    </div>
</div>
