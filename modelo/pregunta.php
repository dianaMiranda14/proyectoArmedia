<?php
	include_once("conexion.php");

	class Pregunta{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}
		
		public function listar(){
			$consulta="select * from pregunta";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function listarPreguntasCuestionario($idCuestionario, $accion){
			$consulta="select pregunta.* from cuestionario, dominio, dimension, pregunta where
				cuestionario.id_cuestionario = ".$idCuestionario." and
				dominio.id_cuestionario_dominio = cuestionario.id_cuestionario and
				dimension.id_dominio_dimension = dominio.id_dominio and
				pregunta.id_dimension_pregunta = dimension.id_dimension order by id_pregunta asc";
			$resultado = $this->objConexion->consultaRetorno($consulta);
			if (mysqli_num_rows($resultado)>0) {
				$contador=0;
				echo '<form id="formularioPreguntas">';
				echo '<input type="hidden" name="idCuestionario" value="'.$idCuestionario.'">';
				while ($resultadoPregunta=mysqli_fetch_assoc($resultado)) {
					$opciones=split(",",$resultadoPregunta['opciones_pregunta']);
					echo '
					<tr>
						<td>'.($contador+1).'</td>
						<td>'.$resultadoPregunta['descripcion_pregunta'].'</td>
						<input type="hidden" name="txtPregunta'.$contador.'" value="'.$resultadoPregunta['id_pregunta'].'">
						<td> <input type="radio" class="radio" name="radio'.$contador.'" value="'.$opciones[0].'"> </td>
						<td> <input type="radio" class="radio" name="radio'.$contador.'" value="'.$opciones[1].'"> </td>
						<td> <input type="radio" class="radio" name="radio'.$contador.'" value="'.$opciones[2].'"> </td>
						<td> <input type="radio" class="radio" name="radio'.$contador.'" value="'.$opciones[3].'"> </td>
						<td> <input type="radio" class="radio" name="radio'.$contador.'" value="'.$opciones[4].'"> </td>
					</tr>
					';
					$contador++;
				}

				echo'
					<input type="hidden" name="accion" id="txtAccionPregunta" value="'.$accion.'">
					<input type="hidden" name="cantidad" id="txtCantidad" value="'.$contador.'">
					</form>';
			
			}
		}
	}
?>