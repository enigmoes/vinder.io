<?php
use Cake\Routing\Router;
?>
<?= $this->Html->css('login.css') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 d-lg-block d-none">
            <?=$this->element('../Users/Common/sidebar')?>
        </div>
        <div class="offset-lg-1 col-lg-6 col-12">
            <div>
                <?= $this->Flash->render() ?>
            </div>
            <div id="form-pass" class="card custom-shadow">
                <?= $this->Form->create($user) ?>
                    <div class="card-body card-block">
                        <div class="h4 h4-custom"><?= __('Cambiar contraseña') ?></div>
                        <div class="h6 h6-custom"><?= __('Recuerda que si usas cualquier aplicación de Vinder,
                        deberás volver a iniciar sesión en ella tras haber cambiado el usuario o contraseña.') ?></div>
                        <div class="form-group form-group-custom">
                            <?= $this->Form->control('password_current', [
                                'label' => 'Contraseña actual',
                                'type' => 'password',
                                'class' => 'form-control form-control-custom m-0',
                            ]) ?>
                        </div>
                        <div class="form-group form-group-custom">
                            <?= $this->Form->control('password', [
                                'label' => 'Nueva contraseña',
                                'type' => 'password',
                                'class' => 'form-control form-control-custom m-0',
                            ]) ?>
                        </div>
                        <div class="form-group form-group-custom">
                            <?= $this->Form->control('password_confirm', [
                                'label' => 'Confirmar contraseña',
                                'type' => 'password',
                                'class' => 'form-control form-control-custom m-0',
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-custom px-4">
                                <?= __('Guardar') ?>
                            </button>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->script('account.js', ['defer' => 'defer']); ?>