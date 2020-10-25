<?php
use Cake\Routing\Router;
?>
<div class="container min-vh-100 mt-5">
    <div class="row">
        <div class="col-lg-2 d-lg-block d-none">
            <?=$this->element('../Favourites/Common/sidebar')?>
        </div>
        <div class="col-lg-10 col-12">
            <div class="resultsFavs mt-4"></div>
        </div>
    </div>
    <?=$this->Form->create()?>
    <?=$this->Form->end()?>
</div>
<?=$this->Html->script('results.js')?>