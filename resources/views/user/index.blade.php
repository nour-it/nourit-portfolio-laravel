@extends('admin')

@section('header')
    @isset($header)
        @includeIf("components.partial.$header")
    @else
        @includeIf('components.partial.admin-header')
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
                            @foreach ($user->images as $image)
                                @if ($image->category->first()->name == 'Profile')
                                    @includeIf('components.core.img', ['src' => url($image->path),'alt' => 'user', 'width' => 50])
                                @endif
                            @endforeach
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
