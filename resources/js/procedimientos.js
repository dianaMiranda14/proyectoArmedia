var myObj;

function validarLogin(){
	var validacion;
	$.ajax({
		data:$("#formularioLogin").serialize(),
		type:"post",
		url:"../controlador/usuarioControlador.php",
		success:function(res){
			if (res==0) {
				document.getElementById("mensajes").className="alert alert-success";
				document.getElementById("mensajes").style.display="inline";
				document.getElementById("mensajes").innerHTML="Login exitoso";
				document.getElementById("validacion").value="true";
				location.href="inicio.php?cargar=usuario";
				return true;
			}else{
				document.getElementById("mensajes").className="alert alert-danger";			
				document.getElementById("mensajes").style.display="inline";
				document.getElementById("mensajes").innerHTML=res;
				document.getElementById("validacion").value="false";
				return false;
			}
		}
	});
}

function modalEmpresa(accion,objEmpresa){
	document.getElementById("formularioEmpresa").reset();
	document.getElementById("mensajesEmpresa").style.display="none";
	document.getElementById("accionEmpresa").value=accion;
	document.getElementById("tituloModalEmpresa").innerHTML=accion.toUpperCase();
	if (objEmpresa==null) {
		document.getElementById("txtNit").readOnly=false;
		document.getElementById("adicional").style.display="none";
	}else{
		//document.getElementById("accionEmpresa").value="modificar";
		document.getElementById("txtNit").value=objEmpresa['nit_empresa'];
		document.getElementById("txtNit").readOnly=true;
		document.getElementById("txtNombre").value=objEmpresa['nombre_empresa'];
		document.getElementById("comboCiudad").value=objEmpresa['ciudad_empresa'];
		document.getElementById("txtDireccion").value=objEmpresa['direccion_empresa'];
		document.getElementById("txtTelefono").value=objEmpresa['telefono_empresa'];
		document.getElementById("txtContacto").value=objEmpresa['contacto_empresa'];
		document.getElementById("comboEstado").value=objEmpresa['estado_empresa'];
		document.getElementById("txtNit").value=objEmpresa['nit_empresa'];
		document.getElementById("adicional").style.display="grid";
	}
	$('#modalEmpresa').modal('show');
}

function filtrarEmpresa(accion, valor){
	$.ajax({
			data:'accion='+accion+"&valor="+valor,
			type:"post",
			url:"../controlador/empresaControlador.php",
			success:function(res){
				document.getElementById("cuerpoTablaEmpresa").innerHTML=res;
			}
	});
}

function actualizarTablaEmpresa(){
	$.ajax({
			data:'accion=listar',
			type:"post",
			url:"../controlador/empresaControlador.php",
			success:function(res){
				document.getElementById("cuerpoTablaEmpresa").innerHTML=res;
			}
	});
}

function validarModalEmpresa(){
	var mensaje="";
	if (document.getElementById("txtNit").value=="") {
		mensaje="El nit es obligatorio";
	}else if (document.getElementById("txtNombre").value=="") {
		mensaje="El nombre es obligatorio";
	}else if (document.getElementById("comboCiudad").value=="") {
		mensaje="La ciudad es obligatoria";
	}else if (document.getElementById("txtDireccion").value=="") {
		mensaje="La dirección es obligatoria";
	}else if (document.getElementById("txtTelefono").value=="") {
		mensaje="El telefono es obligatorio";
	}else if (document.getElementById("txtContacto").value=="") {
		mensaje="El contacto es obligatorio";
	}else{
		$.ajax({
			data:$("#formularioEmpresa").serialize(),
			type:"post",
			url:"../controlador/empresaControlador.php",
			success:function(res){
				if (res==0) {
					document.getElementById("mensajesEmpresa").className="alert alert-success";
					document.getElementById("mensajesEmpresa").style.display="block";
					document.getElementById("mensajesEmpresa").innerHTML="acción de "+
						document.getElementById("accionEmpresa").value+" exitosa";		
					setTimeout("$('#modalEmpresa').modal('hide')",2000);
					actualizarTablaEmpresa();
				}else{
					document.getElementById("mensajesEmpresa").className="alert alert-danger";
					document.getElementById("mensajesEmpresa").style.display="block";
					document.getElementById("mensajesEmpresa").innerHTML=res;
					return false;
				}
			}
		});
	}
	if (mensaje!=="") {
		document.getElementById("mensajesEmpresa").className="alert alert-danger";
		document.getElementById("mensajesEmpresa").style.display="block";
		document.getElementById("mensajesEmpresa").innerHTML=mensaje;
	}
}

