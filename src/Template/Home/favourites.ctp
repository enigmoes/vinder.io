<?php
use Cake\Routing\Router;
?>
<div class="container mt-5">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar sidebar-default">
            <ul class="list-unstyled components2">
                <li class="bg-active">
                    <a href="<?=Router::url(['controller' => 'home', 'action' => 'index'])?>">
                        <i class="fas fa-chevron-left"></i><?=__('Favoritos')?>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>