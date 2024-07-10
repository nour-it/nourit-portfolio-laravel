@if ($skills->count() > 0)
    <section class="section_skills" id="skills" ref={sectionRef}>
        <div>
            <h1 class="h1">Compétences</h1>
            <p class="text-gray-1">Mon niveau technique</p>
        </div>
        <div>
            @foreach ($skills as $skill)
                @includeIf('components.skill', ['skill' => $skill])
            @endforeach
        </div>
        @isset($user)
            @if ($skills->hasMorePages())
                <div class="center" style="margin-top: calc(var(--space) * 2)">
                    <a href="{{ route('user.skill.page.index', ['user' => $user->slug]) }}">
                        <span class="text-gray-2">view more</span>
                        <svg id="arrow-right-svg" width="15" height="15">
                            <use xlink:href="{{ url('assets/icon/sprite.svg#arrow-right-svg') }}"></use>
                        </svg>
                    </a>
                </div>
            @endif
        @endisset
    </section>
@else
@endif
