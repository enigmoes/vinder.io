<?php
use Cake\Routing\Router;
?>
<?=$this->Html->css('login.css')?>
<div class="container min-vh-100 mt-5">
    <div class="row pt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <?=$this->Flash->render()?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
            <div class="card card-custom rounded-0">
                <div class="card-body">
                    <div class="h5 mb-4 h5-custom"><?= __('ACCEDE A VINDER') ?></div>
                    <?=$this->Form->create('Login')?>
                        <div class="form-group mb-4 mt-5">
                            <?=$this->Form->control('email', [
                                'label' => false,
                                'class' => 'form-control form-control-custom',
                                'placeholder' => __('Correo electrónico'),
                            ])?>
                        </div>
                        <div class="form-group form-group-icon-right mb-4">
                            <?=$this->Form->control('password', [
                                'div' => false,
                                'label' => false,
                                'class' => 'form-control form-control-custom',
                                'placeholder' => __('Contraseña'),
                            ])?>
                            <i class='fas fa-eye show-password'></i>
                        </div>
                        <button type="submit" class="btn btn-default mb-3 px-4">
                            <?=__('Entrar')?>
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
                                    <?=__('¿Eres nuevo? crea tu cuenta aquí')?>
                                </a>
                            </label>
                        </div>
                    <?=$this->Form->end()?>
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

