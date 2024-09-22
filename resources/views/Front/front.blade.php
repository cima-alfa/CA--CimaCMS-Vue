<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/js/front/app.js')
    @inertiaHead

    @auth
        @routes()
    @else
        @routes(['front'])
    @endauth
</head>

<body>
    @inertia
</body>

</html>
