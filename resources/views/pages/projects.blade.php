@extends('base')

@section('content')
    @isset($project)
        @includeIf('project.show')
    @endisset
    @includeIf('project.index', ['projects' => $projects])
@endsection
