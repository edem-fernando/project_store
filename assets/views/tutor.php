<div class='main_tutor'>
    <section class="main_content_school_tutor">
        <header>
            <h4>Conheça o <?= $user_tutor->name; ?></h4>    
        </header>

        <article class="main_content_school_tutor_description">
            <header>
                <h5>Seu tutor na jornada de desenvolvimento WEB.</h5>
                <div class="main_tutor_content_img">
                    <img src="_img/eu.jpg" alt="<?= $user_tutor->name; ?> seu tutor" title="<?= $user_tutor->name; ?> seu tutor">
                </div>
            </header>
            <p><?= $user_tutor->descriptionTutor; ?></p>
        </article>

        <article class="main_content_school_tutor_network">
            <header>
                <h5>Minhas redes sociais</h5>
            </header>

            <div class='tutor_social_network'>
                <h6 class="icon-facebook2">
                    <a  class="transition"
                        href="<?= $manufacturer->getCeo()->getFacebookAccount(); ?>" target="_blank"
                        title="Facebook de <?= $manufacturer->getCeo()->getName(); ?>"
                        alt="Facebook de <?= $manufacturer->getCeo()->getName(); ?>"
                        >
                        Facebook
                    </a>
                </h6>
            </div>

            <div class='tutor_social_network'>
                <h6 class="icon-github">
                    <a href="#" class="transition" target="_blank" title="GitHub">GitHub</a>
                </h6>
            </div>

            <div class='tutor_social_network'>
                <h6 class="icon-instagram">
                    <a class="transition" alt="Instagram de <?= $manufacturer->getCeo()->getName(); ?>" 
                       title="Instagram de <?= $manufacturer->getCeo()->getName(); ?>" 
                       href="<?= $manufacturer->getCeo()->getInstagramAccount(); ?>" target="_blank"
                       >Instagram</a>
                </h6>
            </div>
        </article>
    </section>
</div>