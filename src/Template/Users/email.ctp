<?php
use Cake\Routing\Router;
?>
<div class="container min-vh-100 mt-5">
    <div class="row">
        <div class="col-lg-2 d-lg-block div-sidebar">
            <?=$this->element('../Users/Common/sidebar')?>
        </div>
        <div class="offset-lg-1 col-lg-6 col-12">
            <div>
                <?= $this->Flash->render() ?>
            </div>
            <div id="form-correo" class="card custom-shadow mb-5">
                <?= $this->Form->create($user) ?>
                    <div class="card-body card-block">
                        <div class="h4 h4-custom"><?= __('Editar correo electrónico') ?></div>
                        <div class="h6 h6-custom mb-5">
                            <?= __('Tu correo actual es: ') ?>
                            <?= $this->request->getSession()->read('Auth.User.email') ?>
                        </div>
                        <div class="h6 h6-custom mb-5">
                            <small><?= __('Recuerda que si usas cualquier aplicación de Vinder, deberás volver a iniciar sesión en ella tras haber cambiado el correo electrónico.') ?></small>
                        </div>
                        <div class="form-group form-group-custom">
                            <?= $this->Form->control('email', [
                                'label' => 'Nuevo correo',
                                'class' => 'form-control form-control-custom m-0',
                            ]) ?>
                        </div>
                        <div class="form-group form-group-custom">
                            <?= $this->Form->control('email_confirm', [
                                'label' => 'Confirma tu correo',
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
    <div class="row mt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <a href="<?= Router::url(['controller' => 'items', 'action' => 'index']) ?>">
                <?=$this->Html->image('logotipo_66.png', array('alt' => 'vinder', 'class' => 'img-footer'))?>
            </a>
        </div>
    </div>
</div>