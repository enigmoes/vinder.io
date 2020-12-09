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
        'class' => 'col-12'
    ])?>
        <div class="row">
            <div class="col-12 col-lg-10 mb-3">
                <?=$this->Form->select('tags[]', $tags, [
                    'multiple' => 'multiple',
                    'id' => false,
                    'label' => false,
                    'value' => $tagsItem,
                    'class' => 'form-select select2',
                ])?>
            </div>
            <div class="col-12 col-lg-2 mb-3 text-center">
                <button type="button" class="btn btn-modal btn-modal-add" data-id="<?= $id_item ?>">
                    <?=__('Guardar')?>
                </button>
            </div>
        </div>
    <?=$this->Form->end()?>
</div>
<script>$(".select2").select2()</script>
