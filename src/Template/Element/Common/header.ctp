<?php
use Cake\Routing\Router;
?>
<nav class="navbar navbar-default">
    <div class="navbar-header pl-5">
        <button class="navbar-toggler d-block d-lg-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <?=$this->Html->image('logotipo_35.png', array('alt' => 'vinder', 'class' => 'w-10'))?>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?= $this->element('Common/sidebar') ?>
        </div>
    </div>
    <?php if ($this->request->getSession()->check('Auth.User.id')): ?>
    <div id="input-custom" class="d-none">
        <div class="container-input-custom d-flex align-items-center px-4 py-1">
            <?=$this->Form->control('input', [
                'label' => false,
                'class' => 'input-custom',
                'placeholder' => __('Buscar...'),
            ])?>
            <button class="btn ml-3 btn-input-custom1 mr-3 px-3 py-0" type="submit">
                <?=__('Buscar')?>
            </button>
            <button class="btn btn-input-custom2 px-3 py-0" type="button">
                <?=__('Cancelar')?>
            </button>         
        </div>
    </div>
    <ul class="nav navbar-right pr-5 navbar-icons">
        <li>
            <a href="#">
                <i class="fas fa-search"></i>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-plus"></i>
            </a>
        </li>
        <li class="dropdown dropdown-custom">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-custom custom-shadow rounded-0">
                <div class="dropdown-header d-flex justify-content-left align-items-center">
                    <?=$this->Html->image('user_52.png', array('alt' => 'imagen usuario', 'class' => 'user_img'))?>
                    <div class="h6"><?=__('Hola')?></div>
                </div>
                <div class="dropdown-divider dropdown-divider-custom"></div>
                <a class="dropdown-item" href="<?=Router::url(['controller' => 'users', 'action' => 'account'])?>">
                    <?=__('Ver perfil')?>
                </a>
                <a class="dropdown-item" href="<?=Router::url(['controller' => 'users', 'action' => 'logout'])?>">
                    <?=__('Cerrar sesión')?>
                </a>
            </div>
        </li>
    </ul>
    <?php endif?>
</nav>