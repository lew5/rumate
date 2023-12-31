<div class="card-remate">
  <img class="card-remate__image" src="<?= $lote->getImagen(); ?>"
    alt="Imagen de remate">
  <div class="card-remate__info">
    <h2 class="card-remate__title">LOTE de
      <?= $lote->getCategoria()->getNombre(); ?>s
      <a href=""><span>#<?= $lote->getProveedor()->getUsername(); ?></span></a>
    </h2>
    <p class="card-remate__data"><b>Categoría:
      </b><?= $lote->getCategoria()->getNombre(); ?>
    </p>
    <p class="card-remate__data"><b>Cantidad:
      </b><?= $lote->getFicha()->getCantidad(); ?></p>
    <p class="card-remate__data"><b>Peso:
      </b><?= $lote->getFicha()->getPeso(); ?>
      kg</p>
  </div>
  <?php if (sessionAdmin() || sessionRoot()) { ?>
    <div class="card-remate__button">
      <a href="<?= PUBLIC_PATH ?>/admin/lote/editar/<?= $lote->getId(); ?>"
        class="link link--editar">Editar</a>
    </div>
  <?php } ?>
  <div class="card-remate__button">
    <a href="<?= PUBLIC_PATH ?>/remate/<?= $idRemate; ?>/lote/<?= $lote->getId(); ?>"
      class="link">Participar</a>
  </div>
</div>