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
                <?= $this->Form->create('Login') ?>
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
                    <div class="recover mb-2">
                        <label style="font-size: 13px">
                            <a href="<?= Router::url(['controller' => 'users', 'action' => 'recover']) ?>">
                                <?= __('¿Olvidaste tu contraseña?') ?>
                            </a>
                        </label>
                    </div>
                    <div class="recover mb-2">
                        <label style="font-size: 13px">
                            <a href="<?= Router::url(['controller' => 'users', 'action' => 'register']) ?>">
                                <?= __('¿No tienes una cuenta? Registrate') ?>
                            </a>
                        </label>
                    </div>
                    <button class="btn btn-default btn-block m-b-20" type="submit">
                        <?= __('Entrar') ?>
                    </button>
                <?= $this->Form->end() ?>
            </div>
            <div class="card-footer">
                <p>Copyright © <?= date('Y') ?> Vinder. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
