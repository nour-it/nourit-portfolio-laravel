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
                <td>{{ $project->id }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->add_at }}</td>
                <td>{{ $project->delete_at }}</td>
                <td>actions

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route("projects.create") }}" class="btn right" style="margin-top: 20px">Add new</a>