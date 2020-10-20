<?php
use Cake\Routing\Router;
?>
<!-- Sidebar -->
<nav class="sidebar sidebar-default">
    <div class="sidebar-header">
        <div id="nav1-h5" class="h5 h5-custom"><?=h($user->email)?></div>
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
        <div id="nav2-h5" class="h5 h5-custom"><?=__('Opciones')?></div>
    </div>
    <ul id="lista" class="list-unstyled components">
        <li id="perfil" class="active">
            <a href="#"><?=__('Editar perfil')?></a>
        </li>
        <li id="correo">
            <a href="#"><?=__('Editar correo')?></a>
        </li>
        <li id="pass">
            <a href="#"><?=__('Editar contraseña')?></a>
        </li>
    </ul>
</nav>