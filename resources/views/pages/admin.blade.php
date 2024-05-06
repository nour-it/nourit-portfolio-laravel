@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.$header")
    @else
        @includeIf('components.admin-header')
    @endisset
@endsection

@section('content')
    <main>
        @isset($projects)
            @includeIf('project.table', ['projects' => $projects])
        @endisset
        @isset($skills)
            @includeIf('skill.table', ['skills' => $skills])
        @endisset
    </main>
@endsection
