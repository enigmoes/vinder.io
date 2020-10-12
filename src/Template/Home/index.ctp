<?php
use Cake\Routing\Router;
?>
<nav class="navbar navbar-default">
    <div class="navbar-header pl-5">
        <a class="navbar-brand" href="#">
            <?=$this->Html->image('logotipo_35.png', array('alt' => 'vinder', 'class' => 'w-10'))?>
        </a>
    </div>
    <ul class="nav navbar-right pr-5">
      <li><a href="#"><i class="fas fa-search"></i></a></li>
      <li><a href="#"><i class="fas fa-plus"></i></a></li>
      <li><a href="#"><i class="fas fa-user"></i></a></li>
    </ul>
</nav>
<div class="copyright">
    <p>Copyright © <?=date('Y')?> Vinder. All rights reserved.</p>
</div>
