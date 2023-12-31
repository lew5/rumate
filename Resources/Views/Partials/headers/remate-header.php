<?php
if (sessionAdmin() || sessionRoot()): ?>
  <div class="header">
    <div class="container-1024 f-row">
      <h2><?= $header_title ?></h2>
      <?php
      $view = Container::resolve(View::class);
      $view->assign("placeholder", "Buscar remates");
      $view->render(BASE_PATH . "/Resources/Views/Partials/headers/barra-de-busqueda.php"); ?>
      <a href="<?= PUBLIC_PATH ?>/admin/registrar-remate"
        class="button-link">Nuevo remate</a>
    </div>
  </div>
<?php else: ?>
  <div class="header">
    <div class="container-1024 f-row">
      <h2><?= $header_title ?></h2>
      <?php
      $view = Container::resolve(View::class);
      $view->assign("placeholder", "Buscar remates");
      $view->render(BASE_PATH . "/Resources/Views/Partials/headers/barra-de-busqueda.php"); ?>
    </div>
  </div>
<?php endif; ?>