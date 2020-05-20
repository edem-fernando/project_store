<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require __DIR__ . '/vendor/autoload.php';
        $user = new Source\Models\User();
        
        $user_name = $user->search_by_id("1");
        $user_name->senha = "trojan-6060";

        if ($user_name->save()) {
            message()->success("Usuário editado com sucesso");
            var_dump($user_name);
        }
        
        ?>
    </body>
</html>
