<?php
use Cake\Routing\Router;
?>
<?=$this->Html->css('login.css')?>
<?=$this->Html->script('login.js')?>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?=$this->Flash->render()?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
        <div class="card card-custom rounded-0">
            <div class="card-body">
                <div class="h5 mb-4 h5-custom"><?= __('INICIAR SESIÓN') ?></div>
                <?=$this->Form->create('Login')?>
                    <div class="form-group">
                        <?=$this->Form->control('email', [
                            'label' => false,
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Correo o nombre de usuario'),
                        ])?>
                    </div>
                    <div class="form-group form-group-icon-right">
                        <?=$this->Form->control('password', [
                            'div' => false,
                            'label' => false,
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Contraseña'),
                        ])?>
                        <i class='fas fa-eye input-icon'></i>
                    </div>
                    <button class="btn my-2 px-4 btn-default" type="submit">
                        <?=__('Iniciar sesión')?>
                    </button>
                    <div class="recover">
                        <label style="font-size: 13px">
                            <a href="<?=Router::url(['controller' => 'users', 'action' => 'recover'])?>">
                                <?=__('¿Has olvidado tu usuario o la contraseña?')?>
                            </a>
                        </label>
                    </div>
                    <div class="recover">
                        <label style="font-size: 13px">
                            <a href="<?=Router::url(['controller' => 'users', 'action' => 'register'])?>">
                                <?=__('Si eres nuevo Regístrate ahora >')?>
                            </a>
                        </label>
                    </div>
                <?=$this->Form->end()?>
            </div>
        </div>
    </div>
</div>
<a href="<?= Router::url(['controller' => 'users', 'action' => 'login']) ?>">
    <?=$this->Html->image('logotipo_66.png', array('alt' => 'vinder', 'class' => 'img-footer'))?>
</a>
