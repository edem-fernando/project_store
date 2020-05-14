<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require __DIR__ . '/source/autoload.php';
        $new_ceo = new \Source\Models\Ceo();
        $user_ceo = $new_ceo->search_by_id(1);
        
        $tutor = new \Source\Models\Tutor();
        $user_tutor = $tutor->search_by_name("Edem Fernando");
        
        var_dump($user_ceo);
        var_dump($user_tutor);
        ?>
    </body>
</html>
