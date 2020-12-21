<?php
use Cake\Routing\Router;
?>
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
        <li class="bg-active">
            <a href="<?=Router::url(['controller' => 'items', 'action' => 'index'])?>">
                <i class="fas fa-chevron-left"></i><?=__('Etiquetas')?>
            </a>
        </li>
        <li class="mt-3">
            <a href="javascript:void(0)" class="create-tag" data-title="<?=__('Añadir etiqueta')?>">
                <i class="fas fa-plus mr-2"></i><?=__('Añadir')?>
            </a>
        </li>
        <li class="mt-3">
            <a href="javascript:void(0)" class="all-tags px-2 bg-active">
                <?=__('Todos los ítems')?>
            </a>
        </li>
        <li class="mt-3">
            <a href="javascript:void(0)" class="empty-tags px-2">
                <?=__('Sin etiquetar')?>
            </a>
        </li>
    </ul>
    <?= $this->Form->create('search_tag') ?>
    <div class="input-tags d-flex align-items-center">
        <i class='fas fa-search search-icon'></i>
        <?=$this->Form->control('text', [
            'div' => false,
            'label' => false,
            'class' => 'form-control form-control-tags',
        ])?>
    </div>
    <?= $this->Form->end() ?>
    <div class="results-tags overflow-auto"></div>
</nav>