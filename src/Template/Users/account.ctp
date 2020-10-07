<?php
use Cake\Routing\Router;
?>
<?= $this->Html->css('login.css') ?>
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
<div class="container">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar sidebar-default">
            <div class="sidebar-header">
                <div class="h5 h5-custom">Bootstrap Sidebar</div>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#">Ir a mi lista</a>
                </li>
                <li>
                    <a href="#">Cerrar Sesión</a>
                </li>
            </ul>
            <div class="sidebar-header">
                <div class="h5 h5-custom">Opciones</div>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#">Editar perfil</a>
                </li>
                <li>
                    <a href="#">Editar correo</a>
                </li>
                <li>
                    <a href="#">Editar contraseña</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
            <div class="card custom-shadow border-0">
                <div class="card-header">
                    <strong><?= __('Mi Cuenta') ?></strong>
                </div>
                <?= $this->Form->create($user) ?>
                <div class="card-body card-block">
                    <div class="form-group">
                        <?= $this->Form->control('username', [
                            'label' => false,
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Usuario')
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('email', [
                            'label' => false,
                            'class' => 'form-control form-control-custom',
                            'placeholder' => __('Email')
                        ]) ?>
                        <small>
                            <strong><?= __('Warning') ?>:</strong>
                            <?= __('Este campo se utiliza para iniciar sesión en la aplicación') ?>
                        </small>
                    </div>
                    <hr class="mt-5 mb-4 bg-primary">
                    <div class="form-group">
                        <?= $this->Form->control('password_current', [
                            'label' => false,
                            'type' => 'password',
                            'class' => 'form-control form-control-custom',
                            'required' => false,
                            'placeholder' => __('Contraseña actual')
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'type' => 'password',
                            'class' => 'form-control form-control-custom',
                            'required' => false,
                            'placeholder' => __('Contraseña')
                        ]) ?>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="row">
                        <div class="col-md-6 col-12 text-left">
                            <button id="disable_account" type="button" class="btn btn-danger font-weight-bold">
                                <?= __('Desactivar cuenta') ?>
                            </button>
                        </div>
                        <div class="col-md-6 col-12 text-right">
                            <button type="submit" class="btn btn-default">
                                <?= __('Guardar') ?>
                            </button>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<div class="copyright">
    <p>Copyright © <?=date('Y')?> Vinder. All rights reserved.</p>
</div>
<?= $this->Html->script('account.js', ['defer' => 'defer']); ?>