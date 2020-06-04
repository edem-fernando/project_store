<?php $v->layout("_theme"); ?>
<article class="main_login">
    <header>
        <h2>Bem vindo(a)</h2>
    </header>

    <div class="main_login_login">
        <form method="post" enctype="multipart/form-data">
            <div class="main_login_campus">
                <label for="email" class="icon-mail">Seu e-mail</label>
                <input type="email" id="email" name="email"/>
            </div>

            <div class="main_login_campus">
                <label for="password" class="icon-key">Sua senha</label>
                <input type="password" id="password" name="password" />
            </div>

            <button class="btn-boot btn-boot-blue radius" class="btn-boot btn-boot-blue radius">Entrar</button>
        </form>
    </div>
</article>