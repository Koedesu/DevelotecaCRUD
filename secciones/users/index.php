<?php  
include("../../db.php");


$sentencia = $conn -> prepare("SELECT * FROM `tbl_usuarios`");
$sentencia -> execute();
$lista_tbl_usuarios = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
?>

<?php 
include("../../templates/header.php");
?>
<br>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" 
        href="create.php" role="button">
        Agregar Usuarios</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_tbl_usuarios as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id']; ?></td>
                            <td><?php echo $registro['usuario']; ?></td>
                            <td><?php echo $registro['correo'];?></td>
                            <td>
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