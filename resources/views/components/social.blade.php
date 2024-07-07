    <div class="card-1 border" id="skill_{{ $skill->id }}">
        <div>
            @foreach ($socail->images as $image)
                <img src="{{ url($image->path) }}" alt="" height="50" />
            @endforeach
        </div>
        <p class="text-black-3">{{ $social->name }}</p>
        <span class="text-gray-3">{{ $social->category[0]->name }}</span>
    </div>
