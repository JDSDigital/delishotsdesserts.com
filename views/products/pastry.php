<?php

/* @var $this yii\web\View */
/* @var $products */

use yii\helpers\Html;

$this->title = 'Nuestros Productos';
?>
<div class="site-pastry">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut felis consequat sapien tincidunt pretium in et tortor. Proin commodo arcu in tellus fermentum, vitae porta ligula lobortis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices turpis vel vehicula tincidunt. Ut sed sodales nibh. Phasellus dignissim sodales sodales. Suspendisse facilisis odio et dolor condimentum, ac tristique augue venenatis. Pellentesque in tellus lectus. Fusce sed volutpat nisl.</p>
            <!--<p>Nam quis neque at ligula commodo vestibulum eget nec neque. Duis ut mi sit amet lectus auctor gravida quis in nisl. Suspendisse potenti. Aliquam non arcu orci. Sed sodales accumsan tellus ut aliquam. Aliquam et purus at erat ullamcorper venenatis vel vitae nisl. Maecenas congue blandit sem, ac efficitur metus malesuada vitae. Cras interdum placerat dolor, vestibulum porta mauris sagittis a. Duis at feugiat tortor. Nunc ac commodo elit. Nulla ut venenatis elit. Fusce semper metus vel ante sagittis volutpat.</p>-->
        </div>
        <div class="col-md-6">
            <?= Html::img(Yii::getAlias('@web') . '/images/products/full/pastry02.jpg', [
                'class' => 'img-fluid m0a animated fadeInUp',
                'alt'   => Html::encode('Delishots & Desserts'),
            ]) ?>
        </div>
    </div>
</div>
</div>
<div class="container">
<div class="site-pastry">
    <div class="row">
        <div class="col-md-12">
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut felis consequat sapien tincidunt pretium in et tortor. Proin commodo arcu in tellus fermentum, vitae porta ligula lobortis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultrices turpis vel vehicula tincidunt. Ut sed sodales nibh. Phasellus dignissim sodales sodales. Suspendisse facilisis odio et dolor condimentum, ac tristique augue venenatis. Pellentesque in tellus lectus. Fusce sed volutpat nisl.</p>
            <p>Nam quis neque at ligula commodo vestibulum eget nec neque. Duis ut mi sit amet lectus auctor gravida quis in nisl. Suspendisse potenti. Aliquam non arcu orci. Sed sodales accumsan tellus ut aliquam. Aliquam et purus at erat ullamcorper venenatis vel vitae nisl. Maecenas congue blandit sem, ac efficitur metus malesuada vitae. Cras interdum placerat dolor, vestibulum porta mauris sagittis a. Duis at feugiat tortor. Nunc ac commodo elit. Nulla ut venenatis elit. Fusce semper metus vel ante sagittis volutpat.</p>-->
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= Html::img(Yii::getAlias('@web') . '/images/products/full/pastry05.jpg', [
                'class' => 'img-fluid m0a animated fadeInUp',
                'alt'   => Html::encode('Delishots & Desserts'),
            ]) ?>
        </div>
        <div class="col-md-8">
            <p>Nunc facilisis aliquet tortor, quis dignissim velit molestie sed. Suspendisse sed felis et quam efficitur imperdiet quis sed felis. Integer egestas justo sit amet neque aliquam, eget accumsan elit rhoncus. Quisque vitae elementum mi, non mattis elit. Proin congue leo nec mi feugiat faucibus. Vivamus interdum faucibus dui, non posuere nunc congue sed. Vestibulum in semper justo. Curabitur pellentesque urna lorem. Morbi elit eros, vulputate ut facilisis et, sollicitudin id sem. Nullam imperdiet lobortis massa, a pellentesque diam imperdiet a. Proin risus metus, pharetra vitae arcu aliquam, dapibus iaculis tellus. Proin eget ex vel dui faucibus consequat. Nullam non euismod sapien, eget elementum dolor. Sed faucibus purus id mauris eleifend, a imperdiet sapien accumsan. In lacinia turpis et est hendrerit pharetra. Donec convallis et risus ullamcorper dapibus.</p>
            <!--<p>Quisque suscipit ut felis vel semper. Praesent ex diam, lobortis euismod vehicula ut, lacinia non diam. Nullam pharetra cursus orci eget cursus. Vestibulum accumsan augue nec diam feugiat sodales quis id enim. Sed imperdiet tortor quis augue pulvinar interdum. Quisque vulputate elementum massa, a efficitur elit pharetra ac. Nunc molestie lectus tortor, sed sagittis augue pellentesque vel. Nunc blandit faucibus dui.</p>
            <p>Integer mattis augue ac fringilla cursus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus consequat eros sit amet eleifend accumsan. Etiam eget pellentesque massa. Donec sit amet nibh nibh. Proin efficitur quam nunc, non dignissim ligula pretium nec. Suspendisse potenti. Vivamus venenatis id enim quis auctor. Aliquam sed maximus libero, a congue diam. Vivamus sapien justo, bibendum a tincidunt ut, consequat at augue. Maecenas purus ex, vulputate vel diam a, venenatis ullamcorper ipsum. Donec id imperdiet augue. Mauris quis pulvinar diam. Curabitur luctus nisl eget sem bibendum, ac faucibus enim feugiat. Proin porta convallis erat id ornare.</p>-->
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><?= Html::a('Contáctanos para mayor información', ['site/contact'] ) ?></h4>
                </div>
            </div>
        </div>
    </div>

</div>
