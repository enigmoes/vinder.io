<?php
use Cake\Routing\Router;
?>
<?= $this->Html->css('login.css') ?>
<div class="container mt-5">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar sidebar-default">
            <div class="sidebar-header">
                <div id="nav1-h5" class="h5 h5-custom"><?=h($user->email)?></div>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="<?= Router::url(['controller' => 'home', 'action' => 'index']) ?>"><?= __('Ir a mi lista') ?></a>
                </li>
                <li>
                    <a href="<?= Router::url(['controller' => 'users', 'action' => 'logout']) ?>"><?= __('Cerrar sesión') ?></a>
                </li>
            </ul>
            <div class="sidebar-header">
                <div id="nav2-h5" class="h5 h5-custom"><?= __('Opciones') ?></div>
            </div>
            <ul id="lista" class="list-unstyled components">
                <li id="perfil" class="active">
                    <a href="#"><?= __('Editar perfil') ?></a>
                </li>
                <li id="correo">
                    <a href="#"><?= __('Editar correo') ?></a>
                </li>
                <li id="pass">
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
            <div id="form-perfil" class="card custom-shadow">
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
            <div id="form-correo" class="card custom-shadow d-none">
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
            <div id="form-pass" class="card custom-shadow d-none">
                <?= $this->Form->create($user) ?>
                <div class="card-body card-block">
                <div class="h4 h4-custom"><?= __('Cambiar contraseña') ?></div>
                    <div class="h6 h6-custom"><?= __('Recuerda que si usas cualquier aplicación de Vinder,
                    deberás volver a iniciar sesión en ella tras haber cambiado el usuario o contraseña.') ?></div>
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
                        <?= $this->Form->control('password_confirm', [
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
<?= $this->Html->script('account.js', ['defer' => 'defer']); ?>