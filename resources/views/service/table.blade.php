@if (Str::contains(request()->url(), 'dashboard'))
    {{-- USER --}}
    <table>
        <thead>
            <th>#</th>
            <th>title</th>
            <th>Status</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>
                        @foreach ($service->images as $image)
                            <img src="{{ url($image->path) }}" alt="" height="30" />
                        @endforeach
                    </td>
                    <td>{{ $service->title }}</td>
                    <td>
                        <div
                            class="dot @if ($service->delete_at) {{ 'red' }} @else {{ 'green' }} @endif">
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: calc(var(--space) * 1)">
                            <a href="{{ route('services.edit', ['service' => $service->id]) }}">edit</a>
                            <form action="{{ route('services.destroy', ['service' => $service->id]) }}" method="POST">
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
        <a href="{{ route('services.index') }}" class="btn right" style="margin-top: 20px">More</a>
    @else
        <a href="{{ route('services.create') }}" class="btn right" style="margin-top: 20px">New</a>
    @endif
@else
    {{-- ADMIN --}}
    <table>
        <thead>
            <th>#</th>
            <th>title</th>
            <th>Status</th>
            <th>Service</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($services as $service)
                @php
                    $category = $service;
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
                            class="dot @if ($service->delete_at) {{ 'red' }} @else {{ 'green' }} @endif">
                        </div>
                    </td>
                    <td>
                        {{ $category->service->count() }}
                    </td>
                    <td>
                        <div style="display: flex; gap: calc(var(--space) * 1)">
                            <a href="{{ route('_services.edit', ['_service' => $category->id]) }}">edit</a>
                            <form action="{{ route('_services.destroy', ['_service' => $category->id]) }}"
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
        <a href="{{ route('_services.index') }}" class="btn right" style="margin-top: 20px">More</a>
    @else
        <a href="{{ route('_services.create') }}" class="btn right" style="margin-top: 20px">New</a>
    @endif
@endif
