@if (Str::contains(request()->url(), 'dashboard'))

    <table>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($qualifications as $qualification)
                <tr>
                    <td>
                        @foreach ($qualification->images as $image)
                            <img src="{{ url($image->path) }}" alt="" height="30" />
                        @endforeach
                    </td>
                    <td>{{ $qualification->name }}</td>
                    <td>
                        <div
                            class="dot @if ($qualification->delete_at) {{ 'red' }} @else {{ 'green' }} @endif">
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: calc(var(--space) * 1)">
                            <a
                                href="{{ route('qualifications.edit', ['qualification' => $qualification->id]) }}">edit</a>
                            <form action="{{ route('qualifications.destroy', ['qualification' => $qualification->id]) }}"
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
        <a href="{{ route('qualifications.index') }}" class="btn right" style="margin-top: 20px">More</a>
    @else
        <a href="{{ route('qualifications.create') }}" class="btn right" style="margin-top: 20px">New</a>
    @endif
@else
    <table>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>qualifications</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($qualifications as $qualification)
            @php
                $category = $qualification
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
                            class="dot @if ($qualification->delete_at) {{ 'red' }} @else {{ 'green' }} @endif">
                        </div>
                    </td>
                    <td>{{ $category->qualification }}</td>
                    <td>
                        <div style="display: flex; gap: calc(var(--space) * 1)">
                            <a
                                href="{{ route('_qualifications.edit', ['_qualification' => $category->id]) }}">edit</a>
                            <form
                                action="{{ route('_qualifications.destroy', ['_qualification' => $category->id]) }}"
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
        <a href="{{ route('_qualifications.index') }}" class="btn right" style="margin-top: 20px">More</a>
    @else
        <a href="{{ route('_qualifications.create') }}" class="btn right" style="margin-top: 20px">New</a>
    @endif
@endif
