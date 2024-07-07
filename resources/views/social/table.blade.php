@if (Str::contains(request()->url(), 'dashboard/socials'))
    {{-- USER --}}
    <table>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($skills as $skill)
                <tr>
                    <td>
                        @foreach ($skill->images as $image)
                            <img src="{{ url($image->path) }}" alt="" height="30" />
                        @endforeach
                    </td>
                    <td>{{ $skill->name }}</td>
                    <td>
                        <div
                            class="dot @if ($skill->delete_at) {{ 'red' }} @else {{ 'green' }} @endif">
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: calc(var(--space) * 1)">
                            <a href="{{ route('skills.edit', ['skill' => $skill->id]) }}">edit</a>
                            <form action="{{ route('skills.destroy', ['skill' => $skill->id]) }}" method="POST">
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
        <a href="{{ route('skills.index') }}" class="btn right" style="margin-top: 20px">More</a>
    @else
        <a href="{{ route('skills.create') }}" class="btn right" style="margin-top: 20px">New</a>
    @endif

    {{-- ADMIN --}}
@else
    <table>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($socials as $social)
                @php
                    $category = $social;
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
                        <div style="display: flex; gap: calc(var(--space) * 1)">
                            <a href="{{ route('_socials.edit', ['_social' => $category->id]) }}">edit</a>
                            <form action="{{ route('_socials.destroy', ['_social' => $category->id]) }}" method="POST">
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
        <a href="{{ route('_socials.index') }}" class="btn right" style="margin-top: 20px">More</a>
    @else
        <a href="{{ route('_socials.create') }}" class="btn right" style="margin-top: 20px">New</a>
    @endif
@endif
