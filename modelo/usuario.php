<?php
	include_once("conexion.php");

	class Usuario{
		private $objConexion;

		public function __construct(){
			$this->objConexion=new Conexion();
		}

		public function registrar($cedula, $idEmpresa, $nombre, $sexo, $estadoCivil, $fechaNacimiento, $personasDepende, $departamentoResidencia, $ciudadResidencia, $estrato, $tipoVivienda, $nivelEstudio, $profesion, $departamentoTrabajo, $ciudadTrabajo, $yearsTrabajo, $cargo, $tipoCargo, $yearsCargo, $departamentoLaboral, $tipoContrato, $horasTrabajo, $tipoSalario){

			$consulta="insert into usuario (cedula_usuario, id_empresa_usuario, nombre_usuario, sexo_usuario, estado_civil_usuario, fecha_nacimiento_usuario, personas_dependen_usuario, departamento_residencia_usuario, ciudad_residencia_usuario, estrato_usuario, tipo_vivienda_usuario, nivel_estudio_usuario, profesion_usuario, departamento_trabajo_usuario, ciudad_trabajo_usuario, years_trabajo_usuario, cargo_usuario, tipo_cargo_usuario, years_cargo_usuario, departamento_laboral_usuario, tipo_contrato_usuario, horas_dia_trabajo_usuario, tipo_salario_usuario, tipo_usuario, estado_usuario) values(".$cedula.",".$idEmpresa.",'".$nombre."','".$sexo."','".$estadoCivil."','".$fechaNacimiento."',".$personasDepende.",'".$departamentoResidencia."','".$ciudadResidencia."','".$estrato."','".$tipoVivienda."','".$nivelEstudio."','".$profesion."','".$departamentoTrabajo."','".$ciudadTrabajo."',".$yearsTrabajo.",'".$cargo."','".$tipoCargo."',".$yearsCargo.",'".$departamentoLaboral."','".$tipoContrato."',".$horasTrabajo.",'".$tipoSalario."','Usuario','Activo')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function remplazar($cedula, $idEmpresa, $nombre, $sexo, $estadoCivil, $fechaNacimiento, $personasDepende, $departamentoResidencia, $ciudadResidencia, $estrato, $tipoVivienda, $nivelEstudio, $profesion, $departamentoTrabajo, $ciudadTrabajo, $yearsTrabajo, $cargo, $tipoCargo, $yearsCargo, $departamentoLaboral, $tipoContrato, $horasTrabajo, $tipoSalario){

			$consulta="replace into usuario (cedula_usuario, id_empresa_usuario, nombre_usuario, sexo_usuario, estado_civil_usuario, fecha_nacimiento_usuario, personas_dependen_usuario, departamento_residencia_usuario, ciudad_residencia_usuario, estrato_usuario, tipo_vivienda_usuario, nivel_estudio_usuario, profesion_usuario, departamento_trabajo_usuario, ciudad_trabajo_usuario, years_trabajo_usuario, cargo_usuario, tipo_cargo_usuario, years_cargo_usuario, departamento_laboral_usuario, tipo_contrato_usuario, horas_dia_trabajo_usuario, tipo_salario_usuario, tipo_usuario, estado_usuario) values(".$cedula.",".$idEmpresa.",'".$nombre."','".$sexo."','".$estadoCivil."','".$fechaNacimiento."',".$personasDepende.",'".$departamentoResidencia."','".$ciudadResidencia."','".$estrato."','".$tipoVivienda."','".$nivelEstudio."','".$profesion."','".$departamentoTrabajo."','".$ciudadTrabajo."',".$yearsTrabajo.",'".$cargo."','".$tipoCargo."',".$yearsCargo.",'".$departamentoLaboral."','".$tipoContrato."',".$horasTrabajo.",'".$tipoSalario."','Usuario','Activo')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($id,$cedula, $idEmpresa, $nombre, $sexo, $estadoCivil, $fechaNacimiento, $personasDepende, $departamentoResidencia, $ciudadResidencia, $estrato, $tipoVivienda, $nivelEstudio, $profesion, $departamentoTrabajo, $ciudadTrabajo, $yearsTrabajo, $cargo, $tipoCargo, $yearsCargo, $departamentoLaboral, $tipoContrato, $horasTrabajo, $tipoSalario, $estado){

			$consulta="update usuario set cedula_usuario =".$cedula.", id_empresa_usuario = ".$idEmpresa.", nombre_usuario = '".$nombre."', sexo_usuario = '".$sexo."', estado_civil_usuario = '".$estadoCivil."', fecha_nacimiento_usuario = '".$fechaNacimiento."', personas_dependen_usuario = ".$personasDepende.", departamento_residencia_usuario = '".$departamentoResidencia."', ciudad_residencia_usuario = '".$ciudadResidencia."', estrato_usuario = '".$estrato."', tipo_vivienda_usuario = '".$tipoVivienda."', nivel_estudio_usuario = '".$nivelEstudio."', profesion_usuario = '".$profesion."', departamento_trabajo_usuario = '".$departamentoTrabajo."', ciudad_trabajo_usuario = '".$ciudadTrabajo."', years_trabajo_usuario = ".$yearsTrabajo.", cargo_usuario = '".$cargo."', tipo_cargo_usuario = '".$tipoCargo."', years_cargo_usuario = ".$yearsCargo.", departamento_laboral_usuario = '".$departamentoLaboral."', tipo_contrato_usuario = '".$tipoContrato."', horas_dia_trabajo_usuario = ".$horasTrabajo.", tipo_salario_usuario = '".$tipoSalario."', estado_usuario = '".$estado."' where cedula_usuario = ".$id;
			$this->objConexion->consultaSimple($consulta);		
		}

		public function listar(){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarCedula($cedula){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where cedula_usuario = ".$cedula." and tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarUsuarioPresentacion($cedula, $idCuestionario, $year){
			$consulta="select usuario.*, nombre_empresa, fecha_presentacion, nombre_cuestionario from usuario, empresa, presentacion, cuestionario where 
				usuario.id_empresa_usuario = empresa.nit_empresa and 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				cuestionario.id_cuestionario = presentacion.id_cuestionario_presentacion and 
				presentacion.id_cuestionario_presentacion = ".$idCuestionario." and 
				year(presentacion.fecha_presentacion) = ".$year." and 
				usuario.cedula_usuario = ".$cedula;
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarEvaluador(){
			$consulta="select usuario.* from usuario where tipo_usuario like 'Evaluador'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarCedulaEstado($cedula){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where cedula_usuario = ".$cedula." and tipo_usuario like 'Usuario' and empresa.nit_empresa = usuario.id_empresa_usuario and estado_usuario like 'Activo'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarNombre($nombre){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where nombre_usuario like '".$nombre."%' and tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarEmpresa($idEmpresa){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where id_empresa_usuario = ".$idEmpresa." and tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarEstado($estado){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where estado_usuario = '".$estado."' and tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarLogin($correo, $pass){
			$consulta="select * from usuario where correo_usuario like '".$correo."' and password_usuario like '".$pass."' and tipo_usuario like 'admin'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function consultarUsuariosEmpresaEstado($estado, $idEmpresa){
			$consulta="select usuario.*,nombre_empresa from usuario, empresa where id_empresa_usuario = ".$idEmpresa." and tipo_usuario like 'usuario' and empresa.nit_empresa = usuario.id_empresa_usuario and estado_usuario like '".$estado."'";
			return $this->objConexion->consultaRetorno($consulta);
		}

		public function vaciarTabla(){
			$consulta="delete from usuario where tipo_usuario like 'Usuario'";
			$this->objConexion->consultaSimple($consulta);
		}

		public function mostrar($resultado){
			if (mysqli_num_rows($resultado)>0) {
					while ($obj=mysqli_fetch_assoc($resultado)) {
						echo
						'<tr>
							<td>'.$obj['cedula_usuario'].'</td>
							<td>'.$obj['nombre_usuario'].'</td>
							<td>'.$obj['sexo_usuario'].'</td>
							<td>'.$obj['fecha_nacimiento_usuario'].'</td>
							<td>'.$obj['profesion_usuario'].'</td>
							<td>'.$obj['nombre_empresa'].'</td>
							<td>'.$obj['cargo_usuario'].'</td>
							<td>'.$obj['estado_usuario'].'</td>
							<td> <input type="button" class="btn btn-primary" value="Modificar" onclick=\'modalUsuario("modificar",'.json_encode($obj).')\' /></td>
						</tr>';
					}
			}else{
				echo 
		    		'<tr>
		    			<td colspan="9">No hay registros</td>
		    		</tr>';
			}
		}


		//lo llamo cuando voy a exportar los datos
		public function arrUsuarios($id){
			if ($id==0) {
				$resultado=$this->listar();
			}else{
				$resultado=$this->consultarEmpresa($id);
			}
			
			if (mysqli_num_rows($resultado)>0) {
				$i=0;
				while ($obj = mysqli_fetch_assoc($resultado)) {
					//guarda toda la informacion del usuario en una posicion del array
					$arrUsuarios[$i]= array('cedula_usuario' => $obj['cedula_usuario'], 'nombre_usuario'=>$obj['nombre_usuario'],'id_empresa_usuario'=>$obj['id_empresa_usuario'], 'sexo_usuario'=>$obj['sexo_usuario'], 'estado_civil_usuario'=>$obj['estado_civil_usuario'], 'fecha_nacimiento_usuario'=>$obj['fecha_nacimiento_usuario'], 'personas_dependen_usuario'=>$obj['personas_dependen_usuario'], 'departamento_residencia_usuario'=>$obj['departamento_residencia_usuario'], 'ciudad_residencia_usuario'=>$obj['ciudad_residencia_usuario'], 'estrato_usuario'=>$obj['estrato_usuario'], 'tipo_vivienda_usuario'=>$obj['tipo_vivienda_usuario'],'nivel_estudio_usuario'=>$obj['nivel_estudio_usuario'], 'profesion_usuario'=>$obj['profesion_usuario'], 'departamento_trabajo_usuario'=>$obj['departamento_trabajo_usuario'], 'ciudad_trabajo_usuario'=>$obj['ciudad_trabajo_usuario'], 'years_trabajo_usuario'=>$obj['years_trabajo_usuario'], 'cargo_usuario'=>$obj['cargo_usuario'], 'tipo_cargo_usuario'=>$obj['tipo_cargo_usuario'], 'years_cargo_usuario'=>$obj['years_cargo_usuario'], 'departamento_laboral_usuario'=>$obj['departamento_laboral_usuario'], 'tipo_contrato_usuario'=>$obj['tipo_contrato_usuario'], 'horas_dia_trabajo_usuario'=>$obj['horas_dia_trabajo_usuario'], 'tipo_salario_usuario'=>$obj['tipo_salario_usuario'], 'tipo_usuario'=>$obj['tipo_usuario'], 'estado_usuario'=>$obj['estado_usuario']);
					$i++;
				}
				return $arrUsuarios;
			}
		}

		public function mostrarOption($idEmpresa){
			$resultado=$this->consultarUsuariosEmpresaEstado("Activo",$idEmpresa);
			if (mysqli_num_rows($resultado)>0) {
				while ($objU=mysqli_fetch_assoc($resultado)) {
					echo '<option value="'.$objU['cedula_usuario'].'">'.$objU['nombre_usuario'].'</option>';
				}
			}
		}

	}

?>