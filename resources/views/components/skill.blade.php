<div class="card-1 border" id="skill_{{ $skill->id }}">
    <div>
        @foreach ($skill->images as $image)
            <img src="{{ url($image->path) }}" alt="" height="50" />
        @endforeach
    </div>
    <p class="text-black-3">{{ $skill->name }}</p>
    <span class="text-gray-3">{{ $skill->category[0]->name }}</span>
</div>
