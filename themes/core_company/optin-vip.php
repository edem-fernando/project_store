<?php $v->layout("_theme"); ?>
<article class="main_login">
    <header>
        <h2>Faça parte da lista VIP!</h2>
    </header>
    <p>Cadastre-se na lista VIP e tenha acesso a conteúdos exclusivos :)</p>
</article>

<div class="main_login_form">
    <form method="post" enctype="multipart/form-data">
        <div class="main_login_campus">
            <label class="icon-user">Seu nome</label>
            <input type="text" name="name" id="name" required/>

            <label class="icon-mail3">Seu e-mail</label>
            <input type="email" name="email" id="email" required/>
        </div>
        <button class="btn-boot btn-boot-blue transition radius">Quero participar!</button>
    </form>
</div>