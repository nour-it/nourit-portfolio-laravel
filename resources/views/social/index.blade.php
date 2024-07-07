@if ($socials->count() > 0)
    <section class="section_skills" id="skills" ref={sectionRef}>
        <div>
            <h1 class="h1">Compétences</h1>
            <p class="text-gray-1">Mon niveau technique</p>
        </div>
        <div>
            @foreach ($socials as $social)
                @includeIf('components.social', ['social' => $social])
            @endforeach
        </div>
    </section>
@else
@endif
