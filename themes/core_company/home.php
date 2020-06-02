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

        <form>
            <input placeholder="Seu nome" type='text' id='clientName' name='clientName'>
            <input placeholder='Seu e-mail' type='email' id='clientMail' name='clientMail'>
            <input type='button' value='Ok' class='btn transition'>
        </form>
    </div>
</article>

<div class='main_school'>
    <section class="main_content_school">
        <header>
            <h2>Conheça mais a escola!</h2>
        </header>

        <article class="main_content_school_description">
            <header>
                <h4 class="icon-facebook2">
                    <a target="_blank" class='transition' href="https://facebook.com/<?= CONF_SOCIAL_FACEBOOK_PAGE; ?>">
                        Facebook
                    </a>
                </h4>
                <h4 class="icon-instagram">
                    <a target="_blank" class=' transition' href="https://instagram.com/<?= CONF_SOCIAL_INSTAGRAM_PAGE; ?>">
                        Instagram
                    </a>
                </h4>
                <h4 class="icon-github">
                    <a target="_blank" class='transition' href="https://github.com/<?= CONF_SOCIAL_GITHUB_PAGE ?>">
                        GitHub
                    </a>
                </h4>
            </header>
            <p>
                Fundada em 2015, por nosso CEO <?= $ceo->name; ?>.
                O intuito, no começo, era ser escola EAD referência em ensino de programação e marketing digital no norte e Nordeste.
                Hoje estamos crescendo cada dia mais, graças aos nossos esforços, e aos nossos queridos alunos.
            </p>
        </article>

        <section class="main_content_school_awards">
            <header>
                <h4>Conheça nossos prêmios</h4>
            </header>

            <div class='box_awards'>
                <article>
                    <header>
                        <h5 class='icon-trophy'>Qualidade e Excelência - Master Pesquisas</h5>
                    </header>
                </article>

                <article>
                    <header>
                        <h5 class='icon-trophy'>Prêmio Diamante - Master Pesquisas</h5>
                    </header>
                </article>

                <article>
                    <header>
                        <h5 class='icon-trophy'>Medalha de Ouro a Excelência - LAQI</h5>
                    </header>
                </article>

                <article>
                    <header>
                        <h5 class='icon-trophy'>Melhor Plataforma EAD - Digital Awards</h5>
                    </header>
                </article>

                <article>
                    <header>
                        <h5 class='icon-trophy'>Qualidade e Atendimento - Master Pesquisas</h5>
                    </header>
                </article>

                <article>
                    <header>
                        <h5 class='icon-trophy'>Estrela do Sul - Master Pesquisas</h5>
                    </header>
                </article>

                <article>
                    <header>
                        <h5 class='icon-trophy'>Brazil Quality Certification - LAQI</h5>
                    </header>
                </article>

                <article>
                    <header>
                        <h5 class='icon-trophy'>America Latina Qualification - LAQI</h5>
                    </header>
                </article>
            </div>
        </section>

        <section class="main_content_school_about">
            <header class="main_content_school_header">
                <h4>Sobre a Escola!</h4>
            </header>

            <article class="radius">
                <header>
                    <h2>Cursos 100% online</h2>
                    <p>
                        Todas as aulas são gravadas em estúdio profissional
                        para que você tenha a máxima qualidade de imagem e vídeo
                    </p>
                </header>
            </article>

            <article class="radius">
                <header>
                    <h2>Suporte Especializado</h2>
                    <p>Nossos cursos possuem suporte diretamente com um profissional da nossa equipe oficial</p>
                </header>
            </article>

            <article class="radius">
                <header>
                    <h2>Mais de 1000 aulas dividas em mais de 10 módulos</h2>
                    <p>
                        A modularização que você precisa para compreender de maneira
                        mais objetiva
                    </p>
                </header>
            </article>

            <article class="radius">
                <header>
                    <h2>Certificados reconhecidos em mais de 17 países</h2>
                    <p>Ao concluir os cursos você terá certificados com reconhecimento em diversos países da América Latina</p>
                </header>
            </article>
        </section>

        <article class="main_content_school_address">
            <header>
                <h4 class="icon-map2">Nos encontre</h4>
            </header>
            <p>
                <a  title='nosso endereço' alt='nosso endereço' 
                    href="https://www.google.com/maps/search/Avenida+Maia,+N%C2%BA+22,+bairro+Litor%C3%A2nea/@-2.5062442,-44.2953628,14z/data=!3m1!4b1"
                    target="a_blank"
                    class="transition"
                    ><?= CONF_COMPANY_ADDRESS; ?>
                </a>
            </p>
        </article>
    </section>
</div>

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
