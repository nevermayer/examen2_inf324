<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <title>{{env('APP_NAME')}}</title>
        @vite(['resources/css/app.css','resources/scss/app.scss','resources/js/app.js'])
        </head>
    <body>
        <div id="app"></div>
    </body>
</html>
