<?php

include("../../db.php");

//Envio de parametros a traves de la URL en el metodo GET
//METODO DELETE
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia = $conn -> prepare("DELETE FROM tbl_empleados WHERE id=:id");
    $sentencia -> bindParam(":id",$txtID);
    $sentencia -> execute();
    Header("Location:index.php");

}
$sentencia = $conn -> prepare("SELECT *, 

/* SUBCONSULTA PARA SACAR EL VALOR DE PUESTO*/
(SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto 

FROM `tbl_empleados`");
$sentencia -> execute();
$lista_tbl_empleados = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
?>
<?php 
include("../../templates/header.php");
?>
<br>
<h4>Empleados </h4>
<div class="card">
    <div class="card-header">
        
        <a name="" id="" class="btn btn-primary" href="create.php" role="button">
            Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_tbl_empleados as $registro){ ?>
                        <tr class="">
                            <td><?php echo $registro['id']; ?></td>
                            <td scope="row">
                                <?php echo $registro['pnombre'];?>
                                <?php echo $registro['snombre'];?>
                                <?php echo $registro['papellido'];?>
                                <?php echo $registro['sapellido'];?>
                            </td>
                            <td><?php echo $registro['foto'];?></td>
                            <td><?php echo $registro['cv'];?></td>
                            <td><?php echo $registro['puesto'];?></td>
                            <td><?php echo $registro['fechaingreso'];?></td>
                            <td><a name="" id="" class="btn btn-success" href="#" role="button">
                            Carta</a>
                            <a class="btn btn-info" href="edit.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                            <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id']; ?>" role="button">Eliminar</a>
                            </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>


<?php
include("../../templates/footer.php");

?>