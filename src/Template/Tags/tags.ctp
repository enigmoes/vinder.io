<?php
use Cake\Routing\Router;
?>
<?php if (isset($tags) && count($tags) > 0): ?>
    <ul>
        <?php foreach ($tags as $tag): ?>
            <li class="px-2">
                <a href="javascript:void(0)" class="tag" data-id="<?=$tag->id?> " data-name="<?=$tag->name?>"><?=$tag->name?></a>
                <a href="javascript:void(0)" class="tag-delete"
                data-url="<?=Router::url(['controller' => 'tags', 'action' => 'delete', $tag->id])?>"
                data-message="<?=__('¿Seguro que desea eliminar?')?>"
                data-ok="<?=__('Aceptar')?>"
                data-cancel="<?=__('Cancelar')?>">
                    <i class="mt-1 fas fa-trash-alt"></i>
                </a>
                <a href="javascript:void(0)" class="tag-edit" data-id="<?=$tag->id?>">
                    <i class="mt-1 mr-1 fas fa-pencil-alt"></i>
                </a>
            </li>
        <?php endforeach?>
        <li class="px-2">
            <a href="javascript:void(0)" class="create-tag d-block">
                <i class="fas fa-plus mr-1"></i><?=__('Añadir')?>
            </a>
        </li>
    </ul>
    <div id="modal-tag-create" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTag" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h5 class="h5 h5-modal m-0" id="modalTag"><?=__('Añadir etiqueta')?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-create d-flex justify-content-around my-3"></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p><?=__('No hay etiquetas')?></p>
<?php endif?>
