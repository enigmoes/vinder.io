<?php
use Cake\Routing\Router;
?>
<?=$this->Html->css('login.css')?>
<div class="container min-vh-100 mt-5">
    <div class="row pt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
            <div class="card card-custom rounded-0">
                <div class="card-body">
                    <div class="mb-3 pr-4 pl-4">
                        <div class="h5 mb-4 h5-custom"><?= __('CAMBIA TU CONTRASEÑA') ?></div>
                        <p>
                            <small><?= __('Escribe aquí tu nueva contraseña') ?></small>
                        </p>
                    </div>
                    <?= $this->Form->create() ?>
                        <div class="form-group">
                            <?= $this->Form->control('password', [
                                'label' => false,
                                'type' => 'password',
                                'class' => 'form-control form-control-custom',
                                'placeholder' => __('Nueva contraseña')
                            ]) ?>
                            <i class='fas fa-eye show-password'></i>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('password_confirm', [
                                'label' => false,
                                'type' => 'password',
                                'class' => 'form-control form-control-custom',
                                'placeholder' => __('Confirma nueva contraseña')
                            ]) ?>
                            <i class='fas fa-eye show-password'></i>
                        </div>
                        <button type="submit" class="btn btn-default px-4">
                            <?= __('Cambiar') ?>
                        </button>
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
