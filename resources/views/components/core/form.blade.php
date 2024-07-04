@if ($value)
<form action="{{ route('projects.update', ['project' => $value]) }}" method="post"
    enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data">
@endif
@csrf