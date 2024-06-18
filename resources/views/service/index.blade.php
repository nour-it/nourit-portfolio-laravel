
<div class="ctn-projects">
    <div class="projects">
        @foreach ($services as $service)
          @includeIf("components.service", ['service' => $service, 'urlPrefix' => $urlPrefix ?? ''])
        @endforeach
    </div>
</div>