function modalUsuario(accion, objUsuario){
	document.getElementById("formularioUsuario").reset();
	document.getElementById("mensajesUsuario").style.display="none";
	document.getElementById("accionUsuario").value=accion;
	document.getElementById("tituloModalUsuario").innerHTML=accion.toUpperCase();
	if (objUsuario==null) {
		document.getElementById("colEstadoUsuario").style.display="none";
	}else{
		document.getElementById("colEstadoUsuario").style.display="grid";
		document.getElementById("txtCedula").value=objUsuario['cedula_usuario'];
		document.getElementById("txtId").value=objUsuario['cedula_usuario'];
		document.getElementById("txtNombre").value=objUsuario['nombre_usuario'];
		document.getElementById("comboSexo").value=objUsuario['sexo_usuario'];
		document.getElementById("comboEstadoCivil").value=objUsuario['estado_civil_usuario'];
		document.getElementById("txtFechaNacimiento").value=objUsuario['fecha_nacimiento_usuario'];
		document.getElementById("txtPersonasDependen").value=objUsuario['personas_dependen_usuario'];
		document.getElementById("comboDepartamentoResidencia").value=objUsuario['departamento_residencia_usuario'];
		document.getElementById("comboCiudadResidencia").value=objUsuario['ciudad_residencia_usuario'];
		document.getElementById("comboTipoVivienda").value=objUsuario['tipo_vivienda_usuario'];
		document.getElementById("comboEstrato").value=objUsuario['estrato_usuario'];
		document.getElementById("comboNivelEstudio").value=objUsuario['nivel_estudio_usuario'];
		document.getElementById("txtProfesion").value=objUsuario['profesion_usuario'];
		document.getElementById("comboDepartamentoTrabajo").value=objUsuario['departamento_trabajo_usuario'];
		document.getElementById("comboCiudadTrabajo").value=objUsuario['ciudad_trabajo_usuario'];
		document.getElementById("comboEmpresa").value=objUsuario['id_empresa_usuario'];
		document.getElementById("txtDepartamentoLaboral").value=objUsuario['departamento_laboral_usuario']; 	
		document.getElementById("txtYearsTrabajo").value=objUsuario['years_trabajo_usuario'];
		document.getElementById("comboTipoCargo").value=objUsuario['tipo_cargo_usuario'];
		document.getElementById("txtCargo").value=objUsuario['cargo_usuario'];
		document.getElementById("txtYearsCargo").value=objUsuario['years_cargo_usuario'];
		document.getElementById("txtHorasTrabajo").value=objUsuario['horas_dia_trabajo_usuario'];
		document.getElementById("comboTipoContrato").value=objUsuario['tipo_contrato_usuario'];
		document.getElementById("comboTipoSalario").value=objUsuario['tipo_salario_usuario'];
		document.getElementById("comboEstado").value=objUsuario['estado_usuario'];
	}
	$("#modalUsuario").modal("show");
}

function filtrarUsuario(accion, valor){
	$.ajax({
			data:'accion='+accion+"&valor="+valor,
			type:"post",
			url:"../controlador/usuarioControlador.php",
			success:function(res){
				document.getElementById("cuerpoTablaUsuario").innerHTML=res;
			}
	});
}

function actualizarTablaUsuario(){
	$.ajax({
			data:'accion=listar',
			type:"post",
			url:"../controlador/usuarioControlador.php",
			success:function(res){
				document.getElementById("cuerpoTablaUsuario").innerHTML=res;
			}
	});
}

function validarUsuario(){
	var mensaje="";
	if (document.getElementById("txtCedula").value=="") {
		mensaje="La cedula es obligatoria";
	}else if (document.getElementById("txtNombre").value=="") {
		mensaje="El nombre es obligatorio";
	}else if (document.getElementById("comboSexo").value=="") {
		mensaje="El sexo es obligatorio";
	}else if (document.getElementById("comboEstadoCivil").value=="") {
		mensaje="El estado civil es obligatorio";
	}else if (document.getElementById("txtFechaNacimiento").value=="") {
		mensaje="La fecha de nacimiento es obligatoria";
	}else if (document.getElementById("txtPersonasDependen").value=="") {
		mensaje="La cantidad ee personas que dependen economicamente de usted es obligatoria";
	}else if (document.getElementById("comboDepartamentoResidencia").value=="") {
		mensaje="El departamento de residencia es obligatorio";
	}else if (document.getElementById("comboCiudadResidencia").value=="") {
		mensaje="La ciudad de residencia es obligatoria";
	}else if (document.getElementById("comboTipoVivienda").value=="") {
		mensaje="El tipo de vivienda es obligatorio";
	}else if (document.getElementById("comboEstrato").value=="") {
		mensaje="El estrato es obligatorio";
	}else if (document.getElementById("comboNivelEstudio").value=="") {
		mensaje="El ultimo nivel de estudio es obligatorio";
	}else if (document.getElementById("txtProfesion").value=="") {
		mensaje="La profesión es obligatoria";
	}else if (document.getElementById("comboDepartamentoTrabajo").value=="") {
		mensaje="El departamento de trabajo es obligatorio";
	}else if (document.getElementById("comboCiudadTrabajo").value=="") {
		mensaje="La ciudad de trabajo es obligatoria";
	}else if (document.getElementById("comboEmpresa").value=="") {
		mensaje="La empresa es obligatoria";
	}else if (document.getElementById("txtDepartamentoLaboral").value=="") {
		mensaje="El departamento laboral es obligatorio";
	}else if (document.getElementById("txtYearsTrabajo").value=="") {
		mensaje="La cantidad de años de trabajo en la empresa es obligatoria";
	}else if (document.getElementById("comboTipoCargo").value=="") {
		mensaje="El tipo de cargo es obligatorio";
	}else if (document.getElementById("txtCargo").value=="") {
		mensaje="El cargo es obligatorio";
	}else if (document.getElementById("txtYearsCargo").value=="") {
		mensaje="La cantidad de años en el cargo es obligatorio";
	}else if (document.getElementById("txtHorasTrabajo").value=="") {
		mensaje="La cantidad de horas de trabajo diarias es obligatoria";
	}else if (document.getElementById("comboTipoContrato").value=="") {
		mensaje="El tipo de contrato es obligatorio";
	}else if (document.getElementById("comboTipoSalario").value=="") {
		mensaje="El tipo de salario es obligatorio";
	}else{
		mensaje=true;
	}
	return mensaje;
}

