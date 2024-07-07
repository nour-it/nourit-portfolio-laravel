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

        @if (session('error'))
            <div>{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif

        @isset($projects)
            <h2>Projects</h2>
            @includeIf('project.table', [
                'projects' => $projects,
                'more' => $more ?? false,
                'user' => $user,
            ])
        @endisset


        @isset($skills)
            <h2>Skills</h2>
            @includeIf('skill.table', [
                'skills' => $skills,
                'more' => $more ?? false,
                'user' => $user,
            ])
        @endisset


        @isset($socials)
            <h2>Socials</h2>
            @includeIf('social.table', [
                'socials' => $socials,
                'more' => $more ?? false,
                'user' => $user,
            ])
        @endisset


        @isset($services)
            <h2>Services</h2>
            @includeIf('service.table', [
                'services' => $services,
                'more' => $more ?? false,
                'user' => $user,
            ])
        @endisset


        @isset($qualifications)
            <h2>Qualifications</h2>
            @includeIf('qualification.table', [
                'qualifications' => $qualifications,
                'more' => $more ?? false,
                'user' => $user,
            ])
        @endisset
    </main>
@endsection
