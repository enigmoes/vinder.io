<?php
use Cake\Routing\Router;
?>
<?= $this->Html->css('login.css') ?>
<?=$this->Html->script('login.js')?>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
        <div class="card card-custom rounded-0">
            <div class="card-body">
                <?= $this->Form->create($user) ?>
                    <div class="form-group">
                        <?= $this->Form->control('username', [
                            'label' => false,
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Usuario')
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('email', [
                            'label' => false,
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Email')
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Contraseña')
                        ]) ?>
                        <i class='fas fa-eye input-icon'></i>
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
        </div>
    </div>
</div>
<a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
    <?=$this->Html->image('logotipo_66.png', array('alt' => 'vinder', 'class' => 'img-footer'))?>
</a>
