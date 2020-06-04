<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <?= $head; ?>
        <title>Core Company</title>
        <link rel="stylesheet" type="text/css" href="<?= theme("/assets/css/fonticon.css"); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= theme("/assets/css/boot.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?= theme("/assets/css/style.css"); ?>">
    </head>
    <body>
        <header class="header_main">
            <div class="header_main_content">        
                <nav class="header_main_content_menu">
                    <ul>
                        <li><a href="<?= url(); ?>" class="transition" title="Home">Home</a></li>
                        <li><a href="<?= url("/escola"); ?>" class="transition" title="A empresa">A Escola</a></li>
                        <li><a href="<?= url("/blog"); ?>" class="transition" title="Blog">Blog</a></li>
                        <li><a href="<?= url("/entrar"); ?>" class="transition" title="Entrar">Entrar</a></li>
                    </ul>
                </nav>

                <nav class="header_main_content_menu_mobile transition">
                    <ul>
                        <li>
                            <span class="main_header_content_menu_mobile_obj icon-menu icon icon-notext transition"></span>
                            <ul class="main_header_content_menu_mobile_sub transition ds_none">
                                <li><a href="<?= url(); ?>" class="transition" title="Home">Home</a></li>
                                <li><a href="<?= url("/escola"); ?>" class="transition" title="A empresa">A Escola</a></li>
                                <li><a href="<?= url("/blog"); ?>" class="transition" title="Blog">Blog</a></li>
                                <li><a href="<?= url("/entrar"); ?>" class="transition" title="Entrar">Entrar</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <?= $v->section("content"); ?>
        </main>

        <footer class="footer">
            <!-- CTA -->
            <div class='footer_cta'>
                <article class="footer_cta_header">
                    <header>
                        <h2>Quer receber o nosso conteúdo exclusivo? Assine nossa lista VIP :)</h2>
                    </header>

                    <h3><a href="<?= url("/lista-vip"); ?>" class="transition">Entrar para lista VIP</a></h3>
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
                        <li><a href="<?= url(); ?>" class="transition">Home</a></li>
                        <li><a href="<?= url("/escola"); ?>" class="transition">A Escola</a></li>
                        <li><a href="<?= url("/blog"); ?>" class="transition">Blog</a></li>
                        <li><a href="<?= url("/entrar"); ?>" class="transition">Entrar</a></li>
                    </ul>
                </article>

                <article class="footer_content_links">
                    <header>
                        <h3>Links úteis</h3>
                    </header>

                    <ul>
                        <li><a href="<?= url("/politicas"); ?>" class="transition">Política de privacidade</a></li>
                        <li><a href="<?= url("/aviso"); ?>" class="transition">Aviso Legal</a></li>
                        <li><a href="<?= url("/termos"); ?>" class="transition">Termos de uso</a></li>
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

        <script src="<?= theme("/assets/scripts/jquery.js"); ?>"></script>
        <script src="<?= theme("/assets/scripts/script.js"); ?>"></script>
    </body>
</html>