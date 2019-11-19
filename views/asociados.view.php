<?php
  include __DIR__ . "/partials/inicio-doc.part.php";
  include __DIR__ . "/partials/nav.part.php";
  ?>
<div id="asociados">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>ASOCIADOS</h1>
            <hr>
            <?php
                include __DIR__ . "/partials/show-messages.part.php";
            ?>
            <?php if (("POST" === $_SERVER["REQUEST_METHOD"]) && (!$form->hasError())) : ?>
                <a href='<?=$urlImagen?>' target='_blank'>Ver Imagen</a>
            <?php endif; ?>
           <?=$form->render();?>
           
        </div>
    </div>

</div>

<?php
  include __DIR__ . "/partials/fin-doc.part.php";
?>