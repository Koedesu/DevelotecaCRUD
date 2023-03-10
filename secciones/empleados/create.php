<?php   
include("../../db.php");

if($_POST){
    //Recolectamos los datos del metodo POST
    $pnombre=(isset($_POST["pnombre"])?$_POST["pnombre"]:"");
    $snombre=(isset($_POST["snombre"])?$_POST["snombre"]:"");
    $papellido=(isset($_POST["papellido"])?$_POST["papellido"]:"");
    $sapellido=(isset($_POST["sapellido"])?$_POST["sapellido"]:"");

    $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");
    $cv=(isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");
    
    $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
    $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

    //Preparar insercion de los datos
    $sentencia = $conn -> prepare("INSERT INTO 
    `tbl_empleados` (`id`, `pnombre`, `snombre`, `papellido`, 
    `sapellido`, `foto`, `cv`, `idpuesto`, `fechaingreso`) 
    VALUES (NULL, :pnombre, :snombre, :papellido, :sapellido, :foto, :cv, :idpuesto, :fechadeingreso);"); 

    //Asignando los valores que vienen del moetodo POST
    $sentencia -> bindParam(":pnombre",$pnombre);
    $sentencia -> bindParam(":snombre",$snombre);
    $sentencia -> bindParam(":papellido",$papellido);
    $sentencia -> bindParam(":sapellido",$sapellido);

    $fecha_ = new DateTime();
    
    //SENTECIA FOTO
    $nombreArchivo_foto = ($foto!='')?$fecha_ -> getTimestamp()."_".$_FILES["foto"]['name']:"";
    $tmp_foto = $_FILES["foto"]['tmp_name'];
    if($tmp_foto!=''){
      move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
    }
    $sentencia -> bindParam(":foto",$nombreArchivo_foto);

    //SENTENCIA PDF
    $nombreArchivo_cv = ($cv!='')?$fecha_ -> getTimestamp()."_".$_FILES["cv"]['name']:"";
    $tmp_cv = $_FILES["cv"]['tmp_name'];
    if($tmp_foto!=''){
      move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
    }
    $sentencia -> bindParam(":cv",$nombreArchivo_cv);

    $sentencia -> bindParam(":idpuesto",$idpuesto);
    $sentencia -> bindParam(":fechadeingreso",$fechadeingreso);
  
    $sentencia -> execute();
  
    Header("Location:index.php");
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
        Agregar datos del empleado
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="pnombre" class="form-label">Primer Nombre</label>
      <input type="text"
        class="form-control" name="pnombre" id="pnombre" aria-describedby="helpId" placeholder="Primer Nombre">
    </div>

    <div class="mb-3">
      <label for="snombre" class="form-label">Segundo Nombre</label>
      <input type="text"
        class="form-control" name="snombre" id="snombre" aria-describedby="helpId" placeholder="Segundo Nombre">
    </div>

    <div class="mb-3">
      <label for="papellido" class="form-label">Primer Apellido</label>
      <input type="text"
        class="form-control" name="papellido" id="papellido" aria-describedby="helpId" placeholder="Primer Apellido">
    </div>

    <div class="mb-3">
      <label for="sapellido" class="form-label">Segundo Apellido</label>
      <input type="text"
        class="form-control" name="sapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
    </div>

    <div class="mb-3">
      <label for="" class="form-label">Foto</label>
      <input type="file"
        class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
    </div>

    <div class="mb-3">
      <label for="cv" class="form-label">CV (PDF):</label>
      <input type="file" class="form-control" name="cv" id="cv" placeholder="PDF" aria-describedby="fileHelpId">
    </div>

    <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto:</label>

        <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
        <?php foreach ($lista_tbl_puestos as $registro) { ?>
            <option value="<?php echo $registro['id']; ?>">
            <?php echo $registro['nombredelpuesto']; ?>
          </option>
            <?php } ?>

        </select>
    </div>

    <div class="mb-3">
      <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
      <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso:">
    </div>

    <button type="submit" class="btn btn-success">Agregar Registro</button>
    <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

    </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php
include("../../templates/footer.php");
?>