<?php
require BASE_PATH . "/Resources/Views/Partials/doctype.php";
require BASE_PATH . "/Resources/Views/Partials/head.php";
require BASE_PATH . "/Resources/Views/Partials/nav.php";
require BASE_PATH . "/Resources/Views/Partials/headers/remate-header.php";
require BASE_PATH . "/Resources/Views/Partials/main-start.php";
require BASE_PATH . "/Resources/Views/Partials/container-1024-start.php";
?>

<?php require BASE_PATH . "/Resources/Views/Remate/listar-remates.php"; ?>

<?php
require BASE_PATH . "/Resources/Views/Partials/container-1024-end.php";
require BASE_PATH . "/Resources/Views/Partials/main-end.php";
$view = Container::resolve(View::class);
$view->assign("script", "busqueda-remate");
$view->render(BASE_PATH . "/Resources/Views/Partials/footer.php");
?>