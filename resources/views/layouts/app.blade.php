<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <!-- Agregar el enlace al archivo de la biblioteca FontAwesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <div class="dark:active:bg-gray-300" style="display: flex; ">
                <div style="flex: 20%">
                    @include('layouts.menu')

                </div>
                <div style="flex: 80%">
                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>


        </div>
        <script>
            console.log($('input[name="value"]')); // Verifique se o elemento está sendo selecionado corretamente
            $(document).ready(function () {
                // Aplica a máscara ao elemento com o name "value"
                $('input[name="value"]').inputmask('currency', {
                    radixPoint: ',',
                    groupSeparator: '.',
                    allowMinus: false, // Remova esta linha se desejar permitir valores negativos
                    prefix: 'R$ ',
                    autoUnmask: true
                });
            });
            $(document).ready(function () {
                console.log('Document ready'); // Verifique se o script está sendo executado
                // Resto do seu código aqui...
            });

        </script>
    </body>
</html>
