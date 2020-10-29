<?php
use Cake\Routing\Router;
?>
<?php if (isset($tags) && count($tags) > 0): ?>
    <div class="h6-default"><?=__("Todas las etiquetas")?></div>
    <ul>
        <?php foreach ($tags as $tag): ?>
            <li class="px-2">
                <a href="javascript:void(0)" class="tag" data-id="<?= $tag->id ?> " data-name="<?= $tag->name ?>">
                    <?= $tag->name ?>
                </a>
                <a href="javascript:void(0)" class="tag-edit">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </li>
        <?php endforeach?>
    </ul>
<?php endif?>