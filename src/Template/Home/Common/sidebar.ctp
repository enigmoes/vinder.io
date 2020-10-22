<?php
use Cake\Routing\Router;
?>
<!-- Sidebar -->
<nav class="sidebar">
    <ul class="list-unstyled components2">
        <li <?=($this->request->controller == 'Home') ? 'class="bg-active"' : ''?>>
            <a href="<?=Router::url(['controller' => 'home', 'action' => 'index'])?>">
                <i class="fas fa-bookmark"></i><?=__('Mi lista')?>
            </a>
        </li>
    </ul>
    <div class="sidebar-header">
        <div class="h5 h5-default"><?=__('FILTROS')?></div>
    </div>
    <ul class="list-unstyled components2">
        <li>
            <a href="<?=Router::url(['controller' => 'home', 'action' => 'favourites'])?>">
                <i class="fas fa-star"></i><?=__('Favoritos')?>
            </a>
        </li>
        <li>
            <a href="<?=Router::url(['controller' => 'home', 'action' => 'tags'])?>">
                <i class="fas fa-tags"></i><?=__('Etiquetas')?>
            </a>
        </li>
    </ul>
</nav>