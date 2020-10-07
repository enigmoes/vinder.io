<?php
use Cake\Routing\Router;
?>
<?= $this->Html->css('login.css') ?>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
            <div class="card card-custom rounded-0">
                <div class="card-body mt-3 mt-md-0 p-xl-5">
                    <h3><?= __('Validación email') ?></h3>
                    <?= $this->Form->create(false, ['url' => ['controller' => 'users', 'action' => 'validate']]); ?>
                        <div class="form-group">
                            <label for="token" class="sr-only"><?= __('Código') ?></label>
                            <?= $this->Form->control('token', [
                                'label' => false,
                                'id' => false,
                                'class' => 'form-control form-control-custom',
                                'placeholder' => __('Código')
                            ]) ?>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default btn-block text-secondary font-weight-bold">
                                <?= __('Validar') ?>
                            </button>
                        </div>
                    <?= $this->Form->end(); ?>
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