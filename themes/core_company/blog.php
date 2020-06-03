<?php $v->layout("_theme"); ?>
<article class="main_blog container">
    <header>
        <h2>Blog</h2>
        <p>Confira dicas e sacadas para aumentar a sua produtividade na programação!</p>
    </header>

    <section class="main_blog_content">
        <header>
            <h3 class="ds_none">Confira nosso blog</h3>
        </header>
        <?php for ($i = 0; $i <= 8; $i++): ?>
            <article>
                <header>
                    <a class="transition" title="Post" href="<?= url("/blog/titulo-post"); ?>">
                        <img class="radius" src="<?= theme("/assets/images/blog.png"); ?>"/>
                    </a>
                    <h4><a class="transition" title="Post" href="<?= url("/blog/titulo-post"); ?>">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a></h4>
                </header>
                <p><a class="transition" title="Post" href="<?= url("/blog/titulo-post"); ?>">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet autem cumque dolores eos, illo magni minus nam nulla pariatur, rem rerum tempora velit veritatis.</a></p>
            </article>
        <?php endfor; ?>

        <nav class="paginator">
            <a class='paginator_item transition' title="Primeira página" href="https://www.localhost/fsphp/blog/page/1"><<</a>
            <span class="paginator_item paginator_active">1</span>
            <a class='paginator_item transition' title="Página 2" href="#">2</a>
            <a class='paginator_item transition' title="Página 3" href="#">3</a>
            <a class='paginator_item transition' title="Página 4" href="#">4</a>
            <a class='paginator_item transition' title="Última página" href="#">>></a>
        </nav> 
    </section>
</article>