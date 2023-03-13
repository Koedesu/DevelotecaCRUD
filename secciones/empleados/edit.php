<?php 
    include("../../db.php");

    if(isset($_GET['txtID'])){

        $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
      
        $sentencia = $conn -> prepare("SELECT * FROM tbl_empleados WHERE id=:id");
        $sentencia -> bindParam(":id",$txtID);
        $sentencia -> execute();
      
        $registro = $sentencia -> fetch(PDO::FETCH_LAZY);
      
        $pnombre = $registro["pnombre"];
        $snombre = $registro["snombre"];
        $papellido = $registro["papellido"];
        $sapellido = $registro["sapellido"];

        $foto = $registro["foto"];
        $cv = $registro["cv"];

        $idpuesto = $registro["idpuesto"];
        $fechadeingreso = $registro["fechadeingreso"];
        
        //$qr_code = $registro["qr_code"];
      }
      $sentencia = $conn -> prepare("SELECT * FROM `tbl_puestos`");
$sentencia -> execute();
$lista_tbl_puestos = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
?>

<?php 
include("../../templates/header.php");
?>

<br>
<div class="card">
    <div class="card-header">
        <h4>
            Editar empleado
        </h4> 
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="txtID" class="form-label">ID:</label>
      <input type="text"
        value= "<?php echo $txtID; ?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>

    <div class="mb-3">
      <label for="pnombre" class="form-label">Primer Nombre</label>
      <input type="text"
        value= "<?php echo $pnombre; ?>"
        class="form-control" name="pnombre" id="pnombre" aria-describedby="helpId" placeholder="Primer Nombre">
    </div>

    <div class="mb-3">
      <label for="snombre" class="form-label">Segundo Nombre</label>
      <input type="text"
        value= "<?php echo $snombre; ?>"
        class="form-control" name="snombre" id="snombre" aria-describedby="helpId" placeholder="Segundo Nombre">
    </div>

    <div class="mb-3">
      <label for="papellido" class="form-label">Primer Apellido</label>
      <input type="text"
        value= "<?php echo $papellido; ?>"
        class="form-control" name="papellido" id="papellido" aria-describedby="helpId" placeholder="Primer Apellido">
    </div>

    <div class="mb-3">
      <label for="sapellido" class="form-label">Segundo Apellido</label>
      <input type="text"
        value= "<?php echo $sapellido; ?>"
        class="form-control" name="sapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
    </div>

    <div class="mb-3">
      <label for="" class="form-label">Foto:</label>
      <br>
      <img width="100" 
                                src="<?php echo $foto;?>" 
                                class="rounded-top" alt="">
                                <br> <br>
      <input type="file"
        class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
    </div>

    <div class="mb-3">
      <label for="cv" class="form-label">CV (PDF):</label>
      <br>
      <a href="<?php echo $cv; ?>"><?php echo $cv; ?>"</a>
      <input type="file" class="form-control" name="cv" id="cv" placeholder="PDF" aria-describedby="fileHelpId">
    </div>

    <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto:</label>
        <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
        <?php foreach ($lista_tbl_puestos as $registro) { ?>

            <option <?php echo ($idpuesto == $registro['id'])?"selected":"";   ?> value="<?php echo $registro['id']; ?>">
            <?php echo $registro['nombredelpuesto']; ?>
          </option>
            <?php } ?>

        </select>
    </div>

    <div class="mb-3">
      <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
      <input value= "<?php echo $fechadeingreso; ?>" 
      type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso:">
    </div>

    <button type="submit" class="btn btn-success">Actualizar Registro</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

    </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php
include("../../templates/footer.php");

?>