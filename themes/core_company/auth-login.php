<?php $v->layout("_theme"); ?>
<article class="main_login">
    <header>
        <h2>Fazer login</h2>
    </header>
    <p>Insira os dados para realizar o login.</p>
</article>

<div class="container">
    <div class="main_login_form_content">
        <form method="post" enctype="multipart/form-data">
            <div class="main_login_campus">
                <label class="icon-envelop">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="Informe o seu e-mail"/>
            </div>

            <div class="main_login_campus">
                <label class="icon-key">Senha:</label>
                <input type="password" name="password" id="password" placeholder="Informe a sua senha"/>
            </div>
            <button class="btn-boot btn-boot-blue transition radius">Entrar</button>
        </form>
    </div>
</div>
