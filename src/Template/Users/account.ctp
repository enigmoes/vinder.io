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
<div class="container mt-5">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar sidebar-default">
            <div class="sidebar-header">
                <div id="nav1-h5" class="h5 h5-custom"><?= h($user->email)?></div>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="#"><?= __('Ir a mi lista') ?></a>
                </li>
                <li>
                    <a href="<?= Router::url(['controller' => 'users', 'action' => 'logout']) ?>"><?= __('Cerrar sesión') ?></a>
                </li>
            </ul>
            <div class="sidebar-header">
                <div id="nav2-h5" class="h5 h5-custom"><?= __('Opciones') ?></div>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#"><?= __('Editar perfil') ?></a>
                </li>
                <li>
                    <a href="#"><?= __('Editar correo') ?></a>
                </li>
                <li>
                    <a href="#"><?= __('Editar contraseña') ?></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 offset-md-3 col-md-6">
            <?= $this->Flash->render() ?>
        </div>
        <div class="col-12 offset-md-3 col-md-6">
            <div class="card custom-shadow">
                <?= $this->Form->create($user) ?>
                <div class="card-body card-block">
                <div class="h4 h4-custom"><?= __('Editar perfil') ?></div>
                    <div class="form-group form-group-custom">
                        <?= $this->Form->control('name', [
                            'label' => 'Nombre',
                            'class' => 'form-control form-control-custom m-0',
                        ]) ?>
                    </div>
                    <div class="form-group form-group-custom">
                        <?= $this->Form->control('surnames', [
                            'label' => 'Apellidos',
                            'class' => 'form-control form-control-custom m-0',
                        ]) ?>
                    </div>
                    <div class="form-group form-group-custom">
                        <?= $this->Form->control('username', [
                            'label' => 'Usuario',
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
            <div class="card custom-shadow d-none">
                <?= $this->Form->create($user) ?>
                <div class="card-body card-block">
                <div class="h4 h4-custom"><?= __('Cambia tu correo principal') ?></div>
                    <div class="h6 h6-custom"><?= __('Tu correo actual es: ') ?><?= h($user->email)?></div>
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
            <div class="card custom-shadow d-none">
                <?= $this->Form->create($user) ?>
                <div class="card-body card-block">
                <div class="h4 h4-custom"><?= __('Cambiar contraseña') ?></div>
                    <div class="h6 h6-custom"><?= __('Tu correo actual es: ') ?><?= h($user->email)?></div>
                    <div class="form-group form-group-custom">
                        <?= $this->Form->control('password', [
                            'label' => 'Contraseña actual',
                            'class' => 'form-control form-control-custom m-0',
                        ]) ?>
                    </div>
                    <div class="form-group form-group-custom">
                        <?= $this->Form->control('password', [
                            'label' => 'Nueva contraseña',
                            'class' => 'form-control form-control-custom m-0',
                        ]) ?>
                    </div>
                    <div class="form-group form-group-custom">
                        <?= $this->Form->control('email_confirm', [
                            'label' => 'Confirmar contraseña',
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
<div class="copyright">
    <p>Copyright © <?=date('Y')?> Vinder. All rights reserved.</p>
</div>
<?= $this->Html->script('account.js', ['defer' => 'defer']); ?>