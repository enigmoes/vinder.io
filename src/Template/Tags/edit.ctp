<?php
use Cake\Routing\Router;
?>
<div id="tag-<?= $tag->id ?>">
    <div class="col-12">
        <?=$this->Flash->render()?>
    </div>
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