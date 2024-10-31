<?php if (session()->has('mensagem')): ?>
    <div class="alert alert-success" role="alert">
        <h1><?= session('mensagem') ?></h1>
    </div>

    <?php if (session('status')==99): ?>
        <a href="<?= base_url('dashboard')?>"> Voltar ao início</a>
    <?php else: ?>        
        <a href="<?= base_url('home')?>"> Voltar ao início</a>
    <?php endif ?>            

<?php endif; ?>
