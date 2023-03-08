<?php   
include("../../db.php");

if($_POST){
    //Recolectamos los datos del metodo POST
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
    //Preparar insercion de los datos
    $sentencia = $conn -> prepare("INSERT INTO tbl_usuarios(id,usuario,password,correo)
        VALUES (null, :usuario, :password, :correo)"); 
    //Asignando los valores que vienen del moetodo POST
    $sentencia -> bindParam(":usuario",$usuario);
    $sentencia -> bindParam(":password",$password);
    $sentencia -> bindParam(":correo",$correo);
    $sentencia -> execute();
  
    //Header("Location:index.php");
}
?>
<?php 
include("../../templates/header.php");
?>
<br>

<div class="card">
    <div class="card-header">
        <h4>Usuario</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="usuario" class="form-label">Nombre del Usuario:</label>
      <input type="text"
        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombe del Usuario:">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password"
        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
    </div>

    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="email"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
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