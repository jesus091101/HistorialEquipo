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
                <input type="text" id="search" placeholder="Buscar por número de ambiente">
                
                <!-- Div para contenido AJAX -->
                <div id="contenidoAjax">
                    <table class="table table-ms">
                        <tr>
                            <td>ID</td>
                            <td>N° Ambiente</td>
                            <td>Nombre</td>
                            <td>Vigente</td>
                            <td>Operaciones</td>
                        </tr>
                        <tbody id="searchResults"></tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            var searchTerm = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('searchResults').innerHTML = xhr.responseText;
                }
            };
            xhr.send('search=' + searchTerm);
        });
    </script>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        $searchTerm = $_POST['search'];
        require("../conexion.php");
        $sentencia = $conexion->prepare("SELECT * FROM ambiente WHERE NumAmbiente LIKE ?");
        $searchTerm = "%$searchTerm%";
        $sentencia->bindParam(1, $searchTerm);
        $sentencia->execute();
        while ($fila = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $fila['Codigo'] . "</td>";
            echo "<td>" . $fila['NumAmbiente'] . "</td>";
            echo "<td>" . $fila['Nombre'] . "</td>";
            echo "<td>" . $fila['Vigente'] . "</td>";
            echo "<td><a href='Modificar/ModificarAmbiente.php?Codigo={$fila['Codigo']}' class='btn btn-danger'>Modificar</a></td>";
            echo "</tr>";
        }
    }
    ?>
</body>
</html>
