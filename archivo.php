<?php 
// print_r($_POST);
// print_r($_FILES);
$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre = (isset($_POST['txt-nombre']))?$_POST['txt-nombre']:"";
$txtImagen = (isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");

// echo $txtID."<br>";
// echo $txtNombre."<br>";
// echo $txtImagen."<br>";
// echo $accion."<br>";

switch($accion){
        $sentenciaSQL = $conexion->prepare("DELETE FROM productos WHERE id=:id"); 
        $sentenciaSQL -> bindParam(":id", $txtID);
        $sentenciaSQL -> execute();
        // echo "Presionado boton borrar";
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
    
    <div class="card">

        <div class="card-header">
            ESTO ES EL CARD
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class = "form-group">
            <label for="txtID">ID</label>
            <input type="text" class="form-control" id="txtID" name="txtID" placeholder="ID" value="<?php echo $txtID ?>">
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>

            <div class="form-group">
            <label for="txt-nombre">Nombre</label>
            <input type="text" class="form-control" id="txt-nombre" value="<?php echo $txtNombre ?>" name="txt-nombre" placeholder="Nombre">
            </div>

            <div class="form-group">
            <label for="txtImagen">Imagen</label>
            <input type="file" class="form-control" name="txtImagen" id="txtImagen"> 
            <?php echo $txtImagen; ?>
            </div>

            <div class="btn-group">
                <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>
    </form>
        </div>
    </div>

</div>

<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($listaProductos as $products) {
        ?>
            <tr>
                <td><?php echo $products['id'] ?></td>
                <td><?php echo $products['nombre'] ?></td>
                <td><?php echo $products['imagen'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $products['id']; ?>"/>
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        <?php }  ?>
        </tbody>
    </table>
</div>