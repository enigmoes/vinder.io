<?php
use Cake\Routing\Router;
?>
<div id="item-<?= $id_item ?>" class="row w-100 py-4">
    <div class="offset-md-2 col-12 col-md-8">
        <?=$this->Flash->render()?>
    </div>
    <?=$this->Form->create(false, [
        'id' => 'form-item-'.$id_item,
        'url' => ['controller' => 'items', 'action' => 'add_tag', $id_item],
        'class' => 'col-12 d-flex justify-content-around'
    ])?>
        <div class="w-75">
            <?=$this->Form->select('tags[]', $tags, [
                'multiple' => 'multiple',
                'id' => false,
                'label' => false,
                'value' => $tagsItem,
                'class' => 'select2',
            ])?>
        </div>
        <button type="button" class="btn btn-modal btn-modal-add px-4" data-id="<?= $id_item ?>">
            <?=__('Añadir')?>
        </button>
    <?=$this->Form->end()?>
</div>
<script>$(".select2").select2()</script>
