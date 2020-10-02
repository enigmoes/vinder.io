<?php
use Cake\Routing\Router;
?>
<div class="container">
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
            <div class="card custom-shadow border-0">
                <div class="card-header">
                    <strong><?= __('Mi Cuenta') ?></strong>
                </div>
                <?= $this->Form->create($user) ?>
                <div class="card-body card-block">
                    <div class="form-group">
                        <label for="username" class="form-control-label"><?= __('Usuario') ?></label>
                        <?= $this->Form->control('username', [
                            'label' => false,
                            'class' => 'form-control',
                            'placeholder' => __('Usuario')
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label"><?= __('Email') ?></label>
                        <?= $this->Form->control('email', [
                            'label' => false,
                            'class' => 'form-control',
                            'placeholder' => __('Email')
                        ]) ?>
                        <small>
                            <strong><?= __('Warning') ?>:</strong>
                            <?= __('Este campo se utiliza para iniciar sesión en la aplicación') ?>
                        </small>
                    </div>
                    <hr class="mt-5 mb-4 bg-primary">
                    <div class="form-group">
                        <label for="password_current" class="form-control-label"><?= __('Contraseña actual') ?></label>
                        <?= $this->Form->control('password_current', [
                            'label' => false,
                            'type' => 'password',
                            'class' => 'form-control',
                            'required' => false,
                            'placeholder' => __('Contraseña actual')
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label"><?= __('Contraseña') ?></label>
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'type' => 'password',
                            'class' => 'form-control',
                            'required' => false,
                            'placeholder' => __('Contraseña')
                        ]) ?>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="row">
                        <div class="col-md-6 col-12 text-left">
                            <button id="disable_account" type="button" class="btn btn-danger font-weight-bold">
                                <?= __('Desactivar cuenta') ?>
                            </button>
                        </div>
                        <div class="col-md-6 col-12 text-right">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-check"></i>
                                <?= __('Guardar') ?>
                            </button>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('account.js', ['defer' => 'defer']); ?>