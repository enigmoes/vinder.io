<?php
   $this->Paginator->setTemplates([
      'prevDisabled' => '<li class="page-item disabled shadow-sm"><a class="page-link" href="{{url}}">&laquo;</a></li>',
      'prevActive' => '<li class="page-item shadow-sm"><a class="page-link" href="{{url}}">&laquo;</a></li>',
      'number' => '<li class="page-item shadow-sm"><a class="page-link" href="{{url}}">{{text}}</a></li>',
      'current' => '<li class="page-item active shadow-sm"><a class="page-link" href="{{url}}">{{text}}</a></li>',
      'nextActive' => '<li class="page-item shadow-sm"><a class="page-link" href="{{url}}">&raquo;</a></li>',
      'nextDisabled' => '<li class="page-item disabled shadow-sm"><a class="page-link" href="{{url}}">&raquo;</a></li>',
   ]);
?>
<?php if ($this->Paginator->numbers()): ?>
<nav aria-label="Page navigation example">
   <ul class="pagination justify-content-center mt-3">
      <?= $this->Paginator->prev('&laquo;', ['tag' => 'li', 'escape' => false]); ?>
      <?= $this->Paginator->numbers(); ?>
      <?= $this->Paginator->next('&raquo;', ['tag' => 'li', 'escape' => false]); ?>
   </ul>
</nav>
<?php endif; ?>