<section class="section__intro" id="home">
    <div>
        <div class="logo">Nour<span>It</span></div>
        <div class="text-black-2">
            <hr> Web and Mobile App developer
        </div>
        <div>
            {!! $user->bio !!}
        </div>
        <a href="#contact" class="btn">
            say hello
            <svg id="prime_send-svg" width="24" height="24">
                <use xlink:href="{{ url('assets/icon/sprite.svg#prime_send-svg') }}" />
            </svg>
        </a>
    </div>
    <div>
        @foreach ($user->images as $image)
            @if ($image->category->first()->name == 'Profile')
                <img src="{{ url($image->path) }}" alt="user">
            @endif
        @endforeach
    </div>
</section>
