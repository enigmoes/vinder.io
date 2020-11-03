<?php
use Cake\Routing\Router;
?>
<?php if (isset($items) && count($items) > 0): ?>
    <div class="row">
        <!-- <//?php foreach ($itemsTags->tags as $tag): ?>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="h5 h5-custom text-uppercase mb-4"><//?= $tag->name ?></div>
            </div>
        <//?php endforeach ?>-->
    </div>
    <div class="row">
        <?php foreach ($items as $item): ?>
            <div class="col-lg-4 col-md-6 col-12 mb-5">
                <div class="card card-items rounded-0">
                    <div class="card-body card-block">
                        <div class="mb-3">
                                <img src="<?= $item->image ?>" alt="<?= $item->title ?>" class="mw-100">
                        </div>
                        <div class="h6 h6-default"><?= $item->title ?></div>
                        <div class="mb-3"><a href="<?= $item->link ?>"><?= parse_url($item->link, PHP_URL_HOST) ?></a></div>
                        <p class="small"><?= $item->description ?></p>
                        <div class="items-icons dropup">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-share-square"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-custom custom-shadow rounded-0">
                                <a class="dropdown-item copy-link" href="javascript:void(0)"
                                data-url="<?=$item->link?>">
                                    <i class="fas fa-link"></i><?=__('Copiar enlace')?>
                                </a>
                                <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u=<?= $item->link ?>">
                                    <i class="fab fa-facebook-f"></i><?=__('Facebook')?>
                                </a>
                                <a class="dropdown-item" href="https://twitter.com/intent/tweet?text=<?= $item->link ?>">
                                    <i class="fab fa-twitter"></i><?=__('Twitter')?>
                                </a>
                            </div>
                            <a href="javascript:void(0)"><i class="fas fa-tag"></i></a>
                            <a href="javascript:void(0)" class="favItem <?=($item->is_fav) ? 'isFav' : ''?>"
                            data-url="<?=Router::url(['controller' => 'items', 'action' => 'is_fav', $item->id])?>">
                                <i class="fas fa-star"></i>
                            </a>
                            <a href="javascript:void(0)" class="deleteItem"
                            data-url="<?=Router::url(['controller' => 'items', 'action' => 'delete', $item->id])?>"
                            data-message="<?=__('¿Seguro que desea eliminar?')?>"
                            data-ok="<?=__('Aceptar')?>"
                            data-cancel="<?=__('Cancelar')?>">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?php endif ?>