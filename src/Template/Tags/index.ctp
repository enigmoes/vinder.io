<?php
use Cake\Routing\Router;
?>
<div class="container min-vh-100 mt-lg-5 mt-md-1">
    <div class="row">
        <div class="col-lg-2 d-lg-block d-none">
            <nav class="sidebar">
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
        </div>
        <div class="col-lg-10 col-12">
            <button class="navbar-toggler d-inline-block d-lg-none mb-2" type="button" data-toggle="collapse" data-target="#sidebarTags" aria-controls="navbarSupportedContent" 
            aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <svg viewBox="0 0 16 16" class="bi bi-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </span>
            </button>
            <div class="collapse navbar-collapse d-lg-none" id="sidebarTags">
                <nav class="sidebar">
                    <div class="h5 h5-default text-uppercase"><?=__('Etiquetas')?></div>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled components2">
                                <li>
                                    <a href="javascript:void(0)" class="create-tag">
                                        <i class="fas fa-plus mr-2"></i><?=__('Añadir')?>
                                    </a>
                                </li>
                            </ul>
                            <?= $this->Form->create('search_tag') ?>
                            <div class="input-tags d-flex align-items-center">
                            <i class='fas fa-search search-icon'></i>
                            <?=$this->Form->control('text', [
                                'id' => false,
                                'div' => false,
                                'label' => false,
                                'class' => 'form-control form-control-tags',
                            ])?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="results-tags overflow-auto mb-3 col-6"></div>
                    </div>
                </nav>
            </div>
            <div class="results-items"></div>
        </div>
    </div>
</div>
<div id="modal-tag" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTag" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="h5 h5-modal m-0" id="modalTag"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-around my-3"></div>
        </div>
    </div>
</div>
<?=$this->Html->script('tags.js')?>