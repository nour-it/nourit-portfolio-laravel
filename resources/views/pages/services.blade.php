@extends('base')

@section('header')
    @isset($header)
        @includeIf('components.partial.{{ $header }}')
    @else
        @includeIf('components.partial.deep-header')
    @endisset
@endsection

@section('content')
    @isset($project)
        @includeIf('project.show')
    @endisset
    @includeIf('service.index', ['services' => $services, 'urlPrefix' => 'user.'])
@endsection
