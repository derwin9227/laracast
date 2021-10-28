<!DOCTYPE html>

<html lang="es">
    <head>
        <title>laravel</title>
        <link rel="stylesheet" href="/app.css">
    </head>

    <body>
        <?php foreach ($posts as $post) : ?>
            <article>
                <?php $post; ?>
            </article>
        <?php endforeach; ?>
    </body>

</html>