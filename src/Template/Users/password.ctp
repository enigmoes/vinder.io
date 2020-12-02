<?php
use Cake\Routing\Router;
?>
<div class="container min-vh-100 mt-5">
    <div class="row">
        <div class="col-lg-2 d-lg-block d-none div-sidebar">
            <?=$this->element('../Users/Common/sidebar')?>
        </div>
        <div class="offset-lg-1 col-lg-6 col-12">
            <div>
                <?= $this->Flash->render() ?>
            </div>
            <div id="form-pass" class="card custom-shadow mb-5">
                <?= $this->Form->create($user) ?>
                    <div class="card-body card-block">
                        <div class="h4 h4-custom"><?= __('Editar contraseña') ?></div>
                        <div class="h6 h6-custom mb-5">
                            <small><?= __('Recuerda que si usas cualquier aplicación de Vinder, deberás volver a iniciar sesión en ella tras haber cambiado la contraseña.') ?></small>
                        </div>
                        <div class="form-group form-group-icon-right">
                            <?= $this->Form->control('password_current', [
                                'div' => false,
                                'label' => 'Contraseña actual',
                                'type' => 'password',
                                'class' => 'form-control form-control-custom m-0',
                            ]) ?>
                            <i class='fas fa-eye show-password-label'></i>
                        </div>
                        <div class="form-group form-group-icon-right">
                            <?= $this->Form->control('password', [
                                'div' => false,
                                'label' => 'Nueva contraseña',
                                'type' => 'password',
                                'class' => 'form-control form-control-custom m-0',
                            ]) ?>
                            <i class='fas fa-eye show-password-label'></i>
                        </div>
                        <div class="form-group form-group-icon-right">
                            <?= $this->Form->control('password_confirm', [
                                'div' => false,
                                'label' => 'Confirmar contraseña',
                                'type' => 'password',
                                'class' => 'form-control form-control-custom m-0',
                            ]) ?>
                            <i class='fas fa-eye show-password-label'></i>
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
    <div class="row mt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <a href="<?= Router::url(['controller' => 'items', 'action' => 'index']) ?>">
                <?=$this->Html->image('logotipo_66.png', array('alt' => 'vinder', 'class' => 'img-footer'))?>
            </a>
        </div>
    </div>
</div>