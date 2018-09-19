<?php
	include_once("conexion.php");
	header('Content-Type: text/html; charset=UTF-8'); 

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

		public function preguntasCuestionario($idCuestionario,$pag){
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
		public function mostrarInicioCuestionario($idCuestionario, $accion,$pag){
			//guarda la cantidad de preguntas que tiene el cuestionario
			$_SESSION['infoPreguntas']= mysqli_fetch_assoc($this->cantidadPreguntasCuestionario($idCuestionario, $accion, $pag));
			$_SESSION['infoPreguntas']['idCuestionario']=$idCuestionario;
			$_SESSION['infoPreguntas']['accion']=$accion;
			$this->mostrarPreguntasCuestionario($pag);
		}

		//aqui es donde muestra la cantidad de preguntas segun la variable pag
		public function mostrarPreguntasCuestionario($pag){
			$resultado=$this->preguntasCuestionario($_SESSION['infoPreguntas']['idCuestionario'], $pag);
			if (mysqli_num_rows($resultado)>0) {
				$contador=$pag;
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
				if ($contador!==0) {
					echo '<input type="hidden" value="'.($contador-10).'" id="txtAnterior">';
				}else{
					echo '<input type="hidden" value="0" id="txtAnterior">';
				}
				//valida si la paginacion ya es mayor a la cantidad de preguntas				
				if ($contador==$_SESSION['infoPreguntas']['cantidad']) {
					echo '<input type="hidden" value="0" id="txtSiguiente">';
					echo '<input type="hidden" value="'.($pag).'" name="txtCantidad">';
				}else{
					echo '<input type="hidden" value="'.($contador).'" id="txtSiguiente">';
				}
				
			}
		}
	}
?>