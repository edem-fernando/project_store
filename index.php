<?php

require __DIR__ . '/source/autoload.php';


$ceo = new \Source\People\Ceo("Edem Fernando Bastos", "28-11-2000");
$ceo->setDescription(
        "Começei minha carreira na programação com os jogos de consoles antigos. "
        . "Após aprofundar os conhecimentos fui para o ramo da WEB. E me apaixonei!"
);
$ceo->setFacebookAccount("<script>https://www.facebook.com/edem.fernando.7</script>");
$ceo->setInstagramAccount("<script>https://www.instagram.com/e.fernando123/</script>");

$manufacturer = new \Source\Company\Manufacturer("Core Company", "Edução EAD");
$manufacturer->setAddress("Avenida Maia", 22, "Litorânea");
$manufacturer->setCeo($ceo);

$products = [];
$products[0] = new Source\Company\Product("PHPFullStack", "730.50", $manufacturer);
$products[1] = new Source\Company\Product("HTML5 e CSS3", '249.55', $manufacturer);
$products[2] = new Source\Company\Product("jQuery", '349.99', $manufacturer);
$products[3] = new Source\Company\Product("Bootstrap", '249.55', $manufacturer);

$user_ceo = new \Source\Models\Ceo();
$ceo_new = $user_ceo->search_by_cpf("61334419337");
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Core Company</title>
        <link rel="stylesheet" type="text/css" href="style/fonticon.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style/boot.css">
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <header class="header_main">
            <div class="header_main_content">
                <nav class="header_main_content_menu">
                    <ul>
                        <li><a href="#" title="Home">Home</a></li>
                        <li><a href="#" title="Home">A empresa</a></li>
                        <li><a href="#" title="Home">Contatos</a></li>
                        <li><a href="https://localhost/project_store/login" title="Home">Login</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <section class="main_content">
                <header>
                    <h2>Conheça nossos cursos</h2>
                </header>

                <article class="main_content_products">
                    <header>
                        <img src="_img/php.jpg" title="Curso de PHP" alt="Curso de PHP">
                        <h4><?= $products[0]->getDescription(); ?></h4>
                        <p>R$ <?= $products[0]->showFormatPrice(); ?> </p>
                    </header>
                    <p>Aprenda tudo sobre a linguagem de programação mais popular da Web!</p>
                    <?php 
                    
                    for ($i = 0; $i <= 4; $i++) {
                        echo "<img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>";
                    } 
                    
                    ?>
                </article>

                <article class="main_content_products">
                    <header>
                        <img src="_img/php.jpg" title="Curso de PHP" alt="Curso de PHP" class="img_course">
                        <h4><?= $products[1]->getDescription(); ?></h4>
                        <p>R$ <?= $products[1]->showFormatPrice(); ?></p>
                    </header>
                    <p>Conheça tudo sobre a linguagem de marcação mais importante da internet!</p>
                    <?php 
                    
                    for ($i = 0; $i <= 4; $i++) {
                        echo "<img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>";
                    } 
                    
                    ?>
                </article>

                <article class="main_content_products">
                    <header>
                        <img src="_img/php.jpg" title="Curso de PHP" alt="Curso de PHP">
                        <h4><?= $products[2]->getDescription(); ?></h4>
                        <p>R$ <?= $products[2]->showFormatPrice(); ?></p>
                    </header>
                    <p>Aprenda a manipular as interfaces de seus usuários com a biblioteca JavaScript mais famosa!</p>
                    <?php 
                    
                    for ($i = 0; $i <= 4; $i++) {
                        echo "<img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>";
                    } 
                    
                    ?>
                </article>

                <article class="main_content_products">
                    <header>
                        <img src="_img/php.jpg" title="Curso de PHP" alt="Curso de PHP">
                        <h4><?= $products[3]->getDescription(); ?></h4>
                        <p>R$ <?= $products[3]->showFormatPrice(); ?></p>
                    </header>
                    <p>Conheça tudo sobre a biblioteca CSS mais famosa do mundo, e crie interfaces fantásticas</p>
                    <?php 
                    
                    for ($i = 0; $i <= 4; $i++) {
                        echo "<img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>";
                    } 
                    
                    ?>
                </article>
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
                        <input type='button' value='Ok' class='btn'>
                    </form>
                </div>
            </article>

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
                            Fundada em 2015, por nosso CEO <?= $ceo_new->nome; ?>.
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

            <div class='main_tutor'>
                <section class="main_content_school_tutor">
                    <header>
                        <h4>Conheça o <?= $manufacturer->getCeo()->getName(); ?></h4>    
                    </header>

                    <article class="main_content_school_tutor_description">
                        <header>
                            <h5>Seu tutor na jornada de desenvolvimento WEB.</h5>
                            <div class="main_tutor_content_img">
                                <img src="_img/eu.jpg" alt="<?= $manufacturer->getCeo()->getName(); ?> seu tutor" title="<?= $manufacturer->getCeo()->getName(); ?> seu tutor">
                            </div>
                        </header>
                        <p><?= $manufacturer->getCeo()->getDescription(); ?></p>
                    </article>

                    <article class="main_content_school_tutor_network">
                        <header>
                            <h5>Minhas redes sociais</h5>
                        </header>

                        <div class='tutor_social_network'>
                            <h6 class="icon-facebook2">
                                <a 
                                    href="<?= $manufacturer->getCeo()->getFacebookAccount(); ?>" target="_blank"
                                    title="Facebook de <?= $manufacturer->getCeo()->getName(); ?>"
                                    alt="Facebook de <?= $manufacturer->getCeo()->getName(); ?>"
                                    >
                                    Facebook
                                </a>
                            </h6>
                        </div>

                        <div class='tutor_social_network'>
                            <h6 class="icon-google-plus2">
                                <a href="#" target="_blank">Google+</a>
                            </h6>
                        </div>

                        <div class='tutor_social_network'>
                            <h6 class="icon-instagram">
                                <a alt="Instagram de <?= $manufacturer->getCeo()->getName(); ?>" 
                                   title="Instagram de <?= $manufacturer->getCeo()->getName(); ?>" 
                                   href="<?= $manufacturer->getCeo()->getInstagramAccount(); ?>" target="_blank"
                                   >Instagram</a>
                            </h6>
                        </div>
                    </article>
                </section>
            </div>
        </main>

        <footer class="footer">
            <!-- CTA -->
            <div class='footer_cta'>
                <article class="footer_cta_header">
                    <header>
                        <h2>Quer receber o nosso conteúdo exclusivo? Assine nossa lista VIP :)</h2>
                    </header>

                    <h3><a href="#">Entrar para lista VIP</a></h3>
                </article>
            </div>

            <section class="footer_content">
                <header>
                    <h2>Quer saber mais?</h2>
                </header>

                <article class="footer_content_menu">
                    <header>
                        <h3>Nossas páginas</h3>
                    </header>

                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">A Escola</a></li>
                        <li><a href="#">Contato</a></li>
                    </ul>
                </article>

                <article class="footer_content_links">
                    <header>
                        <h3>Links úteis</h3>
                    </header>

                    <ul>
                        <li><a href="#">Política de privacidade</a></li>
                        <li><a href="#">Aviso Legal</a></li>
                        <li><a href="#">Termos de uso</a></li>
                    </ul>
                </article>

                <article class="footer_content_about">
                    <header>
                        <h3>Sobre o projeto</h3>
                    </header>

                    <p>
                        Desenvolva todas as habilidades necessárias, que o mercado precisa que um desenvolvedor WEB saiba.
                    </p>
                </article>
            </section>
        </footer>

        <div class="footer_rigths">
            <p>Todos os direitos reservados à Core Company ®</p>
        </div>
        
        <!-- modal -->
        <div class="modal">
            <div class="modal_form">
                <span class="close_modal">X</span>
                <form>
                    <input typ="text" id="name_client" class="name_client" placeholder="Seu nome completo"/>
                    <input typ="text" id="cpf_client" class="cpf_client" placeholder="Seu CPF"/>
                    
                    <label for="date_client">Sua data de nascimento</label>
                    <input type="date" id="date_client" class="date_client" max="<?=date("Y-m-d");?>" value="<?=date("Y-m-d");?>">
                    
                    <input type="text" id="cep_client" class="cep_client" placeholder="Seu CEP"/>
                    <input type="text" id="uf_client" placeholder="Seu estado"/>
                    <input type="text" id="city_client" placeholder="Sua cidade"/>
                    <input type="text" id="neighborhood_client" placeholder="Seu bairro"/>
                    <input type="text" id="street_client" placeholder="Sua rua"/>
                    <input type="text" id="number_client" placeholder="N°"/>
                    <textarea class="complement_client" id="complement_client">Complemento</textarea>
                    
                    <label for="form_payment">Forma de pagamento</label>
                    <select class="form_payment" id="form_payment">
                        <option value="cred_cart">Cartão de crédito</option>
                        <option value="debit_cart">Cartão de débito</option>
                        <option value="billet">Boleto bancário</option>
                        <option value="bank_transfer">Transferência bancária</option>
                    </select>
                    
                    <button class="btn_purchase">Comprar</button>
                    <button class="btn_close">Fechar</button>
                </form>
            </div>
        </div>

        <script src="script/jquery.js"></script>
        <script src="script/script.js"></script>
    </body>
</html>