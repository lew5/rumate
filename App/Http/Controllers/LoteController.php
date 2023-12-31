<?php
/**
 * Controlador para las acciones relacionadas con los lotes de remates.
 */
class LoteController
{
  /**
   * Muestra la página de un lote en un remate.
   * 
   * @param int $idRemate El ID del remate al que pertenece el lote.
   * @param int $idLote   El ID del lote que se mostrará.
   * 
   * @return void
   */
  public function index($idRemate, $idLote) 
  {
    $loteService = Container::resolve(LoteService::class);
    $lote = $loteService->getLoteById($idLote);


    $remate = Container::resolve(RemateService::class)->getRemateById($idRemate);

    $fechaInicio = $remate->getFechaInicio();
    $fechaFinal = $remate->getFechaFinal();

    $pendiente = pendiente($fechaInicio);
    $rematando = rematando($fechaInicio, $fechaFinal);
    $finalizado = finalizado($fechaFinal);

    $fechaFinal = formatFecha($remate->getFechaFinal());
    $fechaInicio = formatFecha($remate->getFechaInicio());

    $ofertaDe = $loteService->getUsernameOfertante($idRemate, $idLote);

    $proveedor = Container::resolve(UsuarioService::class)->getUsuarioByPersonaId($lote->getIdProveedor());

    $lote->setProveedor($proveedor);

    if ($lote != false) {
      $view = Container::resolve(View::class);
      $view->assign("title", "Rumate - Lote");
      $view->assign("header_title", "Lote <span>#$idLote</span>");
      $view->assign("lote", $lote);
      $view->assign("idRemate", $idRemate);
      $view->assign("pendiente", $pendiente);
      $view->assign("rematando", $rematando);
      $view->assign("finalizado", $finalizado);
      $view->assign("fechaInicio", $fechaInicio);
      $view->assign("fechaFinal", $fechaFinal);
      $view->assign("ofertaDe", $ofertaDe);
      $view->render(BASE_PATH . "/Resources/Views/Lote/lote.view.php");
    } else {
      abort();
    }
  }
  /**
   * Crea un nuevo lote en un remate.
   * 
   * @param int $idRemate El ID del remate al que se agregará el lote.
   * 
   * @return void
   */
  public function crearLote($idRemate)
  {
    Middleware::admin();
    if (Container::resolve(RemateService::class)->getRemateById($idRemate)) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $lotesData = json_decode($_POST['lote-data']);
        $lotes = [];
        foreach ($lotesData as $loteData) {
          $lote = Container::resolve(Lote::class);
          $lote->setImagen($loteData->imagen_lote);
          $lote->setPrecioBase($loteData->precio_base_lote);
          $lote->setIdProveedor($loteData->proveedor);
          $lote->setIdCategoria($loteData->categoria);
          $ficha = Container::resolve(Ficha::class);
          $ficha->setPeso($loteData->ficha->peso_ficha);
          $ficha->setCantidad($loteData->ficha->cantidad_ficha);
          $ficha->setRaza($loteData->ficha->raza_ficha);
          $ficha->setDescripcion($loteData->ficha->descripcion_ficha);
          $lote->setFicha($ficha);
          $lotes[] = $lote;
        }
        $remateService = Container::resolve(RemateService::class);
        try {
          $remateService->insertLotesByRemate($lotes, $idRemate);
          Route::redirect("/admin/remate/editar/$idRemate");
        } catch (PDOException $e) {
          // var_dump($e->errorInfo);
          abort(500);
        }
      } else {
        $categoriaRepository = Container::resolve(CategoriaRepository::class);
        $personaService = Container::resolve(PersonaService::class);

        $categorias = $categoriaRepository->find();
        $proveedores = $personaService->getPersonasConTipoProveedor();

        $view = Container::resolve(View::class);
        $view->assign("title", "Rumate - Crear lote");
        $view->assign("header_title", "Crear nuevo lote para el remate <span>#$idRemate</span>");
        $view->assign("categorias", $categorias);
        $view->assign("proveedores", $proveedores);
        $view->assign("idRemate", $idRemate);
        $view->render(BASE_PATH . "/Resources/Views/Lote/crear-lote.php");
      }
    } else {
      abort();
    }

  }
  /**
   * Lista todos los lotes de un remate.
   * 
   * @param int $idRemate El ID del remate del cual se listarán los lotes.
   * 
   * @return void
   */
  public function listarLotes($idRemate)
  {
    $remate = Container::resolve(RemateService::class)->getRemateById($idRemate);
    foreach ($remate->getLotes() as $lote) {
      $proveedor = Container::resolve(UsuarioService::class)->getUsuarioByPersonaId($lote->getIdProveedor());
      $lote->setProveedor($proveedor);
    }
    if ($remate != false) {
      $view = Container::resolve(View::class);
      $view->assign("title", "Rumate - Remate");
      $view->assign("header_title", "Lotes del remate  <span>#$idRemate</span>");
      $view->assign("remate", $remate);
      $view->render(BASE_PATH . "/Resources/Views/Remate/remate.view.php");
    } else {
      // abort();
    }
  }
  /**
   * Lista los lotes de un remate por categoría.
   * 
   * @param int    $idRemate  El ID del remate del cual se listarán los lotes.
   * @param string $categoria La categoría por la cual filtrar los lotes.
   * 
   * @return void
   */
  public function listarLotesPorCategoria($idRemate, $categoria)
  {
    if ($categoria == "*") {
      $remate = Container::resolve(RemateService::class)->getRemateById($idRemate);
      foreach ($remate->getLotes() as $lote) {
        $proveedor = Container::resolve(UsuarioService::class)->getUsuarioByPersonaId($lote->getIdProveedor());
        $lote->setProveedor($proveedor);
      }
      $view = Container::resolve(View::class);
      ob_start();
      $view->assign("remate", $remate);
      $view->render(BASE_PATH . "/Resources/Views/Lote/listar-lotes.php");
      $partialView = ob_get_clean();
      echo $partialView;
    } else if ($categoria) {
      $remate = Container::resolve(RemateService::class)->getRemateById($idRemate);
      foreach ($remate->getLotes() as $lote) {
        $proveedor = Container::resolve(UsuarioService::class)->getUsuarioByPersonaId($lote->getIdProveedor());
        $lote->setProveedor($proveedor);
      }

      $resultados = $this->buscarPorCategoria($remate->getLotes(), $categoria);
      $remate->setLotes($resultados);

      $view = Container::resolve(View::class);
      ob_start();
      $view->assign("remate", $remate);
      $view->render(BASE_PATH . "/Resources/Views/Lote/listar-lotes.php");
      $partialView = ob_get_clean();
      echo $partialView;
    }
  }
  /**
   * Filtra lotes por categoría en un array.
   * 
   * @param array  $array     El array de lotes a filtrar.
   * @param string $categoria La categoría por la cual filtrar.
   * 
   * @return array Un array con los lotes que coinciden con la categoría.
   */
  private function buscarPorCategoria($array, $categoria)
  {
    $resultados = [];

    foreach ($array as $elemento) {
      if (stripos($elemento->getCategoria()->getNombre(), $categoria) !== false) {
        $resultados[] = $elemento;
      }
    }

    return $resultados;
  }
}

?>