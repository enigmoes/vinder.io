<?php
use Cake\Routing\Router;
?>
<div class="container">
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
            <div class="card">
                <div class="card-header">
                    <a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
                        <?= $this->Html->image('logotipo_66.png', array('alt' => 'vinder', 'class' => 'w-50')) ?>
                    </a>
                </div>
                <div class="card-body">
                    <div class="mb-5 mt-3">
                        <?= $this->Flash->render() ?>
                    </div>
                    <div class="mb-3 pr-4 pl-4">
                        <p>
                            <small><?= __('Escribe aquí tu nueva contraseña') ?></small>
                        </p>
                    </div>
                    <?= $this->Form->create() ?>
                    <div class="form-group">
                        <label><?= __('Nueva contraseña') ?></label>
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'type' => 'password',
                            'class' => 'form-control',
                            'placeholder' => __('Nueva contraseña')
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label><?= __('Confirma nueva contraseña') ?></label>
                        <?= $this->Form->control('password_confirm', [
                            'label' => false,
                            'type' => 'password',
                            'class' => 'form-control',
                            'placeholder' => __('Confirma nueva contraseña')
                        ]) ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-default btn-block m-b-20" type="submit">
                            <?= __('Cambiar') ?>
                        </button>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
                <div class="card-footer">
                    <p>Copyright © <?= date('Y') ?> Vinder. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>
