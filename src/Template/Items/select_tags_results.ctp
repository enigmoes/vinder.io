<?php
use Cake\Routing\Router;
?>
<?php if (isset($tags) && count($tags) > 0): ?>
    <select name="tags" class="select-custom py-1 px-2">
        <?php foreach ($tags as $tag): ?>
            <option value=<?=$tag->name?>><?=$tag->name?></option>
        <?php endforeach?>
    </select>
<?php endif?>