@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.$header")
    @else
        @includeIf('components.admin-header')
    @endisset
@endsection

@section('content')
    <main style="padding-top: calc(var(--space) * 1.5)">
        <h2>Projects</h2>
        @isset($projects)
            @includeIf('project.table', ['projects' => $projects])
        @endisset
        <h2>Skills</h1>
        @isset($skills)
            @includeIf('skill.table', ['skills' => $skills])
        @endisset
    </main>
@endsection
