<?php
	include_once("conexion.php");
	header('Content-Type: text/html; charset=UTF-8'); 
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	class Pregunta{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
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

		public function preguntasDimension($idCuestionario,$idDimension){
			$consulta="select pregunta.* from cuestionario, dominio, dimension, pregunta where
				cuestionario.id_cuestionario = ".$idCuestionario." and
				dominio.id_cuestionario_dominio = cuestionario.id_cuestionario and
				dimension.id_dominio_dimension = dominio.id_dominio and 
				dimension.id_dimension = ".$idDimension." and 
				pregunta.id_dimension_pregunta = dimension.id_dimension order by id_pregunta asc ";
				//echo $consulta;
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
			$this->mostrarPreguntasCuestionario($pag,0);
		}

		//aqui es donde muestra la cantidad de preguntas segun la variable pag
		public function mostrarPreguntasCuestionario($pag,$idDimension){
			if ($idDimension==0) {
				$resultado=$this->preguntasCuestionario($_SESSION['infoPreguntas']['idCuestionario'], $pag);
			}else{
				$resultado=$this->preguntasDimension($_SESSION['infoPreguntas']['idCuestionario'], $idDimension);
			}
			if (mysqli_num_rows($resultado)>0) {
				echo '<input type="hidden" id="txtInicio" value="'.$pag.'" name="txtInicio">';
				$contador=$pag;
				$aux=0;
				$modal="";
				while ($resultadoPregunta=mysqli_fetch_assoc($resultado)) {
					if ($idDimension==0&&$modal=="") {
						if ($resultadoPregunta['id_dimension_pregunta']==13 || $resultadoPregunta['id_dimension_pregunta']==29) {
							$modal="En mi trabajo debo brindar atención a clientes o usuarios";
							$id=$resultadoPregunta['id_dimension_pregunta'];
						}else if($resultadoPregunta['id_dimension_pregunta']==4){
							$modal="Soy jefe de otras personas en mi trabajo";
							$id=$resultadoPregunta['id_dimension_pregunta'];
						}
					}
					if($modal=="") {
						//explode sustituye split porque ya no lo soporta
						$opciones=explode(",",$resultadoPregunta['opciones_pregunta']);
						echo utf8_encode('
						<tr id="tr'.$contador.'">
							<td>'.($contador+1).'</td>
							<td>'.$resultadoPregunta['descripcion_pregunta'].'</td>
							<input type="hidden" id="txtPregunta" name="txtPregunta'.$contador.'" value="'.$resultadoPregunta['id_pregunta'].'">
							');
						for ($i=0; $i < count($opciones); $i++) { 
							//valida si ya se registro una respuesta a la pregunta y si es asi marca la opcion seleccionada
							if (isset($_SESSION['infoPreguntas']['radio'][$contador])&&
								$_SESSION['infoPreguntas']['radio'][$contador]==$opciones[$i]) {
									echo '<td> <input type="radio" class="radio" name="radio'.$contador.'" value="'.$opciones[$i].'" checked="true"> </td>';
							}else{
								echo '<td> <input type="radio" class="radio" name="radio'.$contador.'" value="'.$opciones[$i].'"> </td>';
							}
							
						}
						echo '</tr>';
						$contador++;
					}
					
				}
				if ($contador==$pag) {
					echo "<input type='hidden' id='txtSiguiente' value='modal'>
					<input type='hidden' id='txtAnterior' value='false'>";
					echo "<input type='hidden' id='txtModal' value='".$modal."&".$id."&".$pag."'>";
				}else{
					if ($pag!=0) {
							echo '<input type="hidden" value="'.($pag-10).'" id="txtAnterior">';
					}else{
						echo '<input type="hidden" value="false" id="txtAnterior">';
					}
					//valida si la paginacion ya es mayor a la cantidad de preguntas				
					if ($contador==$_SESSION['infoPreguntas']['cantidad']) {
						echo '<input type="hidden" value="0" id="txtSiguiente">
						<input type="hidden" id="txtAnterior" value="false">
						<input type="hidden" value="'.($pag).'" name="txtCantidad">';
					}else{
						echo '<input type="hidden" value="'.($contador).'" id="txtSiguiente">';
					}
				}		
			}else{
				echo '<input type="hidden" value="0" id="txtSiguiente">
				<input type="hidden" id="txtAnterior" value="false">
				<input type="hidden" value="'.($pag).'" name="txtCantidad">';
			}
		}

	}
?>