<?php
use Cake\Routing\Router;
?>
<!-- Sidebar -->
<nav class="sidebar">
    <div class="navbar-header d-lg-none d-block mb-5">
        <button class="btn close-sidebar p-0" type="button">
            <a href="javascript:void(0)">
                <i class="fas fa-times"></i>
            </a>
        </button>
        <a class="navbar-brand" href="<?=Router::url(['controller' => 'items', 'action' => 'index'])?>">
            <?=$this->Html->image('logotipo_35.png', array('alt' => 'vinder', 'class' => 'w-10'))?>
        </a>
    </div>
    <ul class="list-unstyled components2">
        <li <?=($this->request->controller == 'Items') ? 'class="bg-active"' : ''?>>
            <a href="<?=Router::url(['controller' => 'items', 'action' => 'index'])?>">
                <i class="fas fa-bookmark"></i><?=__('Mi lista')?>
            </a>
        </li>
    </ul>
    <div class="sidebar-header">
        <div class="h5 h5-default"><?=__('FILTROS')?></div>
    </div>
    <ul class="list-unstyled components2">
        <li <?=($this->request->controller == 'Favourites') ? 'class="bg-active"' : ''?>>
            <a href="<?=Router::url(['controller' => 'favourites', 'action' => 'index'])?>">
                <i class="fas fa-star"></i><?=__('Favoritos')?>
            </a>
        </li>
        <li <?=($this->request->controller == 'Tags') ? 'class="bg-active"' : ''?>>
            <a href="<?=Router::url(['controller' => 'tags', 'action' => 'index'])?>">
                <i class="fas fa-tags"></i><?=__('Etiquetas')?>
            </a>
        </li>
    </ul>
</nav>