<?php $v->layout("_theme"); ?>
<article class="main_login">
    <header>
        <h2>Faça parte da lista VIP!</h2>
    </header>

    <div class="main_login_login">
        <form method="post" action="<?= url("/lista-vip/link"); ?>" enctype="multipart/form-data">
            <div class="main_login_campus">
                <label for="optinName" class="icon-user">Seu nome</label>
                <input type="text" id="optinName" name="optinName"/>
            </div>

            <div class="main_login_campus">
                <label for="optinEmail" class="icon-mail">Seu email</label>
                <input type="email" id="optinEmail" name="optinEmail" />
            </div>

            <button class="btn-boot btn-boot-blue radius" class="btn-boot btn-boot-blue radius">Quero participar!</button>
        </form>
    </div>
</article>