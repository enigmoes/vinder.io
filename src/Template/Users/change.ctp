<?php
use Cake\Routing\Router;
?>
<?=$this->Html->css('login.css')?>
<?=$this->Html->script('login.js')?>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
            <div class="card card-custom rounded-0">
                <div class="card-body">
                    <div class="mb-5 mt-3">
                        <?= $this->Flash->render() ?>
                    </div>
                    <div class="mb-3 pr-4 pl-4">
                        <div class="h5"><?= __('Escribe aquí tu nueva contraseña') ?></div>
                    </div>
                    <?= $this->Form->create() ?>
                    <div class="form-group">
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'type' => 'password',
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Nueva contraseña')
                        ]) ?>
                        <i class='fas fa-eye input-icon'></i>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('password_confirm', [
                            'label' => false,
                            'type' => 'password',
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Confirma nueva contraseña')
                        ]) ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-default btn-block m-b-20" type="submit">
                            <?= __('Cambiar') ?>
                        </button>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
    <?=$this->Html->image('logotipo_66.png', array('alt' => 'vinder', 'class' => 'img-footer'))?>
</a>
<div class="copyright">
    <p>Copyright © <?=date('Y')?> Vinder. All rights reserved.</p>
</div>
