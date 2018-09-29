

<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../resources/css/estilos.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
	<script type="text/javascript" src="../resources/js/procedimientos.js"></script>
	
</head>
<style type="text/css">
	
	#sidebar {
    overflow: hidden;
    z-index: 3;
}
#sidebar .list-group {
    min-width: 400px;
    background-color: #333;
    min-height: 100vh;
}
#sidebar i {
    margin-right: 6px;
}

#sidebar .list-group-item {
    border-radius: 0;
    background-color: #333;
    color: #ccc;
    border-left: 0;
    border-right: 0;
    border-color: #2c2c2c;
    white-space: nowrap;
}

/* highlight active menu */
#sidebar .list-group-item:not(.collapsed) {
    background-color: #222;
}

/* closed state */
#sidebar .list-group .list-group-item[aria-expanded="false"]::after {
  content: " \f0d7";
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 5px;
}

/* open state */
#sidebar .list-group .list-group-item[aria-expanded="true"] {
  background-color: #222;
}
#sidebar .list-group .list-group-item[aria-expanded="true"]::after {
  content: " \f0da";
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 5px;
}

/* level 1*/
#sidebar .list-group .collapse .list-group-item,
#sidebar .list-group .collapsing .list-group-item  {
  padding-left: 20px;
}

/* level 2*/
#sidebar .list-group .collapse > .collapse .list-group-item,
#sidebar .list-group .collapse > .collapsing .list-group-item {
  padding-left: 30px;
}

/* level 3*/
#sidebar .list-group .collapse > .collapse > .collapse .list-group-item {
  padding-left: 40px;
}

@media (max-width:768px) {
    #sidebar {
        min-width: 35px;
        max-width: 40px;
        overflow-y: auto;
        overflow-x: visible;
        transition: all 0.25s ease;
        transform: translateX(-45px);
        position: fixed;
    }
    
    #sidebar.show {
        transform: translateX(0);
    }

    #sidebar::-webkit-scrollbar{ width: 0px; }
    
    #sidebar, #sidebar .list-group {
        min-width: 35px;
        overflow: visible;
    }
    /* overlay sub levels on small screens */
    #sidebar .list-group .collapse.show, #sidebar .list-group .collapsing {
        position: relative;
        z-index: 1;
        width: 190px;
        top: 0;

    }
    #sidebar .list-group > .list-group-item {
        text-align: center;
        padding: .75rem .5rem;

    }
    /* hide caret icons of top level when collapsed */
    #sidebar .list-group > .list-group-item[aria-expanded="true"]::after,
    #sidebar .list-group > .list-group-item[aria-expanded="false"]::after {
        display:none;
    }
}

.collapse.show {
  visibility: visible;
}
.collapsing {
  visibility: visible;
  height: 0;
  -webkit-transition-property: height, visibility;
  transition-property: height, visibility;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.collapsing.width {
  -webkit-transition-property: width, visibility;
  transition-property: width, visibility;
  width: 0;
  height: 100%;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
</style>

</body>
</html>
    <nav class="navbar navbar-dark  bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-2 col-md-3 mr-0 text-center" href="#">TSSeiCONSULTORES</a>
     
      <ul class="navbar-nav px-2">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="?cargar=cerrarSesion">Cerrar sesion</a>
        </li>
      </ul>
    </nav>
<div class="container-fluid">

    <div class="row d-flex d-md-block flex-nowrap wrapper" >
        <div class="col-md-3 float-left col-1 pl-0 pr-0 collapse width show" id="sidebar" >
        	 <nav class="col-md-12 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky mt-3">
            <ul class="nav flex-column">
			<img class="mx-auto d-block mb-4 mt-4"  src="../image/logo.jpg" >

              <li class="nav-item">
                <a class="nav-link" href="?cargar=usuario" >
                	<img class="mr-2" style="width: 25px;height: 25px;" src="../image/worker.png">Gestionar Usuarios
		    	</a>
              </li>
              <li class="nav-item"  >
                
		    	<a class="nav-link" href="?cargar=empresa">
		    		<img class="mr-2"  style="height: 25px;width: 25px;" src="../image/factory.png"> Gestionar Empresas	
		    	</a>
              </li>
              <li class="nav-item">
                	<a class="nav-link" href="?cargar=accion" >
		    			<img class="mr-2"  style="height: 25px;width: 25px;" src="../image/documents.png">
		    			Gestionar Acciones Recomendadas
		    		</a>
              </li>
              <li class="nav-item">
              	 <a class="nav-link" href="?cargar=plan" >
		    			<img class="mr-2"  style="height: 25px;width: 25px;" src="../image/clipboard.png">
		    			Gestionar Planes de Accion
		    		</a>
              </li>
              <li class="nav-item">
               	<a class="nav-link" href="?cargar=observacion" >
		    			<img class="mr-2"  style="height: 25px;width: 25px;" src="../image/box.png">
		    			Gestionar Observaciones
		    		</a>
              </li>
              <li class="nav-item">
              	 <a class="nav-link" href="?cargar=informes" >
		    			<img class="mr-2"  style="height: 25px;width: 25px;" src="../image/clipboard1.png">Informes
		    		</a>
              </li>
			  <li class="nav-item">    
              	<a class="nav-link" href="?cargar=graficos" class="btn">
		    			<img class="mr-2"  style="height: 25px;width: 25px;"  src="../image/analytics.png">
		    			Graficos
		    		</a>
		      </li>
              <li class="nav-item">
                	<a class="nav-link"  href="?cargar=planAccion" class="btn">
		    			<img class="mr-2"  style="height: 25px;width: 25px;" src="../image/settings.png">
		    			Plan de Acción por empresa
		    		</a>
              </li>
              <li class="nav-item mb-5">
                <a  class="nav-link"  href="?cargar=configuracionLocal" class="btn">
		    			<img class="mr-2"  style="height: 25px;width: 25px;" src="../image/settings.png">
		    			Configuración local
		    		</a>
              </li>
              
            </ul>
          </div>
        </nav>   
        </div>
        </div>
        <main class="col-md-float-left col px main" >
            <a href="#" data-target="#sidebar" data-toggle="collapse"><img class="m-2" src="../image/menu.png"></a>

           <?php
			include_once("../controlador/enrutadorAdmin.php");
			error_reporting(E_ALL ^ E_NOTICE);
			$objEnrutador=new enrutadorAdmin();
			if ($objEnrutador->validarVista($_GET['cargar'])) {
				$objEnrutador->cargarVista($_GET['cargar']);
			}
		?>
            
           
        </main>
    </div>
</div>