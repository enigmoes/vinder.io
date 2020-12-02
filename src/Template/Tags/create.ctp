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
        <?= $this->Form->hidden('id_user', ['value' => $this->request->getSession()->read('Auth.User.id')]) ?>
        <?=$this->Form->control('name', [
            'div' => false,
            'id' => false,
            'label' => false,
            'class' => 'form-control form-control-custom input-modal',
        ])?>
        <button type="button" class="btn btn-modal btn-modal-create ml-md-4 ml-1 px-md-4 px-2">
            <?=__('Guardar')?>
        </button>
    <?= $this->Form->end() ?>
</div>