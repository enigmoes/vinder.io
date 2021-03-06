<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
    <?= isset($message) ? $message : '' ?>
    <?php if(isset($params)) { ?>
        <a
            id="error_link"
            class="text-lightblue font-weight-bold"
            href="<?= isset($params['link']) ? $params['link'] : '' ?>"
            data-url="<?= isset($params['link_ajax']) ? $params['link_ajax'] : '' ?>">
            <?= isset($params['link_msg']) ? $params['link_msg'] : '' ?>
        </a>
    <?php } ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
