<?php include("db.php") ?>
<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="col-md-4 mx-auto">

        <?php if(isset($_SESSION['message'])) {?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?>alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php session_unset();}?>

        <div class="card card-body">
            <form action="save_task.php" method="POST">
                <div class="form-group">    
                    <p>CODIGO <input type="text" placeholder="Ingrese el código" name="codigo" autofocus></p>
                    <p>DESCRIPCIÓN <input type="text" placeholder="Ingrese una descripción" name="descripción"> </p>
                    <!--<p>TIPO <input type="text" placeholder="Ingrese el tipo" name="tipo" ></p>-->
                    <p>TIPO  
                    <label><select name="tipo" id="sm">
            			<?php

                        $conn = mysqli_connect("localhost","root","","usuario") or die ("error al conectar");
                        $query = $conn -> query ("SELECT * FROM tipo");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="'.$valores['IdTipo'].'">'.$valores['NombreTipo'].'</option>';
                        }
                        mysqli_close($conn);
                        ?>
                        </select>
                    </p>
                    <p>VALOR REF <input type="number" placeholder="Ingrese el valor referencial" name="valorref" ></p>
                    <p>NCC <input type="number" placeholder="Ingrese el NCC" name="ncc" </p>
                    <p>NRO CONV <input type="number" placeholder="Ingrese el numero de conv" name="nroconv" ></p>
                    <p>PLAZO EN DIAS <input type="number" placeholder="Ingrese el plazo en días" name="plazo" ></p>
                    <p>F CONV <input type="date" placeholder="Ingrese fecha de conv" name="fconv" ></p>
                    <p>INICIO <input type="date" placeholder="Ingrese fecha de inicio" name="inicio" ></p>
                    <p>FIN <input type="date" placeholder="Ingrese fecha de fin" name="fin" ></p>
                    <input type="submit" class="btn btn-success btn-block" name="save_task" value="Guardar Nuevo">
                </div>
            </form>
        </div>       

    </div>

    <?php include("includes/footer.php") ?>