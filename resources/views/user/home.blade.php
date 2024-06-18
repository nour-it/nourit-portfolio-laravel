@extends('base')

@section('header')
@isset($header)
@includeIf("components.$header")
@else
@includeIf('components.deep-header')
@endisset
@endsection

@section('content')
@includeIf('section.intro')
@includeIf('section.about')
@includeIf('section.service')
@includeIf('skill.index', ['skills' => $skills])
@includeIf('section.blog')
@includeIf('section.contact', ['username' => $username ?? ""])
@endsection
