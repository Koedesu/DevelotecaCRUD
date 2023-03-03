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
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">1</td>
                        <td>Koedesu</td>
                        <td>*****</td>
                        <td>marco@hotmail.com</td>
                        <td>
                            <input name="btn-editar" id="btn-editar" class="btn btn-info" type="button" value="Editar">
                            <input name="btn-eliminar" id="btn-eliminar" class="btn btn-danger" type="button" value="Eliminar">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php
include("../../templates/footer.php");

?>