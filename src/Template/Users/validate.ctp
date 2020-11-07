<?php
use Cake\Routing\Router;
?>
<?= $this->Html->css('login.css') ?>
<div class="container min-vh-100 mt-5">
    <div class="row pt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
            <div class="card card-custom rounded-0">
                <div class="card-body mt-3 mt-md-0 p-xl-5">
                    <h3><?= __('Validación email') ?></h3>
                    <div class="h5 mb-4 h5-custom"><?= __('VALIDA TU EMAIL') ?></div>
                    <?= $this->Form->create('Validate'); ?>
                        <div class="form-group">
                            <label for="token" class="sr-only"><?= __('Código') ?></label>
                            <?= $this->Form->control('token', [
                                'label' => false,
                                'id' => false,
                                'class' => 'form-control form-control-custom',
                                'placeholder' => __('Código')
                            ]) ?>
                        </div>
                        <button type="submit" class="btn btn-default px-4">
                            <?= __('Validar') ?>
                        </button>
                    <?= $this->Form->end(); ?>
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
