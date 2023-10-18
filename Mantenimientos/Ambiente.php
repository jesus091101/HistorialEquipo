<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>MANTENIMIENTO DE AMBIENTE</h2>
                <a href="Registros/RegistrarAmbiente.php" class="btn btn-success">Nuevo ambiente</a>
                <form action="">
                    <input type="text" placeholder="Buscar por codigo o nombre">
                    <button>Buscar</button>
                </form>
                <table class="table table-ms">
                    <tr>
                        <td>ID</td>
                        <td>N° Ambiente</td>
                        <td>Nombre</td>
                        <td>Vigente</td>
                        <td>Operaciones</td>
                    </tr>
                    <?php
                    require("../conexion.php");
                    //preparacion de sentencia
                    $sentencia = $conexion->prepare("select * from ambiente");
                    //formato de devolucion
                    $sentencia->setFetchMode(PDO::FETCH_ASSOC);
                    $sentencia->execute();

                    //Recorre la sentencia y sus resultados
                    while ($fila = $sentencia->fetch()) {
                        echo ("<tr>");
                        echo ("<td>" . $fila['Codigo'] . "</td>");
                        echo ("<td>" . $fila['NumAmbiente'] . "</td>");
                        echo ("<td>" . $fila['Nombre'] . "</td>");
                        echo ("<td>" . $fila['Vigente'] . "</td>");
                        echo ("<td>" . "<a href='Modificar/ModificarAmbiente.php?Codigo={$fila['Codigo']}' class='btn btn-danger'>Modificar</a>" . "</td>");
                        echo ("</tr>");
                    }
                    ?>
                </table>
            </main>
        </div>
    </div>
</body>

</html>
