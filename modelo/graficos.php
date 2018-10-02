<?php
	include_once("conexion.php");

	class Graficos{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function listarGraficos(){
			$consulta = "Select * from grafico";
			//echo $consulta;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarComentario($id_empresa,$fecha_comentario,$id_grafico){
			$consulta ="select * from grafico_empresa where grafico_empresa.id_empresa = ".$id_empresa." and grafico_empresa.fecha_comentario = '".$fecha_comentario."' and grafico_empresa.id_grafico = ".$id_grafico;
			return $this->objConexion->consultaRetorno($consulta);
		}


		public function registrarComentario($id_empresa,$fecha_comentario,$id_grafico,$comentario){

			$validarDato = $this->consultarComentario($id_empresa,$fecha_comentario,$id_grafico);

			if (mysqli_num_rows($validarDato)>0) {
				$insert = "UPDATE grafico_empresa SET grafico_empresa.comentario = '".$comentario."' where grafico_empresa.id_empresa = ".$id_empresa." and grafico_empresa.id_grafico = ".$id_grafico." and grafico_empresa.fecha_comentario = '".$fecha_comentario."'";
			}else{
				$insert = "INSERT into grafico_empresa (id_empresa,id_grafico,comentario,fecha_comentario) values (".$id_empresa.",".$id_grafico.",'".$comentario."','".$fecha_comentario."')";
		
			
			}
			$this->objConexion->consultaSimple($insert);
		}

}