<?php
use Cake\Routing\Router;
?>
<?php if (isset($lists) && count($lists) > 0): ?>
    <?php foreach ($lists as $list): ?>
        <?php foreach ($items as $item): ?>
            <!-- <div class="row">
                <div class="col-4">-->
                    <div class="card card-items rounded-0">
                        <div class="card-body card-block">
                            <div class="h6 h6-default"><?=h($item->title)?></div>
                            <a href="#"><?=h($item->link)?></a>
                            <p><?=h($item->description)?></p>
                            <div class="items-icons">
                                <i class="fas fa-share-square"></i>
                                <i class="fas fa-tag"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-trash-alt"></i>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            <!-- </div> -->
        <?php endforeach;?>
    <?php endforeach;?>
<?php endif?>