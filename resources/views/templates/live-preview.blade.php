<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $template->name }} - Aperçu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0a;
            color: #ffffff;
        }

        .preview-container {
            width: 100%;
            min-height: 100vh;
        }

        .component-section {
            width: 100%;
            position: relative;
        }

        /* Inject component CSS */
        @foreach($template->components as $component)
            {!! $component->css_code !!}
        @endforeach
    </style>
</head>

<body>
    <div class="preview-container">
        @foreach($template->components as $component)
            <div class="component-section" data-component="{{ $component->slug }}"
                data-section="{{ $component->pivot->section_name }}">
                {!! $component->html_code !!}
            </div>
        @endforeach
    </div>

    <!-- Inject component JS -->
    @foreach($template->components as $component)
        @if($component->js_code)
            <script>
                {!! $component->js_code !!}
            </script>
        @endif
    @endforeach
</body>

</html>