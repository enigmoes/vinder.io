<?php
use Cake\Routing\Router;
?>
<!-- Sidebar -->
<nav class="sidebar">
    <div class="sidebar-header">
        <div class="h6 h6-title font-weight-bold border-bottom-custom">
            <?= $this->request->getSession()->read('Auth.User.email') ?>
        </div>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="<?=Router::url(['controller' => 'items', 'action' => 'index'])?>"><?=__('Ir a mi lista')?></a>
        </li>
        <li>
            <a href="<?=Router::url(['controller' => 'users', 'action' => 'logout'])?>"><?=__('Cerrar sesión')?></a>
        </li>
    </ul>
    <div class="sidebar-header">
        <div class="h6 mt-5 font-weight-bold h6-title border-bottom-custom"><?=__('Opciones')?></div>
    </div>
    <ul class="list-unstyled components">
        <li <?=($this->request->action == 'profile') ? 'class="active"' : ''?>>
            <a href="<?=Router::url(['controller' => 'users', 'action' => 'profile'])?>">
                <?=__('Editar perfil')?>
            </a>
        </li>
        <li <?=($this->request->action == 'email') ? 'class="active"' : ''?>>
            <a href="<?=Router::url(['controller' => 'users', 'action' => 'email'])?>">
                <?=__('Editar correo')?>
            </a>
        </li>
        <li <?=($this->request->action == 'password') ? 'class="active"' : ''?>>
            <a href="<?=Router::url(['controller' => 'users', 'action' => 'password'])?>">
                <?=__('Editar contraseña')?>
            </a>
        </li>
    </ul>
</nav>