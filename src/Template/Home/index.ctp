<?php
use Cake\Routing\Router;
?>
<div class="container mt-5">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar sidebar-default">
            <div class="sidebar-header">
                <div id="nav1-h5" class="h5 h5-custom"></div>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <i class="fas fa-bookmark"></i><a href="#"><?=__('Mi lista')?></a>
                </li>
            </ul>
            <div class="sidebar-header">
                <div class="h5 h5-custom"><?=__('FILTROS')?></div>
            </div>
            <ul class="list-unstyled components">
                <li id="correo">
                    <i class="fas fa-star"></i><a href="#"><?=__('Favoritos')?></a>
                </li>
                <li id="pass">
                    <i class="fas fa-tags"></i><a href="#"><?=__('Etiquetas')?></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="results"></div>
</div>
