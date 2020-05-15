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
        
        $company = new \Source\Models\Company();
        $company_company = $company->search_by_social_reason("Core Company");
        
        $course = new \Source\Models\Course();
        $course_php = $course->search_by_id(1);
        

        $new_course =  new \Source\Models\Course();
        $new_course->bootstrap("Linux for Servidores", "Aprenda sobre o mundo do piguim", "394.99", 1);
        
        if ($new_course->save()) {
            echo message()->success("Curso cadastrado com sucesso");
        } else {
            echo message()->success("Não foi possível cadastrar o curso");
        }
        
        var_dump($user_ceo, $user_tutor, $company_company, $course_php, $new_course);
        
        ?>
    </body>
</html>
