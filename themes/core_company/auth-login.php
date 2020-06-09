<?php $v->layout("_theme"); ?>
<article class="main_login">
    <header>
        <h2>Bem vindo(a)</h2>
    </header>
    <p>Insira os dados para realizar o login.</p>
</article>

<div class="main_login_form">
    <form method="post" enctype="multipart/form-data">
        <div class="main_login_campus">
            <label class="icon-mail3">Seu e-mail</label>
            <input type="email" name="email" id="email" required/>
            
            <label class="icon-key">Sua senha</label>
            <input type="password" name="password" id="password" required/>
        </div>
        <button class="btn-boot btn-boot-blue transition radius">Entrar</button>
    </form>
</div>
