<?php
use Cake\Routing\Router;
?>
<div class="container mt-5">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar sidebar-default">
            <ul class="list-unstyled components2">
                <li class="bg-active">
                    <a href="#"><i class="fas fa-bookmark"></i><?=__('Mi lista')?></a>
                </li>
            </ul>
            <div class="sidebar-header">
                <div class="h5 h5-default"><?=__('FILTROS')?></div>
            </div>
            <ul class="list-unstyled components2">
                <li>
                    <a href="#"><i class="fas fa-star"></i><?=__('Favoritos')?></a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-tags"></i><?=__('Etiquetas')?></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="h4 h4-default"><?=__('MI LISTA')?></div>
            <div class="results"></div>
        </div>
    </div>
    <?=$this->Form->create()?>
    <?=$this->Form->end()?>
</div>
<?=$this->Html->script('home.js')?>