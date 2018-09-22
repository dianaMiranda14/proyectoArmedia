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

		public function remplazar($nit, $nombre, $ciudad, $direccion, $telefono, $contacto){
			$consulta="replace into empresa values (".$nit.", '".$nombre."', '".$ciudad."', '".$direccion."', '".$telefono."', '".$contacto."','Activo','0')";
			$this->objConexion->consultaSimple($consulta);
		}

		public function modificar($nit, $nombre, $ciudad, $direccion, $telefono, $contacto, $estado){
			$consulta="update empresa set nombre_empresa = '".$nombre."', ciudad_empresa = '".$ciudad."', direccion_empresa = '".$direccion."', telefono_empresa = '".$telefono."', contacto_empresa = '".$contacto."', estado_empresa = '".$estado."' where nit_empresa = ".$nit;
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

		public function vaciarTabla(){
			$consulta="delete from empresa";
			$this->objConexion->consultaSimple($consulta);
		}

		public function mostrar($resultado){
			if (mysqli_num_rows($resultado)>0) {
	    		while ($obj=mysqli_fetch_assoc($resultado)) {
	    			echo 
	    			'<tr>
	    				<td>'.$obj['nit_empresa'].'</td>
	    				<td>'.$obj['nombre_empresa'].'</td>
	    				<td>'.$obj['ciudad_empresa'].'</td>
	    				<td>'.$obj['direccion_empresa'].'</td>
	    				<td>'.$obj['telefono_empresa'].'</td>
	    				<td>'.$obj['contacto_empresa'].'</td>
	    				<td>'.$obj['estado_empresa'].'</td>
	    				<td><img src="../image/exchange.png" onclick=\'modalEmpresa("modificar",'.json_encode($obj).')\' > </td>
	    				<td> <img src="../image/x.png" onclick=\'modalEmpresa("eliminar",'.json_encode($obj).')\'></td>
	    			</tr>';


	    			/*$mostrar.='
	    				<td>'.$habilitado.'</td>
	    				<td> <input type="button" class="btn btn-primary" onclick=\'modalEmpresa("modificar",'.json_encode($obj).')\' value="Modificar"></td>
	    				<td> <input type="button" class="btn btn-primary" onclick=\'modalEmpresa("eliminar",'.json_encode($obj).')\' value="Eliminar"></td>

	    				<img src="../image/x.png" >
	    				<img src="../image/exchange.png" >


	    			</tr>';*/
	    		}
	    	}else{
	    		echo '
	    		<tr>
	    			<td colspan="9">No hay registros</td>
	    		</tr>';
	    	}
		}

		public function mostrarOption(){		
			$resultado=$this->consultarEstado("Activo");
			while ($obj=mysqli_fetch_assoc($resultado)) {
			    echo '<option value="'.$obj['nit_empresa'].'">'.$obj['nombre_empresa'].'</option>';
			}
		}

		public function mostrarOptionYear($idEmpresa){
			$consulta="select distinct YEAR(presentacion.fecha_presentacion) as 'year' from presentacion, usuario, empresa where 
				presentacion.id_usuario_presentacion = usuario.cedula_usuario and 
				usuario.id_empresa_usuario = empresa.nit_empresa and 
				empresa.nit_empresa = ".$idEmpresa;
			$resultado= $this->objConexion->consultaRetorno($consulta);
			echo "<option value=''>Seleccione</option>";
			if (mysqli_num_rows($resultado)>0) {
				while ($obj=mysqli_fetch_assoc($resultado)) {
				    echo '<option>'.$obj['year'].'</option>';
				}
			}
		}

		public function arrEmpresa($id){
			if ($id==0) {
				$result=$this->listar();
			}else{
				$result=$this->consultarNit($id);
			}
			if (mysqli_num_rows($result)) {
				while ($obj=mysqli_fetch_assoc($result)) {
					$arrEmpresa[0]=array('nit_empresa'=>$obj['nit_empresa'], 'nombre_empresa'=>$obj['nombre_empresa'], 'ciudad_empresa'=>$obj['ciudad_empresa'], 'direccion_empresa'=>$obj['direccion_empresa'], 'telefono_empresa'=>$obj['telefono_empresa'], 'contacto_empresa'=>$obj['contacto_empresa'], 'estado_empresa'=>$obj['estado_empresa'], 'habilitado_empresa'=>$obj['habilitado_empresa']);
				}
				return $arrEmpresa;
			}
		}
	}

?>