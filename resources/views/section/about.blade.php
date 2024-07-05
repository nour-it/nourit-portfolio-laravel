<section class="section__about" id="about">
    <div style="opacity: 1;">
        <h1 class="h1">About Me</h1>
        <p class="text-gray-1">My Introducation</p>
    </div>
    <div>
        <div style="opacity: 1; transform: translateY(0px);">
            @foreach ($user->images as $image)
                @if ($image->category->first()->name == 'About')
                    <img src="{{ url($image->path) }}" alt="about" class="rounded">
                @endif
            @endforeach
        </div>
        <div>
            <div>
                <div class="card-1 border rounded" id="about_item" style="opacity: 1; transform: translateY(0px);">
                    <svg id="award-svg" width="31" height="31">
                        <use xlink:href="{{ url('assets/icon/sprite.svg#award-svg') }}"></use>
                    </svg>
                    <p class="text-gray-1">Experience</p>
                    <span class="text-gray-2">+4 years</span>
                </div>
                <div class="card-1 border rounded" id="about_item" style="opacity: 1; transform: translateY(0px);">
                    <svg id="cloud-svg" width="26" height="26">
                        <use xlink:href="{{ url('assets/icon/sprite.svg#cloud-svg') }}"></use>
                    </svg>
                    <p class="text-gray-1">Completed</p>
                    <span class="text-gray-2">{{ $user->project->count() }} project</span>
                </div>
                <div class="card-1 border rounded" id="about_item" style="opacity: 1; transform: translateY(0px);">
                    <svg id="hear-phone-svg" width="20" height="20">
                        <use xlink:href="{{ url('assets/icon/sprite.svg#hear-phone-svg') }}"></use>
                    </svg>
                    <p class="text-gray-1">Supports</p>
                    <span class="text-gray-2">online 24/7</span>
                </div>
            </div>
            <p>
                {!! $user->about !!}
            </p>
            <a downlaod="https://firebasestorage.googleapis.com/v0/b/nour-it-portfolio.appspot.com/o/resumes%2Fseydou-nouroudine.resume.en.pdf?alt=media&amp;token=6fc43bcb-c0ef-4e0f-be2e-72e96a0d1810"
                class="btn"
                href="https://firebasestorage.googleapis.com/v0/b/nour-it-portfolio.appspot.com/o/resumes%2Fseydou-nouroudine.resume.en.pdf?alt=media&amp;token=6fc43bcb-c0ef-4e0f-be2e-72e96a0d1810"
                target="_blanck" style="transform: scale(1); opacity: 1;">
                Download CV
                <svg id="docuemt-svg" width="24" height="24">
                    <use xlink:href="{{ url('assets/icon/sprite.svg#docuemt-svg') }}"></use>
                </svg>
            </a>
        </div>
    </div>
</section>
