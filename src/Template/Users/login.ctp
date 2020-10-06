<?php
use Cake\Routing\Router;
?>
<?=$this->Html->css('login.css')?>
<nav class="navbar navbar-default">
    <div class="navbar-header pl-5">
        <a class="navbar-brand" href="#">
            <?=$this->Html->image('logotipo_35.png', array('alt' => 'vinder', 'class' => 'w-10'))?>
        </a>
    </div>
    <ul class="nav navbar-right pr-5">
      <li><a href="#"><i class="fas fa-search"></i></a></li>
      <li><a href="#"><i class="fas fa-plus"></i></a></li>
      <li><a href="#"><i class="fas fa-user"></i></a></li>
    </ul>
</nav>
<div class="container text-center mt-5">
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?=$this->Flash->render()?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
        <div class="card card-custom rounded-0">
            <div class="card-body">
                <div class="h5 mb-5 h5-custom">INICIAR SESIÓN</div>
                <?=$this->Form->create('Login')?>
                    <div class="form-group">
                        <?=$this->Form->control('email', [
                            'label' => false,
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Correo o nombre de usuario'),
                        ])?>
                    </div>
                    <div class="form-group">
                        <?=$this->Form->control('password', [
                            'label' => false,
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Contraseña'),
                            /*'a' => [
                                'href' => '#',
                                'i' => [
                                    'class' => 'fas fa-eye'
                                ]
                            ],*/
                        ])?>
                    </div>
                    <button class="btn my-4 px-4 btn-default" type="submit">
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
<div class="copyright">
    <p>Copyright © <?=date('Y')?> Vinder. All rights reserved.</p>
</div>
