<?php
use Cake\Routing\Router;
?>
<?= $this->Html->css('login.css') ?>
<div class="container min-vh-100 mt-5">
    <div class="row pt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
            <div class="card card-custom rounded-0">
                <div class="card-body">
                    <div class="h5 mb-4 h5-custom"><?= __('CREA TU CUENTA') ?></div>
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
                        <div class="form-group form-group-icon-right">
                            <?= $this->Form->control('password', [
                                'label' => false,
                                'class' => 'form-control form-control-custom',
                                'placeholder' => __('Contraseña')
                            ]) ?>
                            <i class='fas fa-eye show-password'></i>
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
                        <button type="submit" class="btn btn-default mb-3 px-4">
                            <?= __('Crear cuenta') ?>
                        </button>
                        <div class="recover mb-2">
                            <label style="font-size: 13px">
                                <a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
                                    <?= __('Ya tengo una cuenta') ?>
                                </a>
                            </label>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
                <?=$this->Html->image('logotipo_66.png', array('alt' => 'vinder', 'class' => 'img-footer'))?>
            </a>
        </div>
    </div>
</div>
