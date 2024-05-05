<div class="projects info">
    <div class="project border rounded"
        style="background-image: url({{ url($project->images[0]->path) }}); background-color: var(--cover);">
        <div class="rounded" style="background: var(--color-body-background);"><svg id="android" width="24"
                height="24">
                <use xlink:href="/icon/sprite.svg#android"></use>
            </svg>
            <h2 class="h2">Fruit Nour Matching</h2><a href="/project#fruitnourmatching"><span
                    class="text-gray-2">more</span><svg id="arrow-right-svg" width="15" height="15">
                    <use xlink:href="/icon/sprite.svg#arrow-right-svg"></use>
                </svg></a>
        </div>
    </div>
    <div class="project-info border rounded">
        <div>
            <div>
                @foreach ($project->images as $image)
                    <img src="{{ url($image->path) }}" alt="" />
                @endforeach
            </div>
            <div class="close"><svg id="close" width="24" height="24">
                    <use xlink:href="/icon/sprite.svg#close"></use>
                </svg></div>
        </div>
        <div>
            <h1>Fruit Nour Matching</h1>
            <div>Oct 2021 - Dec 2021</div>
            <div>

            </div>
        </div>
    </div>
</div>
