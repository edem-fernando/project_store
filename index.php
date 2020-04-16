<?php

require __DIR__ . '/source/autoload.php';


$ceo =  new \Source\People\Ceo("Edem Fernando Bastos","28-11-2000");
$ceo->setDescription(
        "Começei minha carreira na programação com os jogos de consoles antigos. "
        . "Após aprofundar os conhecimentos fui para o ramo da WEB. E me apaixonei!"
        );
$ceo->setFacebookAccount("<script>https://www.facebook.com/edem.fernando.7</script>");
$ceo->setInstagramAccount("<script>https://www.instagram.com/e.fernando123/</script>");

$manufacturer = new \Source\Company\Manufacturer("Core Company","Edução EAD");
$manufacturer->setAddress("Avenida Maia",22,"Litorânea");
$manufacturer->setCeo($ceo);

$products = [];
$products[0] = new Source\Company\Product("PHPFullStack", "730.50", $manufacturer);
$products[1] = new Source\Company\Product("HTML5 e CSS3", '249.55', $manufacturer);
$products[2] = new Source\Company\Product("jQuery", '349.99', $manufacturer);
$products[3] = new Source\Company\Product("Bootstrap", '249.55', $manufacturer);

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
                        <li><a href="#" title="Home">Blog Pessoal</a></li>
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
                        <h4><?=$products[0]->getDescription() ;?></h4>
                        <p>R$ <?=$products[0]->showFormatPrice() ;?> </p>
                    </header>
                    <p>Aprenda tudo sobre a linguagem de programação mais popular da Web!</p>
                    <?php for ($i=0; $i <= 4; $i++) { echo "<img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>"; } ?>
                </article>
                
                <article class="main_content_products">
                    <header>
                        <img src="_img/php.jpg" title="Curso de PHP" alt="Curso de PHP" class="img_course">
                        <h4><?=$products[1]->getDescription() ;?></h4>
                        <p>R$ <?=$products[1]->showFormatPrice() ;?></p>
                    </header>
                    <p>Conheça tudo sobre a linguagem de marcação mais importante da internet!</p>
                    <?php for ($i=0; $i <= 4; $i++) { echo "<img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>"; } ?>
                </article>
                
                <article class="main_content_products">
                    <header>
                        <img src="_img/php.jpg" title="Curso de PHP" alt="Curso de PHP">
                        <h4><?=$products[2]->getDescription() ;?></h4>
                        <p>R$ <?=$products[2]->showFormatPrice() ;?></p>
                    </header>
                    <p>Aprenda a manipular as interfaces de seus usuários com a biblioteca JavaScript mais famosa!</p>
                    <?php for ($i=0; $i <= 4; $i++) { echo "<img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>"; } ?>
                </article>
                
                <article class="main_content_products">
                    <header>
                        <img src="_img/php.jpg" title="Curso de PHP" alt="Curso de PHP">
                        <h4><?=$products[3]->getDescription() ;?></h4>
                        <p>R$ <?=$products[3]->showFormatPrice() ;?></p>
                    </header>
                    <p>Conheça tudo sobre a biblioteca CSS mais famosa do mundo, e crie interfaces fantásticas</p>
                    <?php for ($i=0; $i <= 4; $i++) { echo "<img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>"; } ?>
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
            
            <section class="main_content_school">
                <header>
                    <h2>Conheça um pouco mais sobre a escola</h2>
                </header>
                
                <article class="main_content_school_description">
                    <header>
                        <h4><?=$manufacturer->getName(); ?></h4>
                        <h4><?=$manufacturer->getCeo()->getName(); ?></h4>
                        <h4><?=$manufacturer->getSector(); ?></h4>
                    </header>
                    <p>
                        Fundada em 2015, por nosso CEO <?=$manufacturer->getCeo()->getName(); ?>.
                        O intuito, no começo, era ser escola EAD referência em ensino de programação e marketing digital no norte e Nordeste.
                        Hoje estamos crescendo cada dia mais, graças aos nossos esforços, e aos nossos queridos alunos.
                    </p>
                </article>
                
                <section class="main_content_school_awards">
                    <header>
                        <h4>Conheça nossos prêmios</h4>
                    </header>
                    
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
                </section>
                
                <article class="main_content_school_address">
                    <header>
                        <h4 class="icon-map2">Nos encontre</h4>
                    </header>
                    <p><?=$manufacturer->showAddress() ;?></p>
                </article>
                
                <section class="main_content_school_tutor">
                    <header>
                        <h4>Seu tutor na jornada de desenvolvedor WEB.</h4>
                    </header>
                    
                    <article class="main_content_school_tutor_description">
                        <header>
                            <h5><?=$manufacturer->getCeo()->getName() ;?></h5>
                            <p><?=$manufacturer->getCeo()->getDescription() ;?></p>
                        </header>
                    </article>
                    
                    <article class="main_content_school_tutor_network">
                        <header>
                            <h5>Minhas redes sociais</h5>
                        </header>
                        <h6 class="icon-facebook2">
                            <a href="<?=$manufacturer->getCeo()->getFacebookAccount() ;?>" target="_blank">Facebook</a>
                        </h6>
                        <h6 class="icon-google-plus2">
                            <a href="#" target="_blank">Google+</a>
                        </h6>
                        <h6 class="icon-instagram">
                            <a href="<?=$manufacturer->getCeo()->getInstagramAccount() ;?>" target="_blank">Instagram</a>
                        </h6>
                    </article>
                </section>
            </section>
        </main>
        
        <footer class="footer">
            <!-- CTA -->
            <article class="footer_header">
                <header>
                    <h2>Quer receber o nosso conteúdo exclusivo? Assine nossa lista VIP :)</h2>
                </header>
                
                <h3><a href="#">Entrar para lista VIP</a></h3>
            </article>
            
            <section class="footer_content">
                <header>
                    <h2>Quer saber mais?</h2>
                </header>
                
                <article class="footer_content_links">
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
        
        <script src="script/jquery.js"></script>
        <script src="script/script.js"></script>
    </body>
</html>