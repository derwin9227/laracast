<!DOCTYPE html>

<html lang="es">
    <head>
        <title>laravel</title>
        <link rel="stylesheet" href="/app.css">
        
    </head>

    <body>
        {{-- slot es la variable global para el componente
            de igual manera de puede usar cualquier otra --}}
        {{ $slot }}
    </body>

</html>