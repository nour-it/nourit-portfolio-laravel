
<div class="ctn-projects">
    <div class="projects">
        @foreach ($projects as $project)
          @includeIf("components.project", ['project' => $project, 'urlPrefix' => $urlPrefix ?? ''])
        @endforeach
    </div>
</div>
