@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
    @endisset
@endsection

@section('content')
    <main style="padding-top: calc(var(--space) * 1.5)">
        @isset($projects)
            <h2>Projects</h2>
            @includeIf('project.table', ['projects' => $projects, 'more' => $more ?? false])
        @endisset
        @isset($skills)
            <h2>Skills</h1>
                @includeIf('skill.table', ['skills' => $skills, 'more' => $more ?? false])
        @endisset
        @isset($services)
            <h2>Services</h1>
            @includeIf('service.table', ['services' => $services, 'more' => $more ?? false])
        @endisset
        @isset($qualifications)
            <h2>Qualifications</h1>
            @includeIf('qualification.table', [
                'qualifications' => $qualifications,
                'more' => $more ?? false,
            ])
        @endisset
    </main>
@endsection
