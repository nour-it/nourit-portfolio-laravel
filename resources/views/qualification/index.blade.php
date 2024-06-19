
<div class="ctn-projects">
    <div class="projects">
        @foreach ($qualifications as $qualification)
          @includeIf("components.qualification", ['qualification' => $qualification, 'urlPrefix' => $urlPrefix ?? ''])
        @endforeach
    </div>
</div>
