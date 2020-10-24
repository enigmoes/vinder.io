<?php
use Cake\Routing\Router;
?>
<?= $this->Html->css('login.css') ?>
<div class="container min-vh-100 mt-5">
    <div class="row pt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <?php if (isset($isRequest) && !$isRequest): ?>
        <div class="col-12 offset-md-3 col-md-6">
            <div class="card card-custom rounded-0">
                <div class="card-body">
                    <div class="mb-5 mt-3">
                        <?= $this->Flash->render() ?>
                    </div>
                    <div class="mb-3 pr-4 pl-4">
                        <div class="h5 mb-4 h5-custom"><?= __('RECUPERA TU CONTRASEÑA') ?></div>
                        <p>
                            <small><?= __('Introduce el e-mail asociado a tu cuenta de Vinder y te enviaremos un enlace para restaurar tu contraseña.') ?></small>
                        </p>
                    </div>
                    <?= $this->Form->create('Recover') ?>
                        <div class="form-group">
                            <label for="email" class="sr-only"><?= __('Email') ?></label>
                            <?= $this->Form->control('email', [
                                'label' => false,
                                'class' => 'form-control form-control-custom',
                                'placeholder' => __('Email')
                            ]) ?>
                        </div>
                        <button type="submit" class="btn btn-default mb-3 px-4">
                            <?= __('Enviar') ?>
                        </button>
                        <div class="recover mb-2">
                            <label style="font-size: 13px">
                                <a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
                                    <?= __('Volver al login') ?>
                                </a>
                            </label>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="row mt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
                <?=$this->Html->image('logotipo_66.png', array('alt' => 'vinder', 'class' => 'img-footer'))?>
            </a>
        </div>
    </div>
</div>