function validarModalUsuario(){
	var mensaje = validarUsuario();
	if (mensaje===true) {
		$.ajax({
			data:$("#formularioUsuario").serialize(),
			type:"post",
			url:"../controlador/usuarioControlador.php",
			success:function(res){
				if (res==0) {
					document.getElementById("mensajesUsuario").className="alert alert-success";
					document.getElementById("mensajesUsuario").style.display="block";
					document.getElementById("mensajesUsuario").innerHTML="acción de "+
						document.getElementById("accionUsuario").value+" exitosa";		
					setTimeout("$('#modalUsuario').modal('hide')",2000);
					actualizarTablaUsuario();
				}else{
					document.getElementById("mensajesUsuario").className="alert alert-danger";
					document.getElementById("mensajesUsuario").style.display="block";
					document.getElementById("mensajesUsuario").innerHTML=res;
					return false;
				}
			}
		});
	}else {
		document.getElementById("mensajesUsuario").className="alert alert-danger";
		document.getElementById("mensajesUsuario").innerHTML=mensaje;
		document.getElementById("mensajesUsuario").style.display="block";
	}
}

function modalAccion(accion, objAccion){
	document.getElementById("formularioAccion").reset();
	document.getElementById("mensajesAccion").style.display="none";
	document.getElementById("accionRecomendada").value=accion;
	document.getElementById("tituloModalAccion").innerHTML=accion.toUpperCase();
	if (objAccion==null) {
		document.getElementById("adicionalAccion").style.display="none";
	}else{
		document.getElementById("adicionalAccion").style.display="grid";
		document.getElementById("txtId").value=objAccion['id_accion_recomendada'];
		document.getElementById("comboDimension").value=objAccion['id_dimension_accion_recomendada'];
		document.getElementById("txtDescripcion").value=objAccion['descripcion_accion_recomendada'];
		document.getElementById("comboEstado").value=objAccion['estado_accion_recomendada'];
	}
	$("#modalAccion").modal("show");
}

function filtrarAccion(accion, valor){
	$.ajax({
		data:"accion="+accion+"&valor="+valor,
		type:"post",
		url:"../controlador/accion_recomendadaControlador.php",
		success:function(res){
			document.getElementById("cuerpoTablaAccion").innerHTML=res;
		}
	});
}

function actualizarTablaAccion(){
	$.ajax({
		data:"accion=listar",
		type:"post",
		url:"../controlador/accion_recomendadaControlador.php",
		success:function(res){
			document.getElementById("cuerpoTablaAccion").innerHTML=res;
		}
	});
}

function validarModalAccion(){
	var mensaje="";
	if (document.getElementById("comboDimension").value=="") {
		mensaje="La dimensión es obligatoria";
	}else if (document.getElementById("txtDescripcion").value=="") {
		mensaje="La descripción es obligatoria";
	}else{
		$.ajax({
			data:$("#formularioAccion").serialize(),
			type:"post",
			url:"../controlador/accion_recomendadaControlador.php",
			success:function(res){
				if (res==0) {
					document.getElementById("mensajesAccion").className="alert alert-success";
					document.getElementById("mensajesAccion").style.display="block";
					document.getElementById("mensajesAccion").innerHTML="acción de "+
						document.getElementById("accionRecomendada").value+" exitosa";		
					setTimeout("$('#modalAccion').modal('hide')",2000);
					actualizarTablaAccion();
				}else{
					document.getElementById("mensajesAccion").className="alert alert-danger";
					document.getElementById("mensajesAccion").style.display="block";
					document.getElementById("mensajesAccion").innerHTML=res;
				}
			}
		});
	}
	if (mensaje!=="") {
		document.getElementById("mensajesAccion").className="alert alert-danger";
		document.getElementById("mensajesAccion").style.display="block";
		document.getElementById("mensajesAccion").innerHTML=mensaje;
	}
}

