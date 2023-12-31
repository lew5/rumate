<?php

class ClienteController
{
  public function listarClientes()
  {
    Middleware::admin();
    $personaService = Container::resolve(PersonaService::class);
    $clientes = $personaService->getPersonasConTipoCliente();
    $view = Container::resolve(View::class);
    $view->assign("title", "Rumate - Clientes");
    $view->assign("header_title", "Clientes");
    $view->assign("clientes", $clientes);
    $view->render(BASE_PATH . "/Resources/Views/Cliente/cliente.view.php");
  }
}

?>