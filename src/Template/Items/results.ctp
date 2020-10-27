<?php
use Cake\Routing\Router;
?>
<?php if (isset($lists) && count($lists) > 0): ?>
    <?php foreach ($lists as $list): ?>
        <div class="row">
            <?php foreach ($list->items as $item): ?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card card-items rounded-0">
                        <div class="card-body card-block">
                            <div class="h6 h6-default"><?= $item->title ?></div>
                            <a href="<?= $item->link ?>"><?= $item->link ?></a>
                            <p class="small"><?= $item->description ?></p>
                            <div class="items-icons dropup">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-share-square"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-custom custom-shadow rounded-0">
                                    <a class="dropdown-item copyLink" href="javascript:void(0)"
                                    data-url="<?= $item->link ?>">
                                        <i class="fas fa-link"></i><?=__('Copiar enlace')?>
                                    </a>
                                    <a class="dropdown-item" href="facebook.com">
                                        <i class="fab fa-facebook-f"></i><?=__('Facebook')?>
                                    </a>
                                    <a class="dropdown-item" href="twitter.com">
                                        <i class="fab fa-twitter"></i><?=__('Twitter')?>
                                    </a>
                                </div>
                                <a href="javascript:void(0)"><i class="fas fa-tag"></i></a>
                                <a href="javascript:void(0)" class="favItem <?= ($item->is_fav) ? 'isFav' : '' ?>"
                                data-url="<?= Router::url(['controller' => 'items', 'action' => 'is_fav', $item->id]) ?>">
                                    <i class="fas fa-star"></i>
                                </a>
                                <a href="javascript:void(0)" class="deleteItem"
                                data-url="<?= Router::url(['controller' => 'items', 'action' => 'delete', $item->id]) ?>"
                                data-message="<?= __('¿Seguro que desea eliminar?') ?>"
                                data-ok="<?= __('Aceptar') ?>"
                                data-cancel="<?= __('Cancelar') ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
<?php endif ?>