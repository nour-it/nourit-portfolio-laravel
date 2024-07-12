@isset($qualifications)
    @if ($qualifications->count() > 0)
        <section class="section_qualification" id="blog">
            <div style="opacity: 1;">
                <h1 class="h1">Qualification</h1>
                <p class="text-gray-1">My personal journey</p>
            </div>
            <div style="opacity: 1;">
                <div><svg id="hat-svg" width="36" height="36">
                        <use xlink:href="{{ url('assets/icon/sprite.svg#hat-svg') }}"></use>
                    </svg>
                    <h2 class="h2">Education</h2>
                </div>
                <div><svg id="bag-svg" width="31" height="31">
                        <use xlink:href="{{ url('assets/icon/sprite.svg#bag-svg') }}"></use>
                    </svg>
                    <h2 class="h2">Experience</h2>
                </div>
            </div>
            <div>
                <div class="line" style="height: {{ ($qualifications->count() - 1) * 163.33 }}px;">
                    @foreach ($qualifications as $key => $qualification)
                        <span class="round{{ $key }}" style="opacity: 1;"></span>
                    @endforeach
                </div>
                @foreach ($qualifications as $qualification)
                    <div class="card-3 {{ $qualification->category->first()?->name == 'Education' ? 'left' : 'right' }}">
                        <div>
                            <h2 class="h2">{{ $qualification->name }}</h2>
                            <a class="h2 gray-5" href="{{ url('assests#blog') }}">
                                {{ $qualification->address?->company }},
                                {{ $qualification->address?->city }}-{{ $qualification->address?->country }}
                            </a>
                        </div>
                        <span class="text-gray-2">
                            <svg id="calendar" width="18" height="18" style="width: 40px; height: 30px">
                                <use xlink:href="{{ url('assets/icon/sprite-min.svg#calendar') }}"></use>
                            </svg>
                            {{ $qualification->start_at }}-{{ $qualification->end_at }}
                        </span>
                    </div>
                @endforeach
            </div>
        </section>
    @else
    @endif


@endisset
