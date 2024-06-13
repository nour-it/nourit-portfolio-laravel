<table>
    <thead>
        <th>#</th>
        <th>name</th>
        <th>add at</th>
        <th>delete</th>
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
                <td>{{ $project->add_at }}</td>
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
