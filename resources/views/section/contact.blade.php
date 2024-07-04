<section class="section_contact" id="contact">
    <div style="opacity: 1;">
        <h1 class="h1">Contact Me</h1>
        <p class="text-gray-1">get in touch</p>
    </div>
    <div>
        @if ($contactLinks->count() > 0)
            <div>
                <h2 class="h2">Talk to me</h2>
                {{-- <div class="border rounded"><svg id="email-svg" width="35" height="35">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#email-svg') }}"></use>
                </svg>
                <h2 class="h2">Email</h2><span class="text-gray-2">reply.nour.it@gmail.com</span><a
                    href="mailto:reply.nour.it@gmail.com"><span>with me</span><svg id="arrow-right-svg" width="15"
                        height="15">
                        <use xlink:href="{{ url('assets/icon/sprite.svg#arrow-right-svg') }}"></use>
                    </svg></a>
            </div>
            <div class="border rounded"><svg id="whatsapp-svg" width="35" height="35">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#whatsapp-svg') }}"></use>
                </svg>
                <h2 class="h2">Whatsapp</h2><span class="text-gray-2">+228 91108834</span><a
                    href="https://wa.me/22891108834?text=Salut"><span>with me</span><svg id="arrow-right-svg"
                        width="15" height="15">
                        <use xlink:href="{{ url('assets/icon/sprite.svg#arrow-right-svg') }}"></use>
                    </svg></a>
            </div>
            <div class="border rounded"><svg id="messanger-svg" width="35" height="35">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#messanger-svg') }}"></use>
                </svg>
                <h2 class="h2">Messanger</h2><span class="text-gray-2">nourxxIt</span><a
                    href="https://www.facebook.com/nourxxIt/"><span>with me</span><svg id="arrow-right-svg"
                        width="15" height="15">
                        <use xlink:href="{{ url('assets/icon/sprite.svg#arrow-right-svg') }}"></use>
                    </svg></a>
            </div> --}}
                @foreach ($contactLinks as $link)
                    <div class="border rounded">
                        <img src={{ url($link->social->images->first()->path) }} alt="{{ $link->social->name }}"
                            height="32">
                        <h2 class="h2">{{ $link->social->name }}</h2>
                        <span class="text-gray-2">{{ $link->link }}</span>
                        <a href="{{ $link->link }}">
                            <span>with me</span>
                            <svg id="arrow-right-svg" width="15" height="15">
                                <use xlink:href="{{ url('assets/icon/sprite.svg#arrow-right-svg') }}"></use>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
        <div>
            <h2 class="h2">Write to me</h2>
            @isset($username)
                <form action="{{ route('contact.mail', ['user' => $username]) }}" method="post">
                @else
                    <form action="{{ route('home.contact.mail') }}" method="post">
                    @endisset
                    @csrf
                    @auth
                    @else
                        @includeIf('components.core.input', [
                            'name' => 'name',
                            'value' => '',
                            'holder' => 'Insert you name',
                        ])
                        @includeIf('components.core.input', [
                            'name' => 'email',
                            'value' => '',
                            'holder' => 'Insert you email',
                        ])
                    @endauth
                    <textarea name="project" id="project" cols="30" rows="10" class="border rounded"
                        placeholder="Write your project"></textarea>
                    <button type="submit" class="btn">
                        send message
                        <svg id="prime_send-svg" width="24" height="24">
                            <use xlink:href="{{ url('assets/icon/sprite.svg#prime_send-svg') }}"></use>
                        </svg>
                    </button>
                </form>
        </div>
    </div>
</section>
