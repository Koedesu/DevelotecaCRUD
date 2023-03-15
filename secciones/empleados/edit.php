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

        $sentencia = $conn -> prepare("SELECT * FROM `tbl_puestos`");
        $sentencia -> execute();
        $lista_tbl_puestos = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
        //$qr_code = $registro["qr_code"];
      }
      
if($_POST){
    //Recolectamos los datos del metodo POST
    $txtID =(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $pnombre=(isset($_POST["pnombre"])?$_POST["pnombre"]:"");
    $snombre=(isset($_POST["snombre"])?$_POST["snombre"]:"");
    $papellido=(isset($_POST["papellido"])?$_POST["papellido"]:"");
    $sapellido=(isset($_POST["sapellido"])?$_POST["sapellido"]:"");
    
    $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
    $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

    $sentencia = $conn -> prepare("UPDATE `tbl_empleados` SET pnombre=:pnombre, snombre=:snombre, papellido=:papellido,
    sapellido=:sapellido, idpuesto=:idpuesto, fechadeingreso=:fechadeingreso WHERE id=:id "); 

    $sentencia -> bindParam(":pnombre",$pnombre);
    $sentencia -> bindParam(":snombre",$snombre);
    $sentencia -> bindParam(":papellido",$papellido);
    $sentencia -> bindParam(":sapellido",$sapellido);

    $sentencia -> bindParam(":idpuesto",$idpuesto);
    $sentencia -> bindParam(":fechadeingreso",$fechadeingreso);
    $sentencia -> bindParam(":id",$txtID);
  
    $sentencia -> execute();

    $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");

    $fecha_ = new DateTime();
    
    //SENTECIA FOTO
    $nombreArchivo_foto = ($foto!='')?$fecha_ -> getTimestamp()."_".$_FILES["foto"]['name']:"";
    $tmp_foto = $_FILES["foto"]['tmp_name'];
    if($tmp_foto!=''){
      move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);

      $sentencia = $conn -> prepare("SELECT foto FROM `tbl_empleados` WHERE id=:id");
      $sentencia ->bindParam(":id",$txtID);
      $sentencia -> execute();
      $registro_recuperado = $sentencia -> fetch(PDO::FETCH_LAZY);

    if(isset($registro_recuperado["foto"])&& $registro_recuperado["foto"]!=""){
        if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);
        }
    }

      $sentencia = $conn -> prepare(" UPDATE tbl_empleados SET foto=:foto WHERE id=:id");
      $sentencia -> bindParam(":foto",$nombreArchivo_foto);
      $sentencia -> bindParam(":id",$txtID);
      $sentencia -> execute();
    }

    $cv=(isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");

    $nombreArchivo_cv = ($cv!='')?$fecha_ -> getTimestamp()."_".$_FILES["cv"]['name']:"";
    $tmp_cv = $_FILES["cv"]['tmp_name'];
    if($tmp_cv!=''){
      move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);

      $sentencia = $conn -> prepare("SELECT cv FROM `tbl_empleados` WHERE id=:id");
      $sentencia ->bindParam(":id",$txtID);
      $sentencia -> execute();
      $registro_recuperado = $sentencia -> fetch(PDO::FETCH_LAZY);

      if(isset($registro_recuperado["cv"])&& $registro_recuperado["cv"]!=""){
        if(file_exists("./".$registro_recuperado["cv"])){
            unlink("./".$registro_recuperado["cv"]);
        }
    }

      $sentencia = $conn -> prepare(" UPDATE tbl_empleados SET cv=:cv WHERE id=:id");
      $sentencia -> bindParam(":cv",$nombreArchivo_cv);
      $sentencia -> bindParam(":id",$txtID);
      $sentencia -> execute();

    }
  
    //Header("Location:index.php");
}

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
        class="form-control" name="sapellido" id="sapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
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

            <option <?php echo ($idpuesto == $registro['id'])?"selected":"";?> value="<?php echo $registro['id']; ?>">
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