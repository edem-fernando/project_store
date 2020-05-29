<div class='main_school'>
    <section class="main_content_school">
        <header>
            <h2>Conheça mais a escola!</h2>
        </header>

        <article class="main_content_school_description">
            <header>
                <h4 class="icon-facebook2">
                    <a target="_blank" class='transition' href="<?= $manufacturer->getCeo()->getFacebookAccount(); ?>">
                        Facebook
                    </a>
                </h4>
                <h4 class="icon-instagram">
                    <a target="_blank" class=' transition' href="<?= $manufacturer->getCeo()->getInstagramAccount(); ?>">
                        Instagram
                    </a>
                </h4>
                <h4 class="icon-github">
                    <a target="_blank" class='transition' href="<?= $manufacturer->getCeo()->getFacebookAccount(); ?>">
                        GitHub
                    </a>
                </h4>
            </header>
            <p>
                Fundada em 2015, por nosso CEO <?= $user_ceo->name; ?>.
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
                    >
                        <?= $manufacturer->showAddress(); ?>
                </a>
            </p>
        </article>
    </section>
</div>