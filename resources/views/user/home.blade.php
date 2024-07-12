@extends('base')

@section('header')
@isset($header)
@includeIf("components.partial.$header")
@else
@includeIf('components.partial.deep-header')
@endisset
@endsection

@section('content')
@includeIf('section.user.intro')
@includeIf('section.user.about', ['user' => $user])
@includeIf('section.user.service')
@includeIf('skill.index', ['skills' => $skills])
@includeIf('section.user.blog', ['qualifications' => $qualifications])
@includeIf('section.user.contact', ['username' => $username ?? ""])
@endsection
