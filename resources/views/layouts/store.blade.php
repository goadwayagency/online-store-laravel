<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BCE Industrial | Precision Tools & Components</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-bce-blue text-white font-sans antialiased dark:bg-black dark:text-gray-100">
    <x-common.header />
    <main>
        {{ $slot }}
    </main>
    <!-- Footer -->
    <x-common.footer />

</body>
</html>