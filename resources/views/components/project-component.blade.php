<div class="project border rounded"
    style="background-image: url({{ url($project->images[0]->path) }}); background-color: #00000002;">
    <div class="rounded" style="background: var(--color-body-background);">
        <svg id="web" width="24" height="24">
            <use xlink:href="/icon/sprite.svg#web"></use>
        </svg>
        <h2 class="h2">{{ $project->name }}</h2>
        <a href="{{ route('project.page.show', ['project' => $project->id]) }}">
            <span class="text-gray-2">more</span>
            <svg id="arrow-right-svg" width="15" height="15">
                <use xlink:href="/icon/sprite.svg#arrow-right-svg"></use>
            </svg>
        </a>
    </div>
</div>
