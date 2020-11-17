<?php
use Cake\Routing\Router;
?>
<div class="container min-vh-100 mt-5">
    <div class="row">
        <div class="col-lg-2 d-lg-block d-none">
            <!-- Sidebar -->
            <nav class="sidebar">
                <ul class="list-unstyled components2">
                    <li class="bg-active">
                        <a href="<?=Router::url(['controller' => 'items', 'action' => 'index'])?>">
                            <i class="fas fa-chevron-left"></i><?=__('Etiquetas')?>
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
                <div class="results-tags"></div>
            </nav>
        </div>
        <div class="col-lg-10 col-12">
            <div class="results-items"></div>
        </div>
    </div>
</div>
<div id="modal-tag-edit" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTag" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="h5 h5-modal m-0" id="modalTag"><?=__('Editar etiquetas')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body-edit d-flex justify-content-around my-3"></div>
        </div>
    </div>
</div>
<?=$this->Html->script('tags.js')?>