function modalPlan(accion, objPlan){
	document.getElementById("formularioPlan").reset();
	document.getElementById("mensajesPlan").style.display="none";
	document.getElementById("accionPlan").value=accion;
	document.getElementById("tituloModalPlan").innerHTML=accion.toUpperCase();
	if (objPlan==null) {
		document.getElementById("adicionalPlan").style.display="none";
	}else{
		document.getElementById("adicionalPlan").style.display="grid";
		document.getElementById("txtId").value=objPlan['id_plan_accion'];
		document.getElementById("comboDimension").value=objPlan['id_dimension_plan_accion'];
		document.getElementById("txtDescripcion").value=objPlan['descripcion_plan_accion'];
		document.getElementById("comboEstado").value=objPlan['estado_plan_accion'];
	}
	$("#modalPlan").modal("show");
}

function actualizarTablaPlan(){
	$.ajax({
		data:"accion=listar",
		type:"post",
		url:"../controlador/plan_accionControlador.php",
		success:function(res){
			document.getElementById("cuerpoTablaPlan").innerHTML=res;
		}
	});
}

function filtrarPlan(accion, valor){
	$.ajax({
		data:"accion="+accion+"&valor="+valor,
		type:"post",
		url:"../controlador/plan_accionControlador.php",
		success:function(res){
			document.getElementById("cuerpoTablaPlan").innerHTML=res;
		}
	});
}

function validarModalPlan(){
	var mensaje="";
	if (document.getElementById("comboDimension").value=="") {
		mensaje="La dimensión es obligatoria";
	}else if (document.getElementById("txtDescripcion").value=="") {
		mensaje="La descripción es obligatoria";
	}else{
		$.ajax({
			data:$("#formularioPlan").serialize(),
			type:"post",
			url:"../controlador/plan_accionControlador.php",
			success:function(res){
				if (res==0) {
					document.getElementById("mensajesPlan").className="alert alert-success";
					document.getElementById("mensajesPlan").style.display="block";
					document.getElementById("mensajesPlan").innerHTML="acción de "+
						document.getElementById("accionPlan").value+" exitosa";		
					setTimeout("$('#modalPlan').modal('hide')",2000);
					actualizarTablaPlan();
				}else{
					document.getElementById("mensajesPlan").className="alert alert-danger";
					document.getElementById("mensajesPlan").style.display="block";
					document.getElementById("mensajesPlan").innerHTML=res;
				}
			}
		});
	}
	if (mensaje!=="") {
		document.getElementById("mensajesPlan").className="alert alert-danger";
		document.getElementById("mensajesPlan").style.display="block";
		document.getElementById("mensajesPlan").innerHTML=mensaje;
	}
}

function validarContenidoCuestionario(valor){
	var caccion="";
	var select=document.getElementById("comboCuestionario");
	$("#comboCuestionario > option").remove();
	var option=document.createElement("option");
	option.value="";
	option.text="Seleccione"
	select.appendChild(option);
	if (valor=="Dimension") {
		accion="listarSinEstres";
	}else{
		accion="listarOption";
	}
	$.ajax({
		data:"accion="+accion,
		type:"post",
		url:"../controlador/cuestionarioControlador.php",
		success:function(res){
			$('#comboCuestionario').append(res);		
		}
	});
}

function actualizarContenido(valor){
	var select=document.getElementById("comboContenido");
	$("#comboContenido > option").remove();
	var option=document.createElement("option");
	option.value="";
	option.text="Seleccione";
	select.appendChild(option);
	tipo=document.getElementById("comboTipo").value;
	if (tipo=="Dimension") {
		$.ajax({
			data:"accion=mostrarContenido&idCuestionario="+valor,
			type:"post",
			url:"../controlador/dimensionControlador.php",
			success:function(res){
				$('#comboContenido').append(res);
				
			}
		});
	}else if(tipo=="Riesgo"){
		var option=document.createElement("option");
		option.text="Riesgo muy bajo";
		select.appendChild(option);
		option=document.createElement("option");
		option.text="Riesgo bajo";
		select.appendChild(option);
		option=document.createElement("option");
		option.text="Riesgo medio";
		select.appendChild(option);
		option=document.createElement("option");
		option.text="Riesgo alto";
		select.appendChild(option);
		option=document.createElement("option");
		option.text="Riesgo muy alto";
		select.appendChild(option);
	}
}

function modalObservacion(accion, objObservacion){
	document.getElementById("formularioObservacion").reset();
	document.getElementById("accionObservacion").value=accion;
	document.getElementById("tituloModalObservacion").innerHTML=accion.toUpperCase();
	document.getElementById("mensajesObservacion").style.display="none";
	if (objObservacion==null) {
		document.getElementById("adicionalObservacion").style.display="none";
	}else{
		validarContenidoCuestionario(objObservacion['tipo_observacion']);
		actualizarContenido(objObservacion['id_cuestionario_observacion']);
		document.getElementById("adicionalObservacion").style.display="grid";
		document.getElementById("txtId").value=objObservacion['id_observacion'];
		document.getElementById("comboTipo").value=objObservacion['tipo_observacion'];
		document.getElementById("comboCuestionario").value=objObservacion['id_cuestionario_observacion'];
		document.getElementById("comboContenido").value=objObservacion['contenido_observacion'];
		document.getElementById("txtDescripcion").value=objObservacion['descripcion_observacion'];
		document.getElementById("comboEstado").value=objObservacion['estado_observacion'];
	}
	$("#modalObservacion").modal("show");
}

