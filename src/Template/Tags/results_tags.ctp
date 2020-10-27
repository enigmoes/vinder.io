<?php
use Cake\Routing\Router;
?>
<?php if (isset($tags) && count($tags) > 0): ?>
    <div class="h6-default"><?=__("Todas las etiquetas")?></div>
    <ul>
        <?php foreach ($tags as $tag): ?>
            <li class="px-2">
                <a href="#">
                    <?=h($tag->name)?>
                </a>
                <a href="#" class="editItem">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </li>
        <?php endforeach?>
    </ul>
<?php endif?>