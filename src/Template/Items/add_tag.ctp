<?php
use Cake\Routing\Router;
?>
<div id="item-<?= $id_item ?>" class="row py-4">
    <div class="offset-md-2 col-12 col-md-8">
        <?=$this->Flash->render()?>
    </div>
    <?=$this->Form->create(false, [
        'id' => 'form-item-'.$id_item,
        'url' => ['controller' => 'items', 'action' => 'add_tag', $id_item],
        'class' => 'col-12 d-lg-flex justify-content-around'
    ])?>
        <div class="col-lg-10 col-md-12 mb-lg-0 mb-4 px-lg-4 px-0">
            <?=$this->Form->select('tags[]', $tags, [
                'multiple' => 'multiple',
                'id' => false,
                'label' => false,
                'value' => $tagsItem,
                'class' => 'select2',
            ])?>
        </div>
        <button type="button" class="btn btn-modal btn-modal-add col-lg-2 offset-lg-0 col-4 offset-4" data-id="<?= $id_item ?>">
            <?=__('Guardar')?>
        </button>
    <?=$this->Form->end()?>
</div>
<script>$(".select2").select2()</script>
