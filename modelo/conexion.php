<?php
	class Conexion{

		private $host="localhost";
		private $user="root";
		private $pass="root";
		private $bd="psicosocialbd";
		private $con;

		public function __construct(){
			$this->con=mysqli_connect($this->host,$this->user,$this->pass,$this->bd);
			if (mysqli_errno($this->con)) {
				echo "Fallo conexion a la bd";
			}else{
				//echo "Exito";
			}
		}

		public function consultaRetorno($consulta){
			mysql_set_charset('utf8');
			return mysqli_query($this->con, $consulta);
		}

		public function consultaSimple($consulta){

			mysqli_query($this->con, $consulta);
		}
	}
	//$obj = new Conexion();
?>