function actualizarTablaObservacion(){
	$.ajax({
		data:"accion=listar",
		type:"post",
		url:"../controlador/observacionControlador.php",
		success:function(res){
			document.getElementById("cuerpoTablaObservacion").innerHTML=res;
				
		}
	});
}

function filtrarObservacion(accion, valor){
	$.ajax({
		data:"accion="+accion+"&valor="+valor,
		type:"post",
		url:"../controlador/observacionControlador.php",
		success:function(res){
			document.getElementById("cuerpoTablaObservacion").innerHTML=res;
				
		}
	});
}

function validarModalObservacion(){
	var mensaje="";
	if (document.getElementById("comboCuestionario").value=="") {
		mensaje="El cuestionario es obligatorio";
	}else if (document.getElementById("comboTipo").value=="") {
		mensaje="El tipo de observación es obligatorio";		
	}else if (document.getElementById("comboContenido").value=="") {
		mensaje="El contenido es obligatorio";
	}else if (document.getElementById("txtDescripcion").value=="") {
		mensaje="La descripción es obligatoria";
	}else {
		$.ajax({
			data:$("#formularioObservacion").serialize(),
			type:"post",
			url:"../controlador/observacionControlador.php",
			success:function(res){
				if (res==0) {
					document.getElementById("mensajesObservacion").className="alert alert-success";
					document.getElementById("mensajesObservacion").style.display="block";
					document.getElementById("mensajesObservacion").innerHTML="acción de "+
						document.getElementById("accionObservacion").value+" exitosa";		
					setTimeout("$('#modalObservacion').modal('hide')",2000);
					actualizarTablaObservacion();
				}else{
					document.getElementById("mensajesObservacion").className="alert alert-danger";
					document.getElementById("mensajesObservacion").style.display="block";
					document.getElementById("mensajesObservacion").innerHTML=res;
				}	
			}
		});
	}
	if (mensaje!=="") {
		document.getElementById("mensajesObservacion").className="alert alert-danger";
		document.getElementById("mensajesObservacion").style.display="block";
		document.getElementById("mensajesObservacion").innerHTML=mensaje;
	}
}

function config(formulario){
	$.ajax({
		data:$(formulario).serialize(),
		type:"post",
		url:"../controlador/usuarioControlador.php",
		success:function(res){
			console.log(res);	
		}
	});
}

function validarExistenciaUsuario(valor){
	$.ajax({
		data:"accion=consultarUsuario&valor="+valor,
		type:"post",
		url:"controlador/usuarioControlador.php",
		success:function(res){
			var datos = JSON.parse(res);
			document.getElementById("txtCedula").readOnly=true;
			document.getElementById("txtNombre").value=datos.nombre_usuario;
			document.getElementById("txtNombre").readOnly=true;
			document.getElementById("comboEmpresa").value=datos.id_empresa_usuario;
			//document.getElementById("comboEmpresa").disabled=true;
		}
	});
 }

 function modificarUsuario(){
 	var mensaje = validarUsuario();
 	if (mensaje===true) {
 		$.ajax({
			data:$("#formularioUsuario").serialize(),
			type:"post",
			url:"controlador/usuarioControlador.php",
			success:function(res){
				if (res==0) {
					document.getElementById("mensajesUsuario").className="alert alert-success";
					document.getElementById("mensajesUsuario").style.display="block";
					document.getElementById("mensajesUsuario").innerHTML="Información Actualizada Exitosamente";
					setTimeout('location.href ="?cargar=cuestionario"',2000);
				}else{
					document.getElementById("mensajesUsuario").className="alert alert-danger";
					document.getElementById("mensajesUsuario").style.display="block";
					document.getElementById("mensajesUsuario").innerHTML=res;
				}
			}
		});
 	}else{
 		document.getElementById("mensajesUsuario").className="alert alert-danger";
		document.getElementById("mensajesUsuario").innerHTML=mensaje;
		document.getElementById("mensajesUsuario").style.display="block";
 	}
 }

//funcion para validar que elija una opcion de una pregunta
function validarRadio(fin){
	//recorre todas las preguntas
	for(var i=(document.getElementById("txtInicio").value); i< fin; i++){
		var radio=document.getElementsByName("radio"+i);
		var validacion=false;
		//recorre las opciones de cada pregunta
		for(var j=0; j < radio.length; j++){
			if (radio[j].checked==true) {
				validacion=true;
			}
		}
		//si no ha seleccionado ninguna opcion retorna el numero de la pregunta
		if (validacion===false) {
			return i;
		}
	}
	return true;
}

//pinta la fila de la pregunta que no se ha seleccionado
function colorTr(id, fin){
	for (var i = (document.getElementById("txtInicio").value); i < fin; i++) {
		if (i==id) {
			document.getElementById("tr"+i).style.background="red";
		}else{
			document.getElementById("tr"+i).style.background="000";
		}
	}
}

function paginacionAnterior(pag){
	$.ajax({
		data:"pag="+pag+"&accion=paginacionAnterior",
		type:"post",
		url:"controlador/preguntaControlador.php",
		success:function(res){
			document.getElementById("cuerpoTablaCuestionario").innerHTML=res;
			validarMostrarBotones();
		}
	});
}

