<?php
require BASE_PATH . "/Resources/Views/Partials/doctype.php";
require BASE_PATH . "/Resources/Views/Partials/head.php";
require BASE_PATH . "/Resources/Views/Partials/nav.php";
require BASE_PATH . "/Resources/Views/Partials/headers/header.php";
require BASE_PATH . "/Resources/Views/Partials/main-start.php";
require BASE_PATH . "/Resources/Views/Partials/container-1024-start.php";
?>
<div class="registro-remate__container f-row align-center">
  <div class="registro-remate-form-wrap">
    <form id="form-actualizar-usuario" class="actualizar-usuario__form f-column"
      autocomplete="off">
      <div class="header">
        <div class="container-1024 f-row">
          <h3>Usuario</h3>
        </div>
      </div>
      <?php require BASE_PATH . "/Resources/Views/Root/form-usuario.php"; ?>
      <div class="header">
        <div class="container-1024 f-row">
          <h3>Datos personales</h3>
        </div>
      </div>
      <?php require BASE_PATH . "/Resources/Views/Root/form-datos-personales.php"; ?>
    </form>
  </div>
</div>
<?php
require BASE_PATH . "/Resources/Views/Partials/container-1024-end.php";
require BASE_PATH . "/Resources/Views/Partials/main-end.php";
$view = Container::resolve(View::class);
$view->assign("script", "crear-admin");
$view->render(BASE_PATH . "/Resources/Views/Partials/footer.php");
?>