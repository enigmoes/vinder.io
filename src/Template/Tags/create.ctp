<?php
use Cake\Routing\Router;
?>
<div>
    <div class="col-12">
        <?=$this->Flash->render()?>
    </div>
    <?= $this->Form->create(false, [
        'id' => 'form-create',
        'class' =>'form-inline'
    ]) ?>
        <?=$this->Form->control('name', [
            'div' => false,
            'id' => false,
            'label' => false,
            'class' => 'form-control form-control-custom input-modal',
        ])?>
        <button type="button" class="btn btn-modal btn-modal-create ml-4 px-4">
            <?=__('Añadir')?>
        </button>
    <?= $this->Form->end() ?>
</div>