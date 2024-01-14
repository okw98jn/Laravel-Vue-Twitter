<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Vue</title>
    @vite(['resources/ts/main.ts', 'resources/ts/index.css'])
</head>

<body>
    <div id="app"></div>
</body>

</html>
