{{-- <textarea name="{{ $name }}" id="{{ $name }}" cols="30" rows="10" class="border rounded"
    placeholder="Skill description">
    {{ $value }}
</textarea> --}}

<div id="{{ $name }}">
    {!! $value !!}
</div>


<script>
    window.addEventListener("load", function() {
        // var froala = new FroalaEditor('#{{ $name }}');
        let editor = document.querySelector("#{{ $name }}");

        let form = editor.parentNode;

        const quill = new Quill('#{{ $name }}', {
            theme: 'snow'
        });

        form.addEventListener("submit", function(event) {
            let textArea = document.createElement("textarea")
            textArea.setAttribute('name', '{{ $name }}')
            textArea.value = quill.getSemanticHTML()
            textArea.hidden = true
            form.appendChild(textArea)
        });
    })
</script>
