<?php
use Cake\Routing\Router;
?>
<nav class="navbar navbar-default px-lg-5 px-2">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggler d-inline-block d-lg-none sidebar-button" type="button">
                <span class="navbar-toggler-icon">
                    <svg viewBox="0 0 16 16" class="bi bi-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </span>
            </button>
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
                <button id="button-input" class="btn btn-input-custom1 btn-search ml-3 mr-lg-3 mr-2 px-lg-3 px-2 py-md-0 py-1" type="submit">
                    <span class="d-md-block d-none"><?=__('Buscar')?></span><i class="fas fa-search d-md-none d-block"></i>
                </button>
                <button class="btn btn-input-custom2 btn-cancel px-lg-3 px-2 py-md-0 py-1" type="button">
                    <span class="d-md-block d-none"><?=__('Cancelar')?></span><i class="fas fa-times d-md-none d-block"></i>
                </button>         
            </div>
        </div>
        <ul class="nav navbar-right navbar-icons">
            <li class="mr-md-5 mr-4">
                <a href="javascript:void(0)" class="search-navbar">
                    <i class="fas fa-search"></i>
                </a>
            </li>
            <?php if ($this->request->controller == 'Items'): ?>
                <li class="mr-md-5 mr-4">
                    <a href="javascript:void(0)" class="add-navbar">
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
            <?php endif?>
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
        <?php endif?>
    </div>
</nav>