function paginacion(pag){
	//valida si todas las preguntas tiene una opcion elejida
	resultado=validarRadio(pag);
	if (resultado===true) {

		$.ajax({
			data:$("#formularioCuestionario").serialize()+"&pag="+pag+"&accion=paginacion",
			type:"post",
			url:"controlador/preguntaControlador.php",
			success:function(res){
				document.getElementById("cuerpoTablaCuestionario").innerHTML=res;
				validarMostrarBotones();
			}
		});
	}else{
		//muestra un dialog con la informacion
		document.getElementById("botones").style.display="none";
		document.getElementById("tituloModalPreguntas").innerHTML="Error";
		document.getElementById("cuerpoModalPregunta").innerHTML="Falta la pregunta número "+(resultado+1)+" por responder";
		$('#modalMensjesPreguntas').modal('show');
		setTimeout("$('#modalMensjesPreguntas').modal('hide')",2000);
		colorTr(resultado,pag);
	}
}

function mostrar(descripcion, idDimension, pag){
	$.ajax({
		data:"accion=mostrar&descripcion="+descripcion+"&idDimension="+idDimension+"&pag="+pag,
		type:"post",
		url:"controlador/preguntaControlador.php",
		success:function(res){
			document.getElementById("cuerpoTablaCuestionario").innerHTML=res;
			validarMostrarBotones();
			$('#modalMensjesPreguntas').modal('hide');
		}
	});
}

function validarMostrarBotones(){
	if(document.getElementById("txtSiguiente").value=="modal"){
		document.getElementById("pagAnterior").style.display="none";
		document.getElementById("tituloModalPreguntas").innerHTML="Información";
		var datos=document.getElementById("txtModal").value.split("&");
		document.getElementById("cuerpoModalPregunta").innerHTML=datos[0];
		document.getElementById("pagSiguiente").setAttribute('onclick',
			"$('#modalMensjesPreguntas').modal('show')");
		document.getElementById("botones").style.display="grid";
		document.getElementById("btnSi").setAttribute('onclick',
			"mostrar('si',"+datos[1]+","+datos[2]+")");
		document.getElementById("btnNo").setAttribute('onclick',
			"mostrar('no',"+datos[1]+","+datos[2]+")");
	}else if (document.getElementById("txtSiguiente").value!=="0") {
		document.getElementById("pagSiguiente").style.display="block";
		document.getElementById("pagSiguiente").setAttribute('onclick',"paginacion("+
			document.getElementById("txtSiguiente").value+")");

		document.getElementById("btnRegistrar").style.display="none";
	}else{
		document.getElementById("pagSiguiente").style.display="none";
		document.getElementById("btnRegistrar").style.display="block";
	}
	if (document.getElementById("txtAnterior").value!=="false") {
		document.getElementById("pagAnterior").style.display="block";
		document.getElementById("pagAnterior").setAttribute("onclick","paginacionAnterior("+
			document.getElementById("txtAnterior").value+");");
	}else{
		document.getElementById("pagAnterior").style.display="none";
	}
}

//aqui era donde mandaba todas las respuestas cuando no tenia la paginacion, este se llama en el boton de registrar 
function preguntas(){
 	$.ajax({
	//	data:$("#formularioPreguntas").serialize()+"&accion=registrar",
	data:$("#formularioCuestionario").serialize(),
		type:"post",
		url:"controlador/respuestaControlador.php",
		success:function(res){
			//location.reload(true);
			document.getElementById("cuerpoTablaCuestionario").innerHTML=res;
			validarMostrarBotones();
		}
	});
 }

 function validarTipoInforme(valor){
 	if (valor=="0") {
 		document.getElementById("divCedula").style.display="grid";
 	}else{
 		document.getElementById("divCedula").style.display="none";
 	}
 }

 function mostrarYear(valor){
 	$("#comboYear > option").remove();
	$.ajax({
		data:"accion=mostrarOptionYear&idEmpresa="+valor,
		type:"post",
		url:"../controlador/EmpresaControlador.php",
		success:function(res){
			$('#comboYear').append(res);		
		}
	});
 }

 function mostrarDatos(valor){
 	mostrarYear(valor);
 	if (document.getElementById("comboTipoInforme").value=="0") {
 		mostrarUsuarios(valor);
 	}
 }

 function mostrarUsuarios(valor){
 	if (valor!=="0") {
		$("#listEmpleados > option").remove();
		$.ajax({
			data:"accion=mostrarOption&idEmpresa="+valor,
			type:"post",
			url:"../controlador/UsuarioControlador.php",
			success:function(res){
				$('#listEmpleados').append(res);		
			}
		});
 	}
 }

