<!DOCTYPE html>
<html lang="es">
  <head>
		<!-- Bootstrap -->
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>

	</head>
	<body>

            <div class="modal-header">
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-user"></span>
                  &nbsp; Nuevo cliente
               </h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
               	<label class="col-sm-2 control-label text-capitalize">Nombre</label>
                  <div class="col-sm-10">
                     <input type="text" name="nombre" class="form-control" id="nombre" autocomplete="off" required="" placeholder="NOMBRE">
                  </div>
               </div>

			<div class="form-group">
					
					 	               	<label class="col-sm-2 control-label text-capitalize">RUC</label>
 						<div class="col-sm-10">
                     <input class="form-control" type="text" id="ruc" name="ruc" value="" maxlength="30" autocomplete="off" placeholder="">
						<span class="input-group-btn">
                              <button class="btn btn-primary hidden-sm" type="submit" onclick="busqueda(); return false">
                                 <span class="glyphicon glyphicon-search"></span>
                              </button>
                           </span>
                     </div>
			</div>

               
               
               
               
               
               
               <div class="form-group">
                  <label class="col-sm-2 control-label text-capitalize">provincia</label>
                  <div class="col-sm-10">
                     
                     <input type="text" name="provincia" value="" id="ac_provincia" class="form-control" autocomplete="off">
                     
                  </div>
               </div>
               
               
               <div class="form-group">
                  <label class="col-sm-2 control-label">Ciudad</label>
                  <div class="col-sm-10">
                     
                     <input type="text" name="ciudad" value="" class="form-control">
                     
                  </div>
               </div>
               
               
               <div class="form-group">
                  <label class="col-sm-2 control-label">Cód. Postal</label>
                  <div class="col-sm-10">
                     
                     <input type="text" name="codpostal" class="form-control" maxlength="10" autocomplete="off">
                     
                  </div>
               </div>
               
               
               <div class="form-group">
                  <label class="col-sm-2 control-label">Dirección</label>
                  <div class="col-sm-10">
                     
                     <input type="text" name="direccion" id="direccion" class="form-control" autocomplete="off" required="">
                     
                  </div>
               </div>
                              <div class="form-group">
                  <label class="col-sm-2 control-label">tipo</label>
                  <div class="col-sm-10">
                     
                     <input type="text" name="tipo" id="tipo" class="form-control" autocomplete="off" required="">
                     
                  </div>
               </div>
            </div>

            <div class="modal-footer">
               <button class="btn btn-sm btn-primary pull-left" type="submit" onclick="busqueda(); return false">
                  <span class="glyphicon glyphicon-search"></span>&nbsp; Buscar
               </button>
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </div>



			
			
			<footer class="footer text-center">
				<div class="col">
					<p><small>&copy; </small></p>
				</div>
			</footer>
		</div>

		   <script type="text/javascript">

   (function($){
   $.ajaxblock    = function(){
      $("body").prepend("<div id='ajax-overlay'><div id='ajax-overlay-body' class='center'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i><span class='sr-only'>Loading...</span></div></div>");
      $("#ajax-overlay").css({
         position: 'absolute',
         color: '#FFFFFF',
         top: '0',
         left: '0',
         width: '100%',
         height: '100%',
         position: 'fixed',
         background: 'rgba(39, 38, 46, 0.67)',
         'text-align': 'center',
         'z-index': '9999'
      });
      $("#ajax-overlay-body").css({
         position: 'absolute',
         top: '40%',
         left: '50%',
         width: '120px',
         height: '48px',
         'margin-top': '-12px',
         'margin-left': '-60px',
         //background: 'rgba(39, 38, 46, 0.1)',
         '-webkit-border-radius':   '10px',
         '-moz-border-radius':      '10px',
         'border-radius':        '10px'
      });
      $("#ajax-overlay").fadeIn(50);
   };
   $.ajaxunblock  = function(){
      $("#ajax-overlay").fadeOut(100, function()
      {
         $("#ajax-overlay").remove();
      });
   };
})(jQuery);
		function busqueda(){
               //$this.button('loading');
               $.ajaxblock();
               $.ajax({
                  data: { "nruc" : $("#ruc").val() },
                  type: "POST",
                  dataType: "json",
                  url: "sunat/consulta.php",
               }).done(function( data, textStatus, jqXHR ){
                  if(data['success']!="false" && data['success']!=false)
                  {
                     $("#json_code").text(JSON.stringify(data, null, '\t'));

                     var res = JSON.stringify(data['result']['RUC']);
                    // alert(data['result']['RUC']);
                              //console.log(JSON.stringify(respuesta));
                     $('#direccion').val(data['result']['Direccion']);
                     $('#nombre').val(data['result']['RazonSocial']);
                     $('#tipo').val(data['result']['Tipo']);
                     if(typeof(data['result'])!='undefined')
                     {

                        //$("#tbody").html("");
                        $.each(data['result'], function(i, v)
                        {
                           //$("#tbody").append('<tr><td>'+i+'<\/td><td>'+v+'<\/td><\/tr>');
                           
                        });
                     }

                     $.ajaxunblock();
                  }else{
                     if(typeof(data['msg'])!='undefined')
                     {
                        alert(data['msg']);
                        $('#direccion').val('');
                        $('#tipo').val('');
                        $('#nombre').val('');
                     }
                     //$this.button('reset');
                     $.ajaxunblock();
                  }
               }).fail(function( jqXHR, textStatus, errorThrown ){
                  alert( "Solicitud fallida:" + textStatus );
                  $.ajaxunblock();
               });
   }


</script>
	</body>
</html>

