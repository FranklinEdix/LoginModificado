<?php include("db.php") ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requerimientos</title>
    <!--Bootrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilos4.css">
    <link rel="stylesheet" href="./css/stilos5.css">
    <link rel="shortcut icon" href="./src/robot.ico" type="image/x-icon">
</head>
<body>
<nav class="navbar navbar-light" id="elmonge" style="background-color: #adadad;">
  <div class="container">
      <a href="HomePostor.php" class="navbar-brand">
      <img src="src/home.png" width="30" height="30" class="d-inline-block align-top" alt=""><label class="x1" style="color:#fff">PRINCIPAL</label></a>
      <a href="index.php" class="navbar-brand"><label class="x1" style="color:#fff" >SALIR</label> <img src="src/salir.png" width="30" height="30" class="d-inline-block align-top" alt=""></a>
  </div>
</nav>

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

</div>
</div>
<div class="container2">
<form action="save_task_postor.php" method="POST">
  <ul class="flex-outer">
    <li>
      <label class="lab" for="last-name">Requerimiento</label>
      <select name="Req" id="sm">
                                      <?php
                                      $conn = mysqli_connect("localhost","root","","usuario") or die ("error al conectar");
                                      $query = $conn -> query ("SELECT * FROM requerimientos");
                                      while ($valores = mysqli_fetch_array($query)) {
                                          echo '<option value="'.$valores['CODREQ'].'">'.$valores['CODREQ'].'</option>';
                                      }
                                      mysqli_close($conn);
                                      ?>
                                      </select>
    </li>
      <script type="text/javascript">
        
        // Creando el Http Rquest
        function creaObjetoAjax() {
          var obj;
          if (window.XMLHttpRequest) {
            obj = new XMLHttpRequest();
          } else { //para IE 5 y IE 6
            obj = new ActiveXObject(Microsoft.XMLHTTP);
          }
          return obj;
        }

        let IdSelect = document.getElementById("sm").value;
        let session = "&IdSelect=" + IdSelect;
        let objajx = creaObjetoAjax();
        objajx.open("POST", "Listener.php", true);
        objajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        objajx.setRequestHeader("Content-length", session.length);
        objajx.setRequestHeader("Connection", "close");
        objajx.send(session);
        objajx.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log(objajx.responseText);
            let inputNew = document.getElementById('first-name');
            let uno = parseInt(datos[0]) + 1;
            inputNew.innerHTML = uno;
          }
        };

        document.getElementById("sm").onchange = function() {
          let IdSelect = document.getElementById("sm").value;
          let session = "&IdSelect=" + IdSelect;
          let objajx = creaObjetoAjax();
          objajx.open("POST", "Listener.php", true);
          objajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          objajx.setRequestHeader("Content-length", session.length);
          objajx.setRequestHeader("Connection", "close");
          objajx.send(session);
          objajx.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              let datos = JSON.parse(this.responseText);
              console.log(datos);
              let inputNew = document.getElementById('first-name');
               let uno = parseInt(datos[0])+1;
               inputNew.innerHTML = uno;
            }
          }
        };

      </script>
    <li>
      <label class="lab" for="first-name">Número de Oferta</label>
      <label name="nro_oferta"  id="first-name"></label>
    </li>
    <li>
      <label class="lab" for="email">RucRazonSocial</label>
      <input type="number" name="RucRsocial" id="RUC" placeholder="Ingrese RUC">
    </li>
    <li>
      <label class="lab" for="phone">Número de contacto</label>
      <input type="tel"  name="Nrocel" id="phone" placeholder="Ingrese el nuemero de celular" >
    </li>
    <li>
      <label class="lab" for="message">Oferta</label>
      <input name="oferta"  type="tel" id="phone" placeholder="Ingrese aquí su oferta">
    </li>
    <li>
      <label class="lab" for="message">Correo</label>
      <input name="Correo"  type="Email" id="email" placeholder="Ingrese aquí su Email">
    </li>
    <li>

      <button type="submit"  class="btn btn-5" name="save_task_postor" >AÑADIR</button>
    </li>
  </ul>
</form>
</div>




    <?php include("includes/footer.php") ?>
