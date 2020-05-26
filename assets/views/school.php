<div class='main_school'>
    <section class="main_content_school">
        <header>
            <h2>Conheça um pouco mais sobre a escola</h2>
        </header>

        <article class="main_content_school_description">
            <header>
                <h4>
                    <a class='icon-facebook2' href="<?= $manufacturer->getCeo()->getFacebookAccount(); ?>">
                        Facebook
                    </a>
                </h4>
                <h4>
                    <a class='icon-instagram' href="<?= $manufacturer->getCeo()->getInstagramAccount(); ?>">Instagram</a></h4>
                <h4>
                    <a class='icon-trello' href="<?= $manufacturer->getCeo()->getFacebookAccount(); ?>">
                        Trello
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

        <article class="main_content_school_address">
            <header>
                <h4 class="icon-map2">Nos encontre</h4>
            </header>
            <p>
                <a  title='nosso endereço' alt='nosso endereço' 
                    href="https://www.google.com/maps/search/Avenida+Maia,+N%C2%BA+22,+bairro+Litor%C3%A2nea/@-2.5062442,-44.2953628,14z/data=!3m1!4b1"
                    target="a_blank"
                    >
                        <?= $manufacturer->showAddress(); ?>
                </a>
            </p>
        </article>
    </section>
</div>