<?php
use Cake\Routing\Router;
?>
<?php if (isset($items) && count($items) > 0): ?>
<?php foreach ($items as $item): ?>
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card card-items rounded-0">
            <div class="card-body card-block">
                <div class="h6 h6-default"><?=h($item->title)?></div>
                <a href="#"><?=h($item->link)?></a>
                <p><?=h($item->description)?></p>
                <div class="items-icons dropup">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-share-square"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-custom custom-shadow rounded-0">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-link"></i><?=__('Copiar enlace')?>
                        </a>
                        <a class="dropdown-item" href="<?=Router::url(['facebook.com'])?>">
                            <i class="fab fa-facebook-f"></i><?=__('Facebook')?>
                        </a>
                        <a class="dropdown-item" href="<?=Router::url(['twitter.com'])?>">
                            <i class="fab fa-twitter"></i><?=__('Twitter')?>
                        </a>
                    </div>
                    <a href="#"><i class="fas fa-tag"></i></a>
                    <a href="#" class="favItem"><i class="fas fa-star"></i></a>
                    <a href="#" class="deleteItem"
                    data-url="<?= Router::url(['controller' => 'home', 'action' => 'delete', $item->id]) ?>"
                    data-message="<?= __('¿Seguro que desea eliminar?') ?>"
                    data-ok="<?= __('Aceptar') ?>"
                    data-cancel="<?= __('Cancelar') ?>">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach?>
<?php endif?>