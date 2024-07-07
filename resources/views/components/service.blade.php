
<div class="project border rounded"style="background-image: url('{{ url($service->images[0]->path ?? "service.png") }}'); background-color: #00000002;">
    <div class="rounded" style="background: var(--color-body-background);">
        <svg id="web" width="24" height="24">
            <use xlink:href="/icon/sprite.svg#web"></use>
        </svg>
        <h2 class="h2">{{ $service->title }}</h2>
        <div>
            <span class="text-gray-2">more</span>
            <svg id="arrow-right-svg" width="15" height="15">
                <use xlink:href="/icon/sprite.svg#arrow-right-svg"></use>
            </svg>
        </div>
    </div>
</div>