function descargarInforme(){
	var mensaje="";
	if (document.getElementById("comboTipoInforme").value=="") {
		mensaje="El tipo de informe es obligatorio";
	}else if (document.getElementById("comboEmpresa").value=="") {
		mensaje="La empresa es obligatoria";
	}else if(document.getElementById("comboYear").value==""){
		mensaje="El año es obligatorio";
	}else if (document.getElementById("comboTipoInforme").value=="0" && 
		document.getElementById("txtCedula").value=="") {
		mensaje="La cédula del empleado es obligatoria";
	}else{
		$.ajax({
			async: false,
			data:$("#formularioInforme").serialize()+"&accion=validarCedula",
			type:"post",
			url:"../controlador/usuarioControlador.php",
			success:function(res){
				if (res=="true") {
					document.getElementById("mensajesInforme").style.display="none";
					return true;
				}else{
					mensaje=res;
				}
			}
		});
	}
	if (mensaje!=="") {
		document.getElementById("mensajesInforme").className="alert alert-danger";
		document.getElementById("mensajesInforme").innerHTML=mensaje;
		document.getElementById("mensajesInforme").style.display="block";
		return false;	
	}
}

function validarPlanAccion(){
	var mensaje="";
	if (document.getElementById("comboEmpresa").value=="") {
		mensaje="La empresa es obligatoria";
	}else if (document.getElementById("comboYear").value=="") {
		mensaje="El año es obligatorio";
	}else{
		actualizatTablaPlanEmpresa();
	}
	if (mensaje!="") {
		document.getElementById("mensajesPlanAccion").className="alert alert-danger";
		document.getElementById("mensajesPlanAccion").innerHTML=mensaje;
		document.getElementById("mensajesPlanAccion").style.display="block";
	}
}

function modalPlanAccion(objD){
	document.getElementById("mensajesModalPlanAccion").style.display="none";
	document.getElementById("formularioModalPlanAccion").reset();
	document.getElementById("descipcionDimesion").innerHTML=objD["descripcion_dimension"];
	document.getElementById("definicionDimension").innerHTML=objD["definicion_dimension"];
	document.getElementById("indicadorDimension").innerHTML=objD["indicador_dimension"];
	document.getElementById("idDimension").value=objD["id_dimension"];
	document.getElementById("accionModal").value=objD["accion"];

	$.ajax({
		async:false,
		data:"accion=mostrarOption&idDimension="+objD["id_dimension"],
		type:"post",
		url:"../controlador/plan_accionControlador.php",
		success:function(res){
			document.getElementById("listaPlan").innerHTML=res;		
		}
	});
	$.ajax({
		async:false,
		data:"accion=mostrarOption&idDimension="+objD["id_dimension"],
		type:"post",
		url:"../controlador/accion_recomendadaControlador.php",
		success:function(res){
			document.getElementById("listaAccion").innerHTML=res;		
		}
	});

	if (objD["accion"]=="modificar") {
		document.getElementById("nivelRiesgoDimension").innerHTML=objD["plan"]["valor_dimension_plan_accion_empresa"];
		document.getElementById("valorDimension").value=objD["plan"]["valor_dimension_plan_accion_empresa"];
		document.getElementById("idEmpresa").value=objD["plan"]["id_empresa_plan_accion_empresa"];
		document.getElementById("year").value=objD["plan"]["year_plan_accion_empresa"];

		for(var i=0;i< objD["plan"]["idAcciones"].length; i++){
			document.getElementById("opcionAccion-"+objD["plan"]["idAcciones"][i]).className=
				"list-group-item list-group-item-action active";
			document.getElementById("idAccion").value+=objD["plan"]["idAcciones"][i]+",";
		}
		for(var i=0;i< objD["plan"]["idPlanes"].length; i++){
			document.getElementById("opcionPlan-"+objD["plan"]["idPlanes"][i]).className=
				"list-group-item list-group-item-action active";
			document.getElementById("idPlan").value+=objD["plan"]["idPlanes"][i]+",";
		}
		document.getElementById("comboArea").value=objD["plan"]["area_plan_accion_empresa"];
		document.getElementById("comboResponsable").value=objD["plan"]["responsable_plan_accion_empresa"];
		document.getElementById("id").value=objD["plan"]["id_plan_accion_empresa"];
	}else{
		document.getElementById("nivelRiesgoDimension").innerHTML=objD["porcentaje"];
		document.getElementById("idEmpresa").value=objD["idEmpresa"];
		document.getElementById("year").value=objD["year"];
		document.getElementById("valorDimension").value=objD["porcentaje"];
	}
	$("#modalPlanAccion").modal("show");
}

function marcarSeleccionPlan(id){
	var clases=document.getElementById("opcionPlan-"+id).className;
	if (clases=="list-group-item list-group-item-action active") {
		document.getElementById("opcionPlan-"+id).className="list-group-item";
		var datos=document.getElementById("idPlan").value.split(",");
		var indice = datos.indexOf(id.toString());
		datos.splice(indice,1);
		document.getElementById("idPlan").value="";
		for(var i=0; i<(datos.length-1); i++){
			document.getElementById("idPlan").value+=datos[i]+",";
		}
	}else{
		document.getElementById("opcionPlan-"+id).className="list-group-item list-group-item-action active";
		document.getElementById("idPlan").value+=document.getElementById("opcionPlan-"+id).id.split("-")[1]+",";
	}
}

