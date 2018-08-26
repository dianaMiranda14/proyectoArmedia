<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/empresa.php");

	class empresaControlador{
		private $objEmpresa;
		private $objConexion;

		public function __construct(){
			$this->objEmpresa=new Empresa();
			$this->objConexion= new Conexion();
		}

		public function registrar($nit, $nombre, $ciudad, $direccion, $telefono, $contacto, $habilitado){
			$consulta="insert into empresa values (".$nit.", '".$nombre."', '".$ciudad."', '".$direccion."', '".$telefono."', '".$contacto."', '".$habilitado."', 'activo')";
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

		public function listarNit($nit){
			$consulta="select * from empresa where nit_empresa = ".$nit;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarNombre($nombre){
			$consulta="select from empresa where nombre_empresa like '".$nombre."%'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarCiudad($ciudad){
			$consulta="select * from empresa where ciudad_empresa like '".$ciudad."%'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarContacto($contacto){
			$consulta="select * from empresa where contacto_empresa '".$contacto."%'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarEstado($estado){
			$consulta="select * from empresa where estado_empresa like '".$estado."'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarUsuarios($nit){
			$consulta="select * from empresa, usuario where nit_empresa = id_empresa_usuario and nit_empresa = ".$nit;
			return $this->objConexion->consultaRetorno($consulta);

		}
	}

?>