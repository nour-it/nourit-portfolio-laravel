@if (Str::contains(request()->url(), 'dashboard'))
    {{-- USER --}}
    <table>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>
                        @foreach ($project->images as $image)
                            <img src="{{ url($image->path) }}" alt="" height="30" />
                        @endforeach
                    </td>
                    <td>{{ $project->name }}</td>
                    <td>
                        <div
                            class="dot @if ($project->delete_at) {{ 'red' }} @else {{ 'green' }} @endif">
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: calc(var(--space) * 1)">
                            <a href="{{ route('projects.edit', ['project' => $project->id]) }}">edit</a>
                            <form action="{{ route('projects.destroy', ['project' => $project->id]) }}" method="POST">
                                @method('DELETE') @csrf
                                <button type="submit">delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($more && $more != false)
        <a href="{{ route('projects.index') }}" class="btn right" style="margin-top: 20px">More</a>
    @else
        <a href="{{ route('projects.create') }}" class="btn right" style="margin-top: 20px">New</a>
    @endif
@else
    {{-- ADMIN --}}
    <table>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Project</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                @php
                    $category = $project;
                @endphp
                <tr>
                    <td>
                        @foreach ($category->images as $image)
                            <img src="{{ url($image->path) }}" alt="" height="30" />
                        @endforeach
                    </td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div
                            class="dot @if ($category->delete_at) {{ 'red' }} @else {{ 'green' }} @endif">
                        </div>
                    </td>
                    <td>
                        {{ $category->project->count() }}
                    </td>
                    <td>
                        <div style="display: flex; gap: calc(var(--space) * 1)">
                            <a href="{{ route('_projects.edit', ['_project' => $category->id]) }}">edit</a>
                            <form action="{{ route('_projects.destroy', ['_project' => $category->id]) }}"
                                method="POST">
                                @method('DELETE') @csrf
                                <button type="submit">delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($more && $more != false)
        <a href="{{ route('_projects.index') }}" class="btn right" style="margin-top: 20px">More</a>
    @else
        <a href="{{ route('_projects.create') }}" class="btn right" style="margin-top: 20px">New</a>
    @endif
@endif
