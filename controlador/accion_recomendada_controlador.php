<?php
	include_once("../modelo/accion_recomendada.php");

	class AccionRecomendadaControlador{
		private $objAccionRecomendada;

		public function __construct(){
			$this->objAccionRecomendada=new AccionRecomendada();
		}

		public function registrar($idDimension, $descripcion){
			if($idDimension===""){
				echo "La dimension "
			}
		}
		
		
	}

?>