<!DOCTYPE html>
<html lang="es">
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css('pdf.css', ['fullBase' => true]) ?>
    <style></style>
</head>
<body>
    <div>
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>
