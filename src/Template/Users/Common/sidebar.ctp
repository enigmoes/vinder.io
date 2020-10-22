<?php
use Cake\Routing\Router;
?>
<!-- Sidebar -->
<nav class="sidebar">
    <div class="sidebar-header">
        <div id="nav1-h5" class="h6 h6-title"><?= $this->request->getSession()->read('Auth.User.email') ?></div>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="<?=Router::url(['controller' => 'home', 'action' => 'index'])?>"><?=__('Ir a mi lista')?></a>
        </li>
        <li>
            <a href="<?=Router::url(['controller' => 'users', 'action' => 'logout'])?>"><?=__('Cerrar sesión')?></a>
        </li>
    </ul>
    <div class="sidebar-header">
        <div id="nav2-h5" class="h6 h6-title"><?=__('Opciones')?></div>
    </div>
    <ul id="lista" class="list-unstyled components">
        <li id="perfil">
            <a href="<?=Router::url(['controller' => 'users', 'action' => 'profile'])?>">
                <?=__('Editar perfil')?>
            </a>
        </li>
        <li id="correo">
            <a href="<?=Router::url(['controller' => 'users', 'action' => 'email'])?>">
                <?=__('Editar correo')?>
            </a>
        </li>
        <li id="pass">
            <a href="<?=Router::url(['controller' => 'users', 'action' => 'password'])?>">
                <?=__('Editar contraseña')?>
            </a>
        </li>
    </ul>
</nav>