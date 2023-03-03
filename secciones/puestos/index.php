<?php

include("../../db.php");

//Envio de parametros a traves de la URL en el metodo GET
//METODO DELETE
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia = $conn -> prepare("DELETE FROM tbl_puestos WHERE id=:id");
    $sentencia -> bindParam(":id",$txtID);
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
        <a name="" id="" class="btn btn-primary" 
        href="create.php" role="button">
        Agregar Registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del Puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($lista_tbl_puestos as $registro) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id']; ?></td>
                        <td><?php echo $registro['nombredelpuesto']; ?></td>
                        <td>
                            <input name="btn-editar" id="btn-editar" class="btn btn-info" type="button" value="Editar">
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