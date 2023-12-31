<?php
require BASE_PATH . "/Resources/Views/Partials/doctype.php";
require BASE_PATH . "/Resources/Views/Partials/head.php";
require BASE_PATH . "/Resources/Views/Partials/nav.php";
require BASE_PATH . "/Resources/Views/Partials/headers/header.php";
require BASE_PATH . "/Resources/Views/Partials/main-start.php";
require BASE_PATH . "/Resources/Views/Partials/container-1024-start.php";
?>
<?php require BASE_PATH . "/Resources/Views/Remate/form-editar-remate.php"; ?>
<div class="header">
  <div class="container-1024 f-row">
    <h2>Lotes</h2>

    <a href="<?= PUBLIC_PATH ?>/admin/remate/<?= $remate->getId() ?>/registrar-lote"
      class="button-link">Nuevo
      lote</a>
  </div>
</div>
<?php require BASE_PATH . "/Resources/Views/Lote/listar-lotes.php"; ?>

<?php
require BASE_PATH . "/Resources/Views/Partials/container-1024-end.php";
require BASE_PATH . "/Resources/Views/Partials/main-end.php";
$view = Container::resolve(View::class);
$view->assign("script", "actualizar-remate");
$view->render(BASE_PATH . "/Resources/Views/Partials/footer.php");
?>