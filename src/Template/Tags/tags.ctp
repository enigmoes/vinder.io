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
                    <i class="mt-1 fas fa-trash-alt"></i>
                </a>
                <a href="javascript:void(0)" class="tag-edit" data-id="<?= $tag->id ?>">
                    <i class="mt-1 mr-1 fas fa-pencil-alt"></i>
                </a>
            </li>
            <div class="d-none">
                <div id="tag-<?= $tag->id ?>">
                    <?= $this->Form->create($tag, [
                        'id' => 'form-tag-'.$tag->id,
                        'url' => ['controller' => 'tags', 'action' => 'edit', $tag->id],
                        'class' =>'form-inline'
                    ]) ?>
                        <?=$this->Form->control('name', [
                            'div' => false,
                            'id' => false,
                            'label' => false,
                            'class' => 'form-control form-control-custom input-modal',
                        ])?>
                        <button type="button" class="btn btn-modal btn-modal-edit ml-4 px-4" data-id="<?= $tag->id ?>">
                            <?=__('Guardar')?>
                        </button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        <?php endforeach?>
    </ul>
<?php endif?>