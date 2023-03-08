<?php   
include("../../db.php");

if($_POST){
    //Recolectamos los datos del metodo POST
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");

    $qr_data = "Nombre: $nombredelpuesto";
    $qr_code = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . urlencode($qr_data);

    //Preparar insercion de los datos
    $sentencia = $conn -> prepare("INSERT INTO tbl_puestos(id,nombredelpuesto,qr_code)
        VALUES (null, :nombredelpuesto, :qr_code)");

    //Asignando los valores que vienen del moetodo POST
    $sentencia -> bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia -> bindParam(":qr_code",$qr_code);
    $sentencia -> execute();
    

    Header("Location:index.php");
}
?>
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