<?php 

include("../../templates/header.php");
?>
<br>

<div class="card">
    <div class="card-header">
        <h4>Puestos</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="nombredelpuesto" class="form-label">Nombre del Puesto:</label>
      <input type="text"
        class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombe del puesto:">
    </div>

    <button type="submit" class="btn btn-success">Agregar</button> 
    <a name="btn-cancelar" id="btn-cancelar" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

    </form>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php
include("../../templates/footer.php");

?>