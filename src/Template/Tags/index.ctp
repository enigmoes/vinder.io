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
                <div class="input-tags d-flex align-items-center">
                    <i class='fas fa-search search-icon'></i>
                    <?=$this->Form->control('text', [
                        'div' => false,
                        'label' => false,
                        'class' => 'form-control form-control-tags',
                    ])?>
                </div>
                <div class="results-tags"></div>
            </nav>
        </div>
        <div class="col-lg-10 col-12">
            <div class="results-items mt-4"></div>
        </div>
    </div>
</div>
<?=$this->Html->script('tags.js')?>