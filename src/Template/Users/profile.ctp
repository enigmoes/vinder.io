<?php
use Cake\Routing\Router;
?>
<div class="container min-vh-100 mt-5">
    <div class="row">
        <div class="col-lg-2 d-lg-block d-none div-sidebar">
            <?=$this->element('../Users/Common/sidebar')?>
        </div>
        <div class="offset-lg-1 col-lg-6 col-12">
            <div>
                <?= $this->Flash->render() ?>
            </div>
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
        </div>
    </div>
</div>