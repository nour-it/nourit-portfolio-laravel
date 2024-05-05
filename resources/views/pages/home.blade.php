@extends('base')

@section('content')
    <section class="section__intro" id="home">
        <div>
            <div class="logo" >Nour<span>It</span></div>
            <div class="text-black-2" >
                <hr> Web and Mobile App developer
            </div>
            <div>
                <p>Hi, I'm Nouroudine, a web developer with over fourth years of experience in the industry. I specialize in
                    front-end development and have a strong foundation in HTML, CSS, and JavaScript. I am also proficient in
                    popular web development framework like React.</p>
                <p>My passion for web development extends beyond my professional work. I am an active contributor to several
                    open-source projects and enjoy experimenting with new technologies. In my free time, you can find me
                    attending hackathons or working on personal projects to hone my skills.</p>
                <p>I'm excited to join your team and contribute to building innovative and impactful web applications.</p>
            </div><a href="#contact" class="btn" >say hello<svg id="prime_send-svg"
                    width="24" height="24">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#prime_send-svg') }}"></use>
                </svg></a>
        </div>
        <div ><img src="{{ url('assets/img/logo512.png') }}" alt="user"></div>
    </section>
    @includeIf("skill.index", ['skills' => $skills])
@endsection
