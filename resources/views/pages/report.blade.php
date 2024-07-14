@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
    @endisset
@endsection

@section('content')
    <main style="padding-top: calc(var(--space) * 1.5)">
        @if (session('error'))
            <div>{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif
        <div style="width: 100%;">
            <h2>Users</h2>
            <canvas id="report"
                data-report='[
                    @foreach ($years as $key => $year)
                    { "year": {{ $year->year }}, "count": {{ $year->count }} } @if ($key+1 != $years->count()), @endif
                    @endforeach
                ]''>
            </canvas>
        </div>
    </main>
@endsection
