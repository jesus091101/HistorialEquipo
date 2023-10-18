<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php
    require("../../conexion.php");
    if (isset($_POST['btnModificar'])) {
        if (
            isset($_POST['Codigo'])==true &&
            isset($_POST['NumAmbiente']) == true &&
            isset($_POST['Nombre']) == true
        ) {
            $codigo = intval($_POST['Codigo']);
            $numAmbiente = $_POST['NumAmbiente'];
            $nombre = $_POST['Nombre'];
            try {
                $sql = "update ambiente
                        set NumAmbiente=? ,
                            Nombre = ?
                        where Codigo=?";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute([$numAmbiente, $nombre, $codigo]);

                echo "Ambiente modificado";
                echo "<a href='../Ambiente.php' class='btn btn-info'> Regresar a mantenimiento</a>";
            } catch (PDOException $e) {
                echo "ERROR: ", $e->getMessage();
            }
        }
    } else {
        $codigo = $_GET['Codigo'];

        $sql = "select * from ambiente where Codigo = $codigo";
        $registro = $conexion->prepare($sql);
        $registro->execute();

        //Obtener la FILA del Alumno
        $fila = $registro->fetch();

    ?>

        <div class="container">
            <h1>REGISTRO NUEVO AMBIENTE</h1>
            <form action="ModificarAmbiente.php" method="POST">
                <input type="text" name="Codigo" value="<?= $codigo ?>" hidden>

                <div class="form-group">
                    <label for="NumAmbiente">Numero Ambiente</label>
                    <input type="text" name="NumAmbiente" value="<?= $fila['NumAmbiente'] ?>" class="form-control" require>
                </div>
                <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input type="text" name="Nombre" value="<?= $fila['Nombre'] ?>" class="form-control" require><br>
                </div>
                <div class="form-group">
                    <button name="btnModificar" type="submit" class="btn btn-primary form-control">Guardar</button>
                </div>
            </form>
            <br>
            <a href="../Ambiente.php" class="btn btn-success form-control">Regresar a mantenimiento</a>
        </div>
    <?php
    }
    ?>
</body>

</html>