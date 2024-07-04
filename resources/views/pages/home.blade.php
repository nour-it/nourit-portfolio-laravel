@extends('base')

@section('header')
@isset($header)
@includeIf("components.partial.$header")
@else
@includeIf('components.partials.deep-header')
@endisset
@endsection

@section('content')
@includeIf('section.service')
@includeIf('skill.index', ['skills' => $skills])
@includeIf('section.blog')
@includeIf('section.contact')
@endsection
