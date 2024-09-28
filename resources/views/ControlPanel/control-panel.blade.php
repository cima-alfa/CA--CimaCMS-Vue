<!DOCTYPE html>
<html lang="en" class="[color-scheme:dark_light]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet">

    @vite('resources/js/control-panel/app.ts')
    @inertiaHead
    @routes
</head>

<body class="bg-neutral-50 text-black-100 dark:bg-neutral-950 dark:text-white-100">
    @inertia
</body>

</html>
