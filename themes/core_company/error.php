<?php $v->layout("_theme"); ?>
<article class="error_page_404">
    <header>
        <p class="error">&bull;<?= $error->code; ?>&bull;</p>
        <h2><?= $error->title; ?></h2>
        <p><?= $error->message; ?></p>
        <?php if ($error->link != null): ?> 
            <a class="transition radius"
               title="<?= $error->linkTitle; ?>" href="<?= $error->link; ?>"><?= $error->linkTitle; ?></a>
           <?php endif; ?>
    </header>
</article>