@extends('base')

@section('content')
    @includeIf('section.intro')
    @includeIf('section.about')
    @includeIf('section.service')
    @includeIf('skill.index', ['skills' => $skills])
    @includeIf('section.blog')
    @includeIf('section.contact')
@endsection
