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
        <?php for ($i = 0; $i <= 4; $i++): ?>
            <img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>
            <?php
        endfor;
        ?>
    </article>

    <article class="main_content_products">
        <header>
            <img src="_img/html5css3.png" title="Curso de HTML5 e CSS3" alt="Curso de HTML5 e CSS3" class="img_course">
            <h4><?= $products[1]->getDescription(); ?></h4>
            <p>R$ <?= $products[1]->showFormatPrice(); ?></p>
        </header>
        <p>Conheça tudo sobre a linguagem de marcação mais importante da internet!</p>
        <?php for ($i = 0; $i <= 4; $i++): ?>
            <img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>
            <?php
        endfor;
        ?>
    </article>

    <article class="main_content_products">
        <header>
            <img src="_img/jquery2.png" title="Curso de jQuery" alt="Curso de jQuery">
            <h4><?= $products[2]->getDescription(); ?></h4>
            <p>R$ <?= $products[2]->showFormatPrice(); ?></p>
        </header>
        <p>Aprenda a manipular as interfaces de seus usuários com a biblioteca JavaScript mais famosa!</p>
        <?php for ($i = 0; $i <= 4; $i++): ?>
            <img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>
            <?php
        endfor;
        ?>
    </article>

    <article class="main_content_products">
        <header>
            <img src="_img/bootstrap.png" title="Curso de Bootstrap" alt="Curso de Bootstrap">
            <h4><?= $products[3]->getDescription(); ?></h4>
            <p>R$ <?= $products[3]->showFormatPrice(); ?></p>
        </header>
        <p>Conheça tudo sobre a biblioteca CSS mais famosa do mundo, e crie interfaces fantásticas</p>
        <?php for ($i = 0; $i <= 4; $i++): ?>
            <img src='_img/star.png' title='Avaliação dos nossos alunos' alt='Avaliação dos nossos alunos'>
            <?php
        endfor;
        ?>
    </article>
</section>