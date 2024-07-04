@extends('base')

@section('header')
    @isset($header)
        @includeIf('components.{{ $header }}')
    @else
        @includeIf('components.partials.deep-header')
    @endisset
@endsection

@section('content')
    @isset($project)
        @includeIf('project.show')
    @endisset
    @includeIf('project.index', ['projects' => $projects])
@endsection
