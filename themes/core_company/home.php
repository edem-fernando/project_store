<?php $v->layout("_theme"); ?>

<section class="main_content">
    <header>
        <h2>Conheça nossos cursos</h2>
    </header>

    <?php foreach ($courses as $course): ?>
        <article class="main_content_products">
            <header>
                <a href="#" class="transition">
                    <img src="<?= $course->imagePath; ?>" title="Curso de <?= $course->name; ?>" alt="Curso de <?= $course->name; ?>">
                    <h4><?= $course->name; ?></h4>
                    <p>R$ <?= _toBrl($course->price); ?> </p>
                </a>
            </header>
            <a href="#" class="transition">
                <p>Aprenda tudo sobre a linguagem de programação mais popular da Web!</p>
            </a>
            <?php for ($i = 0; $i <= 4; $i++): ?>
                <img src="<?= theme("/assets/images/star.png"); ?>" class="img_star" title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>
                <?php
            endfor;
            ?>
        </article>
    <?php endforeach; ?>
</section>

<article class="main_optin">
    <div class="main_optin_content">
        <header>
            <h2>Quer receber todas as novidades diretamente no seu e-mail?</h2>
            <p>Informe o seu nome e e-mail nos campos ao lado e clique em Ok</p>
        </header>

        <form action="<?= url("/receber-noticias"); ?>" method="post" enctype="multipart/form-data">
            <input placeholder="Seu nome" type='text' id='clientName' name='clientName'>
            <input placeholder='Seu e-mail' type='email' id='clientMail' name='clientMail'>
            <input type='submit' value='Ok' class='btn transition'>
        </form>
    </div>
</article>

<?php require __DIR__ . "/school.php"; ?>

<div class='main_tutor'>
    <section class="main_content_school_tutor">
        <header>
            <h4>Conheça o <?= $tutor->name; ?></h4>    
        </header>

        <article class="main_content_school_tutor_description">
            <header>
                <h5>Seu tutor na jornada de desenvolvimento WEB.</h5>
                <div class="main_tutor_content_img">
                    <img src="<?= theme("/assets/images/eu.jpg"); ?>" alt="<?= $tutor->name; ?> seu tutor" title="<?= $tutor->name; ?> seu tutor">
                </div>
            </header>
            <p><?= $tutor->descriptionTutor; ?></p>
        </article>

        <article class="main_content_school_tutor_network">
            <header>
                <h5>Minhas redes sociais</h5>
            </header>

            <div class='tutor_social_network'>
                <h6 class="icon-facebook2">
                    <a  class="transition"
                        href="https://facebook.com/<?= CONF_SOCIAL_FACEBOOK_PAGE; ?>" target="_blank"
                        title="Facebook de <?= $tutor->name; ?>"
                        alt="Facebook de <?= $tutor->name; ?>"
                        >
                        Facebook
                    </a>
                </h6>
            </div>

            <div class='tutor_social_network'>
                <h6 class="icon-github">
                    <a href="https://github.com/<?= CONF_SOCIAL_GITHUB_PAGE; ?>"
                       class="transition" 
                       target="_blank" 
                       title="GitHub de <?= $tutor->name; ?>"
                       alt="GitHub de <?= $tutor->name; ?>"
                       >
                        GitHub
                    </a>
                </h6>
            </div>

            <div class='tutor_social_network'>
                <h6 class="icon-instagram">
                    <a href="https://instagram.com/<?= CONF_SOCIAL_INSTAGRAM_PAGE; ?>"
                       class="transition" 
                       target="_blank" 
                       title="Instagram de <?= $tutor->name; ?>"
                       alt="Instagram de <?= $tutor->name; ?>"
                       >
                        Instagram
                    </a>
                </h6>
            </div>
        </article>
    </section>
</div>
