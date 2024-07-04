@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
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
