<?php
	include_once("conexion.php");

	class Empresa{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function registrar($nit, $nombre, $ciudad, $direccion, $telefono, $contacto){
			$consulta="insert into empresa values (".$nit.", '".$nombre."', '".$ciudad."', '".$direccion."', '".$telefono."', '".$contacto."','Activo','0')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($nit, $nombre, $ciudad, $direccion, $telefono, $contacto, $habilitado, $estado){
			$consulta="update empresa set nombre_empresa = '".$nombre."', ciudad_empresa = '".$ciudad."', direccion_empresa = '".$direccion."', telefono_empresa = '".$telefono."', contacto_empresa = '".$contacto."', habilitado_empresa = '".$habilitado."', estado_empresa = '".$estado."' where nit_empresa = ".$nit;
			$this->objConexion->consultaSimple($consulta);
		}

		public function eliminar($nit){
			$consulta="delete from empresa where nit_empresa = ".$nit;
			$this->objConexion->consultaSimple($consulta);
		}

		public function listar(){
			$consulta="select * from empresa";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarNit($nit){
			$consulta="select * from empresa where nit_empresa = ".$nit;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarNombre($nombre){
			$consulta="select * from empresa where nombre_empresa like '".$nombre."%'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarCiudad($ciudad){
			$consulta="select * from empresa where ciudad_empresa like '".$ciudad."%'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarContacto($contacto){
			$consulta="select * from empresa where contacto_empresa like '".$contacto."%'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarEstado($estado){
			$consulta="select * from empresa where estado_empresa like '".$estado."'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarUsuarios($nit){
			$consulta="select usuario.* from empresa, usuario where nit_empresa = id_empresa_usuario and nit_empresa = ".$nit;
			return $this->objConexion->consultaRetorno($consulta);

		}
	}

?>