<div class="copyright">
    <p class="m-0">Copyright © <?=date('Y')?> Vinder - <?= __('Todos los derechos reservados.') ?></p>
</div>
<!-- UP BUTTON -->
<button type="button" class="btn text-white scroll animated fadeOut">
    <i class="fas fa-chevron-up"></i>
</button>
<!-- MODAL AÑADIR ETIQUETA -->
<div id="modal-tag-add" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTag" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-custom">
                <h5 class="h5 h5-modal m-0" id="modalTag"><?=__('Añadir etiquetas')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body my-3"></div>
        </div>
    </div>
</div>