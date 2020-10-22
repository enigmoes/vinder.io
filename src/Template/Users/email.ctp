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
            <div id="form-correo" class="card custom-shadow mb-5">
                <?= $this->Form->create($user) ?>
                    <div class="card-body card-block">
                        <div class="h4 h4-custom"><?= __('Cambia tu correo principal') ?></div>
                        <div class="h6 h6-custom">
                            <?= __('Tu correo actual es: ') ?>
                            <?= $this->request->getSession()->read('Auth.User.email') ?>
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
</div>
<?= $this->Html->script('account.js', ['defer' => 'defer']); ?>