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
    </section>
@else
@endif
