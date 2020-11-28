<?php
use Cake\Routing\Router;
?>
<?php if (isset($tags) && count($tags) > 0): ?>
    <ul id="tags">
        <?php foreach ($tags as $tag): ?>
            <li class="px-2">
                <a href="javascript:void(0)" class="tag" data-id="<?=$tag->id?>" data-name="<?=$tag->name?>">
                    <?=$tag->name?>
                </a>
                <a href="javascript:void(0)" class="tag-delete"
                data-url="<?=Router::url(['controller' => 'tags', 'action' => 'delete', $tag->id])?>"
                data-message="<?=__('¿Seguro que desea eliminar?')?>"
                data-ok="<?=__('Aceptar')?>"
                data-cancel="<?=__('Cancelar')?>">
                    <i class="mt-1 fas fa-trash-alt"></i>
                </a>
                <a href="javascript:void(0)" class="tag-edit" data-id="<?=$tag->id?>" data-title="<?=__('Editar etiqueta')?>">
                    <i class="mt-1 mr-1 fas fa-pencil-alt"></i>
                </a>
            </li>
        <?php endforeach?>
    </ul>
<?php else: ?>
    <p class="no-tags"><?=__('No hay etiquetas')?></p>
<?php endif ?>
