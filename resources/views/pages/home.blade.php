@extends('base')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.deep-header')
    @endisset
@endsection

@section('content')
    @includeIf('section.home.intro')
    @includeIf('section.home.about')
    @includeIf('section.home.service')
    @includeIf('skill.index')
    @includeIf('section.home.blog')
    @includeIf('section.home.contact')
@endsection
