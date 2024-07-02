@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.$header")
    @else
        @includeIf('components.admin-header')
    @endisset
@endsection

@section('content')
    <main>
        <table>
            <thead>
                <th>#</th>
                <th>username</th>
                <th>role</th>
                <th>skill</th>
                <th>project</th>
                <th>qualification</th>
                <th>service</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>
                            {{ Arr::join(Arr::map($user->role->toArray(), fn($r) => $r['title']), ' | ') }}
                        </td>
                        <td>{{ $user->skill->count() }}</td>
                        <td>{{ $user->project->count() }}</td>
                        <td>{{ $user->qualification->count() }}</td>
                        <td>{{ $user->service->count() }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
