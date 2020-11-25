<?php
use Cake\Routing\Router;
?>
<nav class="navbar navbar-default px-5">
    <div class="container">
        <div class="navbar-header">
            <?php if ($this->request->controller != 'Users'): ?>
                <button class="navbar-toggler d-inline-block d-lg-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <?php endif?>
                <a class="navbar-brand" href="<?=Router::url(['controller' => 'items', 'action' => 'index'])?>">
                    <?=$this->Html->image('logotipo_35.png', array('alt' => 'vinder', 'class' => 'w-10'))?>
                </a>
        </div>
        <?php if ($this->request->controller != 'Users'): ?>
        <div id="input-custom" class="d-none">
            <div class="container-input-custom d-flex align-items-center px-4 py-1">
                <?=$this->Form->control('input', [
                    'label' => false,
                    'class' => 'input-custom',
                    'placeholder' => __('Buscar...'),
                ])?>
                <button id="button-input" class="btn ml-3 btn-input-custom1 btn-search mr-3 px-3 py-0" type="submit">
                    <?=__('Buscar')?>
                </button>
                <button class="btn btn-input-custom2 btn-cancel px-3 py-0" type="button">
                    <?=__('Cancelar')?>
                </button>         
            </div>
        </div>
        <ul class="nav navbar-right navbar-icons">
            <li class="mr-5">
                <a href="javascript:void(0)" class="search-navbar">
                    <i class="fas fa-search"></i>
                </a>
            </li>
            <li class="mr-5">
                <a href="javascript:void(0)" class="add-navbar">
                    <i class="fas fa-plus"></i>
                </a>
            </li>
            <li class="dropdown dropdown-custom">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-custom custom-shadow rounded-0">
                    <div class="dropdown-header d-flex justify-content-left align-items-center">
                        <?=$this->Html->image('user_52.png', array('alt' => 'imagen usuario', 'class' => 'user_img'))?>
                        <div class="h6 mb-0"><?= $this->request->getSession()->read('Auth.User.username') ?></div>
                    </div>
                    <div class="dropdown-divider dropdown-divider-custom"></div>
                    <a class="dropdown-item" href="<?=Router::url(['controller' => 'users', 'action' => 'profile'])?>">
                        <?=__('Ver perfil')?>
                    </a>
                    <a class="dropdown-item" href="<?=Router::url(['controller' => 'users', 'action' => 'logout'])?>">
                        <?=__('Cerrar sesión')?>
                    </a>
                </div>
            </li>
        </ul>
        <div class="collapse navbar-collapse d-lg-none mt-3" id="navbarSupportedContent">
            <?= $this->element('Common/sidebar') ?>
        </div>
        <?php endif?>
    </div>
</nav>