<?php
use Cake\Routing\Router;
?>
<div class="container min-vh-100 mt-5">
    <div class="row">
        <div class="col-lg-2 d-lg-block d-none div-sidebar">
            <?=$this->element('Common/sidebar_tags')?>
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
            <div class="results-items"></div>
        </div>
    </div>
</div>
<div id="modal-tag" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTag" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="h5 h5-modal m-0" id="modalTag"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-around my-3"></div>
        </div>
    </div>
</div>
<?=$this->Html->script('tags.js')?>