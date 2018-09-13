<?php
	include_once("conexion.php");

	class Pregunta{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
			session_start();
		}
		
		public function listar(){
			$consulta="select * from pregunta";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function preguntasCuestionario($idCuestionario, $accion, $pag){
			$consulta="select pregunta.* from cuestionario, dominio, dimension, pregunta where
				cuestionario.id_cuestionario = ".$idCuestionario." and
				dominio.id_cuestionario_dominio = cuestionario.id_cuestionario and
				dimension.id_dominio_dimension = dominio.id_dominio and
				pregunta.id_dimension_pregunta = dimension.id_dimension order by id_pregunta asc limit 10 offset ".$pag;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function cantidadPreguntasCuestionario($idCuestionario, $accion, $pag){
			$consulta="select count(id_pregunta) as 'cantidad' from cuestionario, dominio, dimension, pregunta where
				cuestionario.id_cuestionario = ".$idCuestionario." and
				dominio.id_cuestionario_dominio = cuestionario.id_cuestionario and
				dimension.id_dominio_dimension = dominio.id_dominio and
				pregunta.id_dimension_pregunta = dimension.id_dimension order by id_pregunta asc limit 10 offset ".$pag;
			return $this->objConexion->consultaRetorno($consulta);
		}

		//esta funcion se supone que la debe de llamar la primer vez que va a 
		//cargar un formulario porque guarda la informacion de consulta
		public function mostrarInicioCuestionario($idCuestionario, $accion, $pag){
			$resultado=$this->preguntasCuestionario($idCuestionario, $accion, $pag);
			$_SESSION['infoPreguntas']['cantidad']=mysqli_fetch_assoc($this->cantidadPreguntasCuestionario($idCuestionario, $accion, $pag));
			$_SESSION['infoPreguntas']['idCuestionario']=$idCuestionario;
			$_SESSION['infoPreguntas']['accion']=$accion;
			$this->mostrarPreguntasCuestionario($pag);
		}

		//aqui es donde muestra la cantidad de preguntas segun la variable pag
		public function mostrarPreguntasCuestionario($pag){
			$resultado=$this->preguntasCuestionario($_SESSION['infoPreguntas']['idCuestionario'], $_SESSION['infoPreguntas']['accion'], $pag);
			if (mysqli_num_rows($resultado)>0) {
				$contador=$pag;
				echo '<form id="formularioCuestionario">';
				while ($resultadoPregunta=mysqli_fetch_assoc($resultado)) {
					$opciones=split(",",$resultadoPregunta['opciones_pregunta']);
					echo '
					<tr id="tr'.$contador.'">
						<td>'.($contador+1).'</td>
						<td>'.$resultadoPregunta['descripcion_pregunta'].'</td>
						<input type="hidden" id="txtPregunta" name="txtPregunta'.$contador.'" value="'.$resultadoPregunta['id_pregunta'].'">
						';
					for ($i=0; $i < count($opciones); $i++) { 
						echo '<td> <input type="radio" class="radio" name="radio'.$contador.'" value="'.$opciones[$i].'"> </td>';
					}
					echo '</tr>';
					$contador++;
				}
				echo "</from>";
				/*if ($pag!==0) {
					echo '<input type="button" class="btn" value="Anterior" onclick="paginacion('.($pag-10).') " style="display:none;">';
				}
				if ($pag<$_SESSION['infoPreguntas']['cantidad']) {
					echo '<input type="button" class="btn" value="Siguiente" onclick="paginacion('.($pag+10).')" >';
				}else{
					echo '<input type="button" class="btn" value="Registrar" onclick="preguntas()">';
				}*/
				
			}
		}
	}
?>