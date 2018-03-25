<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Delishots & Desserts';
?>
<div class="site-index" style="background-color:black">

    <div class="caption-logo">
        <?= Html::img(Yii::getAlias('@web') . '/images/logo.png')?>
    </div>

    <div class="caption">
        <h1>Galería de fotos por Alejandro Gil</h1>
    </div>

</div>
<?php
  $folder = Yii::getAlias('@web') . '/images/front/';
  $js = <<<JS
    $(".index-slider").vegas({
      delay: 7000,
      shuffle: true,
      loop: true,
      animation: 'random',
      slides: [
        { src: '$folder' + "01.jpg" },
        { src: '$folder' + "02.jpg" },
        { src: '$folder' + "03.jpg" },
        { src: '$folder' + "04.jpg" },
        { src: '$folder' + "05.jpg" },
        { src: '$folder' + "06.jpg" },
        { src: '$folder' + "07.jpg" },
        { src: '$folder' + "08.jpg" },
        { src: '$folder' + "09.jpg" },
        { src: '$folder' + "10.jpg" },
        { src: '$folder' + "11.jpg" },
        { src: '$folder' + "12.jpg" },
        { src: '$folder' + "13.jpg" }
      ]
    });
JS;
  $this->registerJs($js);
 ?>
