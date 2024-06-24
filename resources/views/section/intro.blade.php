<section class="section__intro" id="home">
    <div>
        <div class="logo">Nour<span>It</span></div>
        <div class="text-black-2">
            <hr> Web and Mobile App developer
        </div>
        {!! $user->bio !!}
        <a href="#contact" class="btn">
            say hello
            <svg id="prime_send-svg" width="24" height="24">
                <use xlink:href="{{ url('assets/icon/sprite.svg#prime_send-svg') }}" />
            </svg>
        </a>
    </div>
    <div>
        <img src="{{ url('assets/img/logo512.png') }}" alt="user">
    </div>
</section>
