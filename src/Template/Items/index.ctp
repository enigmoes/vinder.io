<?php
use Cake\Routing\Router;
?>
<div class="container min-vh-100 mt-5">
    <div class="row">
        <div class="col-lg-2 d-lg-block d-none">
            <?=$this->element('Common/sidebar')?>
        </div>
        <div class="col-lg-10 col-12">
            <div class="h4 h4-default"><?=__('MI LISTA')?></div>
            <div class="results mt-4"></div>
        </div>
    </div>
    <?=$this->Form->create()?>
    <?=$this->Form->end()?>
</div>
<?=$this->Html->script('items.js')?>