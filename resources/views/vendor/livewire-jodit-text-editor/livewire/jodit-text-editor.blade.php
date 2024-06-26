<div wire:ignore.self>
    <textarea class="form-control" id="{{ $joditId }}">{!! $value !!}</textarea>
</div>

@script
    <script>
        const editor = Jodit.make('#' + @js($joditId), {
            "autofocus": true,
            "uploader": {
                "insertImageAsBase64URI": false
            },
            "toolbarButtonSize": "large",
            "showCharsCounter": false,
            "showWordsCounter": false,
            "showXPathInStatusbar": false,
            "defaultActionOnPaste": "insert_clear_html",
            "buttons": [
                "bold",
                "italic",
                "underline",
                "strikethrough",
                "|",
                // "left",
                "ul",
                "ol",
                "|",
                "font",
                "fontsize",
                "paragraph",
                "brush",
                "|",
                // "link",
                // "image",
                // "video",
                "|",
                "undo",
                "redo"
            ]
        });
        document.getElementById(@js($joditId)).addEventListener('change', function() {
            @this.set('value', this.value);
        });

        window.addEventListener('update-jodit-content', (event) => {
            editor.value = event.detail[0];
        });
    </script>
@endscript
