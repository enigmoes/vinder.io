<?php
use Cake\Routing\Router;
?>
<?php if (isset($tags) && count($tags) > 0): ?>
    <ul>
        <?php foreach ($tags as $tag): ?>
            <li class="px-2">
                <a href="javascript:void(0)" class="tag" data-id="<?=$tag->id?> " data-name="<?=$tag->name?>"><?=$tag->name?></a>
                <a href="javascript:void(0)" class="tag-delete"
                data-url="<?=Router::url(['controller' => 'tags', 'action' => 'delete_tags', $tag->id])?>"
                data-message="<?=__('¿Seguro que desea eliminar?')?>"
                data-ok="<?=__('Aceptar')?>"
                data-cancel="<?=__('Cancelar')?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
                <a href="javascript:void(0)" class="tag-edit"
                data-url="<?=Router::url(['controller' => 'tags', 'action' => 'edit', $tag->id])?>">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </li>
        <?php endforeach?>
    </ul>
<?php endif?>