function marcarSeleccionAccion(id){
	var clases=document.getElementById("opcionAccion-"+id).className;
	if (clases=="list-group-item list-group-item-action active") {
		document.getElementById("opcionAccion-"+id).className="list-group-item";
		var datos=document.getElementById("idAccion").value.split(",");
		var indice = datos.indexOf(id.toString());
		datos.splice(indice,1);
		document.getElementById("idAccion").value="";
		for(var i=0; i<(datos.length-1); i++){
			document.getElementById("idAccion").value+=datos[i]+",";
		}
	}else{
		document.getElementById("opcionAccion-"+id).className="list-group-item list-group-item-action active";
		document.getElementById("idAccion").value+=document.getElementById("opcionAccion-"+id).id.split("-")[1]+",";
	}
}

function actualizatTablaPlanEmpresa() {
	$.ajax({
		data: $("#formularioPlanAccion").serialize(),
		type:"post",
		url:"../controlador/plan_accion_empresaControlador.php",
		success:function(res){
			document.getElementById("tablaPlanAccion").innerHTML=res;
		}
	});
}

function validarModalPlanAccion(){
	var mensaje="";
	if (document.getElementById("comboArea").value=="") {
		mensaje="El área es obligatoria";
	}else if (document.getElementById("comboResponsable").value=="") {
		mensaje="El responsable es obligatorio";
	}else if (document.getElementById("idPlan").value=="") {
		mensaje="Debe elegir al menos un plan de acción";
	}else if (document.getElementById("idAccion").value=="") {
		mensaje="Debe elegir al menos una acción recomendada";
	}
		
	if (mensaje!="") {
		document.getElementById("mensajesModalPlanAccion").className="alert alert-danger";
		document.getElementById("mensajesModalPlanAccion").innerHTML=mensaje;
		document.getElementById("mensajesModalPlanAccion").style.display="block";
	}else{
		$.ajax({
			data:$("#formularioModalPlanAccion").serialize(),
			type:"post",
			url:"../controlador/plan_accion_empresaControlador.php",
			success:function(res){
				if (res=="0") {
					document.getElementById("mensajesModalPlanAccion").className="alert alert-success";
					document.getElementById("mensajesModalPlanAccion").innerHTML="Registro Exitoso";
					document.getElementById("mensajesModalPlanAccion").style.display="block";
					setTimeout("$('#modalPlanAccion').modal('hide')",1500);
					actualizatTablaPlanEmpresa();
				}else{
					document.getElementById("mensajesModalPlanAccion").className="alert alert-danger";
					document.getElementById("mensajesModalPlanAccion").innerHTML=res;
					document.getElementById("mensajesModalPlanAccion").style.display="block";
				}
			}
		});
	}
}

function mostarGrafico() {
	var myObj = new Array();
	var tittle = document.getElementById('cmbnombreGrafico').value;
	//var valu =  document.getElementById('cmbnombreGrafico').value;
	 var options ={
          chart: {
              renderTo: 'container',
              type: 'pie',

        },
          title: {
            text: tittle
        },
          yAxis: {
            title: {
                text: 'Fruits Amount'
            }
        },
           series: [{
           }]
        };

		$.ajax({
			data: $("#frmGraficos").serialize(),
			type:"post",
			url:"../controlador/graficosControlador.php",
			success:function(res){
				console.log(res);
				myObj = JSON.parse(res);
				options.series[0].data = myObj;
				var chart = new Highcharts.Chart(options);
			}
		});
consultarComentario();

}


function consultarComentario(){
		document.getElementById('accionComentario').value = '1';
		$.ajax({
			data: $("#frmGraficos").serialize(),
			type:"post",
			url:"../controlador/controladorComentario.php",
			success:function(res){
			
					console.log(res);
					document.getElementById('contenedorComentario').style.display = "block";
					document.getElementById('textComentario').innerHTML = res;
				
				
			}
		});
}

function registrarComentario(){
	document.getElementById('accionComentario').value = '2';
	
	$.ajax({
			data: $("#frmGraficos").serialize(),
			type:"post",
			url:"../controlador/controladorComentario.php",
			success:function(res){
				
				//	console.log(res);
					

				
			}
		});
}



/*function generarDiagramas(){
  // Our ajax data renderer which here retrieves a text file.
  // it could contact any source and pull data, however.
  // The options argument isn't used in this renderer.
    var ret = null;
    $.ajax({
      // have to use synchronous here, else the function 
      // will return before the data is fetched
      async: false,
      url: "../controlador/graficosControlador.php",
      dataType:"json",
      success: function(data) {
      	  var plot2 = $.jqplot('chart2', jsonurl,{
			    title: "AJAX JSON Data Renderer",
			    dataRenderer: ajaxDataRenderer,
			    dataRendererOptions: {
			      unusedOptionalUrl: jsonurl
			    }
			  });
			});
      }
    });
    //return ret;

}

  // The url for our json data
  var jsonurl = "./jsondata.txt";
 
  // passing in the url string as the jqPlot data argument is a handy
  // shortcut for our renderer.  You could also have used the
  // "dataRendererOptions" option to pass in the url.
*/