<?php
use Cake\Routing\Router;
?>
<div class="container min-vh-100 mt-5">
    <div class="row">
        <div class="col-lg-2 d-lg-block d-none div-sidebar">
            <?=$this->element('Common/sidebar')?>
        </div>
        <div class="col-lg-10 col-12">
            <div class="row">
                <div class="offset-lg-8 col-lg-4 offset-md-6 col-md-6 col-12 order-items mt-3 mb-lg-0 mb-3">
                    <div class="h6 h6-default text-uppercase"><?=__('Ordenar por:')?></div>
                    <select class="select2">
                        <option value="new"><?=__('Más nuevos')?></option>
                        <option value="old"><?=__('Más antiguos')?></option>
                        <option value="asc"><?=__('A-Z')?></option>
                        <option value="desc"><?=__('Z-A')?></option>
                    </select>
                </div>
            </div>
            <div class="results mt-4"></div>
        </div>
    </div>
    <?=$this->Form->create()?>
    <?=$this->Form->end()?>
</div>
<?=$this->Html->script('items.js')?>