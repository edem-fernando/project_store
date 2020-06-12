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
                <label class="icon-user">Nome</label>
                <input type="text" name="name" id="email" placeholder="Informe o seu nome"/>
            </div>

            <div class="main_login_campus">
                <label class="icon-envelop">Senha:</label>
                <input type="email" name="email" id="email" placeholder="Informe o seu email"/>
            </div>
            <button class="btn-boot btn-boot-blue transition radius">Quero participar</button>
        </form>
    </div>
</div>
