<?php
use Cake\Routing\Router;
?>
<div class="container">
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <?php if (isset($isRequest) && !$isRequest): ?>
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
                        <h3><?= __('Recuperación de contraseña') ?></h3>
                        <p>
                            <small><?= __('Introduce el e-mail asociado a tu cuenta de Vinder y te enviaremos un enlace para restaurar tu contraseña.') ?></small>
                        </p>
                    </div>
                    <?= $this->Form->create('Recover') ?>
                        <div class="form-group">
                            <label for="email" class="sr-only"><?= __('Email') ?></label>
                            <?= $this->Form->control('email', [
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => __('Email')
                            ]) ?>
                        </div>
                        <div class="recover mb-2">
                            <label style="font-size: 13px">
                                <a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
                                    <?= __('Volver al login') ?>
                                </a>
                            </label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-default btn-block m-b-20" type="submit">
                                <?= __('Enviar') ?>
                            </button>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
                <div class="card-footer">
                    <p>Copyright © <?= date('Y') ?> Vinder. All rights reserved.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
