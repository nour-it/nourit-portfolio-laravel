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
                <th>
                    <a href="?filter=username">
                        username
                    </a>
                </th>
                <th>role</th>
                <th>
                    <a href="?filter=skill">
                        skill
                    </a>
                </th>
                <th>
                    <a href="?filter=project">
                        project
                    </a>
                </th>
                <th>
                    <a href="?filter=qualification">
                        qualification
                    </a>
                </th>
                <th>
                    <a href="?filter=service">
                        service
                    </a>
                </th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @foreach ($user->images as $image)
                                @if ($image->category->first()->name == 'Profile')
                                    @includeIf('components.core.img', [
                                        'src' => url($image->path),
                                        'alt' => 'user',
                                        'width' => 50,
                                    ])
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>
                            {{ Arr::join(Arr::map($user->role->toArray(), fn($r) => $r['title']), ' | ') }}
                        </td>
                        <td>{{ $user->skill }}</td>
                        <td>{{ $user->project }}</td>
                        <td>{{ $user->qualification }}</td>
                        <td>{{ $user->service }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @includeIf('components.core.pagination', ['data' => $users])
    </main>
@endsection
