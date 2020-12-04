<?php
    include("db.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT*FROM requerimientos Where CODREQ = '$id'";
        $resultado = mysqli_query($conexion, $query);
        if(mysqli_num_rows($resultado) == 1){
            $row = mysqli_fetch_array($resultado);
            $codigo = $row['CODREQ'];
            $descripcion = $row['DESREQ'];
            $tipo = $row['TIPREQ'];
            $valor_ref = $row['VREFREQ'];
            $ncc = $row['NCCPREQ'];
            $nro_conv = $row['NCONVREQ'];
            $plazo_dias = $row['PLAZOREQ'];
            $f_conv = $row['FCONREQ'];
            $inicio = $row['FICREQ'];
            $fin = $row['FFCREQ'];
        }
    }

    if (isset($_POST['update'])) {
        $codigo = $_GET['codigo'];
        $descripcion = $_POST['descripción'];
        $tipo = $_POST['tipo'];
        $valor_ref = $_POST['valorref'];
        $ncc = $_POST['ncc'];
        $nro_conv = $_POST['nroconv'];
        $plazo_dias = $_POST['plazo'];
        $f_conv = $_POST['fconv'];
        $inicio = $_POST['inicio'];
        $fin = $_POST['fin'];

        echo $descripcion;
      
        $query = "UPDATE requerimientos set DESREQ = '$descripcion', TIPREQ = '$tipo', VREFREQ = '$valor_ref', 
        NCCPREQ = '$ncc', NCONVREQ = '$nro_conv', PLAZOREQ = '$plazo_dias', FCONREQ = '$f_conv', FICREQ = '$inicio', 
        FFCREQ = '$fin'  WHERE CODREQ = '$codigo'";

        mysqli_query($conexion, $query);

        $_SESSION['message'] = 'Actualizado satisfactoriamente';
        $_SESSION['message_type'] = 'warning';

        header("Location: home.php");

      }
      
      ?>

<?php include("includes/header.php") ?>

<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="edit.php?id=<?php echo $_GET['CODREQ']; ?>" method="POST">
        <div class="form-group">
            <input name="codigo" type="text" class="form-control" value="<?php echo $codigo; ?>">
        </div>
        <div class="form-group">
            <input name="descripcion" type="text" class="form-control" value="<?php echo $descripcion;?>">
        </div>
        <div class="form-group">
            <input name="tipo" type="text" class="form-control" value="<?php echo $tipo;?>">
        </div>
        <div class="form-group">
            <input name="valorref" type="number" class="form-control" value="<?php echo $valor_ref?>">
        </div>
        <div class="form-group">
            <input name="ncc" type="number" class="form-control" value="<?php echo $ncc;?>">
        </div>
        <div class="form-group">
            <input name="nroconv" type="number" class="form-control" value="<?php echo $nro_conv;?>">
        </div>
        <div class="form-group">
            <input name="plazo" type="number" class="form-control" value="<?php echo $plazo_dias;?>">
        </div>
        <div class="form-group">
            <input name="fconv" type="date" class="form-control" value="<?php echo $f_conv;?>">
        </div>
        <div class="form-group">
            <input name="inicio" type="date" class="form-control" value="<?php echo $inicio;?>">
        </div>
        <div class="form-group">
            <input name="fin" type="date" class="form-control" value="<?php echo $fin;?>">
        </div>
        <button class="btn-success" name="update">
          Actualizar
        </button>
      </form>
      </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php") ?>