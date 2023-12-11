<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
        <title><?php echo e(env('APP_NAME')); ?></title>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/scss/app.scss','resources/js/app.js']); ?>
        </head>
    <body>
        <div id="app"></div>
    </body>
</html>
<?php /**PATH D:\Escritorio\INF324\2do examen 324\p2\resources\views/welcome.blade.php ENDPATH**/ ?>