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
                <?= $this->Form->create($user) ?>
                    <div class="form-group">
                        <label><?= __('Usuario') ?></label>
                        <?= $this->Form->control('username', [
                            'label' => false,
                            'class' => 'form-control',
                            'placeholder' => __('Usuario')
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label><?= __('Email') ?></label>
                        <?= $this->Form->control('email', [
                            'label' => false,
                            'class' => 'form-control',
                            'placeholder' => __('Email')
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label><?= __('Contraseña') ?></label>
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'class' => 'form-control',
                            'placeholder' => __('Contraseña')
                        ]) ?>
                    </div>
                    <div class="custom-control custom-checkbox mb-3">
                        <?php $this->Form->unlockField('privacidad') ?>
                        <?= $this->Form->control('privacidad', [
                            'templates' => [
                                'inputContainer' => '{{content}}'
                            ],
                            'label' => false,
                            'type' => 'checkbox',
                            'class' => 'custom-control-input'
                        ]) ?>
                        <label class="custom-control-label" for="privacidad">
                            <?= __('Acepto la') ?>
                            <a href="<?= Router::url(['controller' => 'legal', 'action' => 'privacity']) ?>" class="link">
                                <?= __('política de privacidad') ?>
                            </a>
                        </label>
                    </div>
                    <div class="recover mb-2">
                        <label style="font-size: 13px">
                            <a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
                                <?= __('Ya tengo una cuenta') ?>
                            </a>
                        </label>
                    </div>
                    <button class="btn btn-default btn-block m-b-20" type="submit">
                        <?= __('Registrarse') ?>
                    </button>
                <?= $this->Form->end() ?>
            </div>
            <div class="card-footer">
                <p>Copyright © <?= date('Y') ?> Vinder. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
