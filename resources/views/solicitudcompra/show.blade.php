@extends('layouts.app')
@section('content')  


@section('x_content')

    <div class="x_panel">
	    <div class="x_title">
			<h2>Información de la Solicitud de Compras</h2> 
			<a  href="{{ url('/solicitudcompra/'.$solicitudcompra->id.'/edit') }}" class="btn btn-info right" role="button">Editar</a>
			<a  href="{{ url('/solicitudcompra') }}" class="btn btn-default  right" role="button"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp&nbsp&nbspVolver al listado </a>
	
			<div class="clearfix"></div>
	    </div>
		<form class="form-horizontal" role="form"">
			<input type="hidden" name="_method" value="PUT">
			<div class="x_content">
				{{ csrf_field() }}
				<div id="rqspanel">
					<input type="hidden" class="form-control" id="totalrqs" name="totalrqs" value="0" />
				</div>
					<ul class="list-unstyled timeline">
						<li>
							<div class="block">
								<div class="tags">
								<a href="" class="tag">
									<span>Paso 1</span>
								</a>
								</div>
								<div class="block_content">
									<h4>Espacio exclusivo para el Asistente de Gestión Administrativa</h4><br/><br/>
										
									<div class="row ">
										<div class="form-group"><br>
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="asn_scp">Asunto</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="asn_scp"name="asn_scp"  value="{{$solicitudcompra->asn_scp}}"  disabled style="background:rgba(247, 247, 247, 0.57);" required="required" class="form-control col-md-7 col-xs-12">
												@if ($errors->has('asn_scp'))
													<span class="help-block">
														<strong>{{ $errors->first('asn_scp') }}</strong>
													</span>
												@endif
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="obv_scp">Observación	</label>																			
											<div class="col-md-6 col-sm-6 col-xs-12">
											<textarea type="text" id="obv_scp"  name="obv_scp"rows="5" required="required" disabled style="background:rgba(247, 247, 247, 0.57);" class="form-control col-md-7 col-xs-12">{{$solicitudcompra->obv_scp}}</textarea>
												@if ($errors->has('obv_scp'))
													<span class="help-block">
														<strong>{{ $errors->first('obv_scp') }}</strong>
													</span>
												@endif
											</div><br>
										</div>
									</div>
								</div>
							</div>
						</li>
						
						<li>
							<div class="block">
								<div class="tags">
									<a href="" class="tag">
										<span>Paso 2</span>
									</a>
								</div>
								<div class="block_content"><br/>
									<h2 class="title">
										<a>Lista de Productos</a><br/>
									</h2>
								<br />
								<div class="panel panel-default">
									<div class="panel-heading text-center">
									<span><strong><span class="glyphicon glyphicon-th-list"> </span> Productos</strong></span>
										
									</div>
									<div class="table-responsive">
										<table class="table table-bordered table-hover" id="education_fields2">
											<thead>
												<tr >
													<th>#</th>
													<th>Producto</th>
													<th>Unidad</th>
													<th>Cantidad</th>
													<th> Disponible</th>
													<th><a></a></th>
									
												</tr>
											</thead>
											@foreach($solicitudcompra->productossolicitudcompra as $prodsolcompra)
												<tbody class="form-group tr">
												@if($loop->last)
													<script>
														var producto = {{$loop->index + 1}};
													</script>
													<input type="hidden" class="form-control" id="cantproductos" name="cantproductos" value="{{$loop->index + 1}}"/>
													<input type="hidden" class="form-control" id="cantproductosinicial" name="cantproductosinicial" value="{{$loop->index + 1}}"/>
												@endif
												<tr>
													<td>
														{{$loop->index + 1}}
														
													</td>
								
													<td class="nopadding" >
														<div class="form-group">
															<select id="producto{{$loop->index + 1}}" class="form-control" name="producto{{$loop->index + 1}}" onchange="cambio_productos(1);" disabled style="background:rgba(247, 247, 247, 0.57);">
																	@if(!$productos->isEmpty())
																		<option value="" selected>Seleccionar</option>
																		@foreach($productos as $producto)
																			<option value="{{$producto->id}}" @if($producto->id == $prodsolcompra->prod_id) selected @endif>{{ $producto->des_prd}} </option>
																		@endforeach
																	@endif
																</select>
															
														</div>
													</td>
													<td class="nopadding" >
														<div class="form-group">
															<select class="form-control" id="unidad{{$loop->index + 1}}" name="unidad{{$loop->index + 1}}" disabled style="background:rgba(247, 247, 247, 0.57);">
																<option value="" selected>Seleccionar</option>
																@foreach($prodsolcompra->producto->unidades as $und)
																	<option name="" value="{{$und->id}}" @if($und->id == $prodsolcompra->unidad_solicitada->id)selected="selected"@endif>{{$und->des_und}}</option>
																@endforeach
															</select>
														</div>
													</td>
													<td class="nopadding" >
														<div class="form-group">
															<input type="text" class="form-control" id="cantidad{{$loop->index + 1}}" name="cantidad{{$loop->index + 1}}" value="{{$prodsolcompra->cant_sol_prd}}" placeholder="Cantidad" disabled style="background:rgba(247, 247, 247, 0.57);">
														</div>
													</td>
													<td>
														@if($prodsolcompra->producto->almacen)
															<input type="text" class="form-control" id="disponible{{$loop->index + 1}}" name="disponible{{$loop->index + 1}}" value="{{$prodsolcompra->producto->almacen->cnt_prd}} {{$prodsolcompra->almacen->und}}" disabled style="background:rgba(247, 247, 247, 0.57);" />
														@else
															<input type="text" class="form-control" id="disponible{{$loop->index + 1}}" name="disponible{{$loop->index + 1}}" value="0 {{$prodsolcompra->producto->unidad->des_und}}" disabled style="background:rgba(247, 247, 247, 0.57);" />
														@endif
													</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
								</div>
								<small>Pulse + para agregar otro producto /  Pulse - para eliminar un producto.</small>
								<br />	
							</div>
	
						</div>
						</li>
					</ul>
			</div>
		</form>
    </div>
		
		
		
		<!-- Categoria modal -->		  

		  <div class="modal fade categoria" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-sm">
			  <div class="modal-content">

				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
				  </button>
				  <h4 class="modal-title" id="myModalLabel2">Nueva Categoria</h4>
				</div>
				<div class="modal-body">
					<label class="control-label " for="first-name"> Categoria</label>
					<div class="form-group input-group ">
						<input name="multiple[]" class="form-control ">
						<span class="input-group-btn"><button type="button" class="btn btn-primary btn-add">+</button></span>
					</div>
					<small>Pulse + para agregar otra categoria /  Pulse - para eliminar una categoria.</small>
				</div>
				<div class="modal-footer"><!--
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
				 <button type="reset"class="btn btn-danger">Borrar</button>
				  <input type="submit" class="btn btn-primary">Guardar</input>

				</div>
			
        </div>
	
		 
	</div>		
@stop
@section('postscripts')  
	<script>
		//var producto = 1;
		var rq = 1;
		var primer_producto_cargado = false;
		
		function onlyUnique(value, index, self) { 
			return self.indexOf(value) === index;
		}
		
		function cargarIdRQS(id) {
			$('#buscarRQSid').val(id);
		}
		
		function buscarIdRQS(productos) {			
			
			$.get("{{ url('solicitudcompra/buscarrqsutorizada')}}", 
				{
					option: $('#buscarRQSid').val(),
					
				}, 
				function(data) {
					if(data){
						var rqs = [];
						$.each(data, function(index, element) {
							rqs[index] = element.requisicion;
							if(window.producto == 1 && window.primer_producto_cargado == false){
								$('#producto1').val(element.producto.id);
								$('#cantidad1').val(element.cant_apr_prd);
								$.get("{{ url('requisicion/cargarunidadesproducto')}}", 
								{
									option: $('#producto1').val(),
									
								}, 
								function(data) {
									var model = $('#unidad1');
									model.empty();
									model.append("<option value='' selected>Seleccionar</option>");
										$.each(data, function(index, element2) {
											var text_append="<option value='"+ element2.id +"'";
											if(element.unidad_solicitada.id == element2.id){
												text_append = text_append + " selected ";
											}
											text_append = text_append + ">" + element2.des_und + "</option>"
											model.append(text_append);
										});
								});
								
								$.get("{{ url('solicitudcompra/cargardisponibleproducto')}}", 
								{
									option: $('#producto1').val(),
									
								}, 
								function(data) {
									if(data){
										if(data.cnt_prd == null){
											document.getElementById("disponible1").value = '0 ' + data.und;
										}
										else{
											document.getElementById("disponible1").value = data.cnt_prd + ' ' + data.und;
										}
										
									}
									
									//model.setAttribute('value', );
								});
								window.primer_producto_cargado = true;
							}
							else{
								window.producto++;
								var objTo = document.getElementById('education_fields2');
								var divtest = document.createElement("tbody");
								divtest.setAttribute("class", "form-group tr removeclass"+producto);
								var rdiv = 'removeclass'+producto;
								var text = '<tr><td>' +
								(producto) +
								'</td>'+
								//Productos
								'<td class="nopadding" >'+
								'<select class="form-control" id="producto'+(producto)+'" name="producto'+(producto)+'" onchange="cambio_productos('+(producto)+');">'+
								'<option value="" selected>Seleccionar</option>';
								$.each(productos, function(index, element) {
										text = text + '<option value="'+ element.id +'">' + element.des_prd + '</option>';
									});
								text = text +
								'</select></td>'+
								//Unidades
								'<td class="nopadding" >'+
									'<select class="form-control" id="unidad'+(producto)+'" name="unidad'+(producto)+'"><option value="">Seleccionar</option></select>'+
								'</td>'+
								//Cantidad
								'<td class="nopadding" >'+
									'<div class="form-group"><input type="text" class="form-control" id="cantidad'+(producto)+'" name="cantidad'+(producto)+'" value="" placeholder="Cantidad"/></div>'+
								'</td>'+				
								//Disponible
								'<td class="nopadding" >'+
									'<div class="form-group"><input type="text" class="form-control" id="disponible'+(producto)+'" name="disponible'+(producto)+'" disabled style="background:rgba(247, 247, 247, 0.57);"/></div>'+
								'</td></tr>';
								divtest.innerHTML = text;
								objTo.appendChild(divtest);
								$("#cantproductos").val(window.producto);  
								$('#producto'+window.producto).val(element.producto.id);
								$('#cantidad'+window.producto).val(element.cant_apr_prd);
								if(element.almacen.cnt_prd == null){
										$('#disponible'+window.producto).val('0 ' + element.almacen.und);
								}
								else{
									$('#disponible'+window.producto).val(element.almacen.cnt_prd + ' ' + element.almacen.und);
								}
								
								var model = $('#unidad'+window.producto);
								model.empty();
								model.append("<option value='' selected>Seleccionar</option>");
									$.each(element.producto.unidades, function(index, element2) {
										var text_append="<option value='"+ element2.id + "'>" + element2.des_und + "</option>"
										model.append(text_append);
									});
								$('#unidad'+window.producto).val(element.unidad_sol_id);
								
							}
						});
						rqs = rqs.filter(onlyUnique);
						$.each(rqs, function(index, element) {
							var sw = true;
							if(window.rq > 1){
								ii = 1;
								while(ii <= rq && sw == true) { 
									var rr = $("#rqs"+ii).val(); 
									if(element.id == rr){
										sw = false;
									}
									ii++;
								}
							}
							if(sw == true){
								var objTo2 = document.getElementById('rqs');
								var divtest2 = document.createElement("tbody");
								var text2 = '<tr><td>' +
								(element.id) +
								//'<input type="hidden" class="form-control" id="rqs'+(rq)+'" name="rqs'+(rq)+'" />'+
								'</td>'+
								//Fecha
								'<td class="nopadding" >'+
									'<div class="form-group"><input type="text" class="form-control" id="fecha'+(rq)+'" name="fecha'+(rq)+'" value="" placeholder="Fecha" readonly /></div>'+
								'</td>'+
								//Asunto
								'<td class="nopadding" >'+
									'<div class="form-group"><input type="text" class="form-control" id="asunto'+(rq)+'" name="cantidad'+(rq)+'" value="" placeholder="Asunto" readonly /></div>'+
								'</td>';
								//+
								//Solicitante
								//'<td class="nopadding" >'+
								//	'<div class="form-group"><input type="text" class="form-control" id="solicitante'+(rq)+'" name="solicitante'+(rq)+'" value="" placeholder="Cantidad"  readonly/></div>'+
								//'</td></tr>';
								divtest2.innerHTML = text2;
								objTo2.appendChild(divtest2);
								$("#totalrqs").val(rq);  
								//$("#rqs"+window.rq).val(element.id);  
								$("#fecha"+window.rq).val(element.created_at);  
								$('#asunto'+window.rq).val(element.asn_rqs);
								//$('#solicitante'+window.rq).val(element.user);
								
								var input = document.createElement("input");
								input.setAttribute('type', 'hidden');
								input.setAttribute('id', 'rqs'+window.rq);
								input.setAttribute('name', 'rqs'+window.rq);
								input.setAttribute('value', element.id);
								var parent = document.getElementById("rqspanel");
								parent.appendChild(input);
								rq++;
							}
						});
					}
				});
		}
		
		function buscarFechaRQS(productos) {			
			
			$.get("{{ url('solicitudcompra/buscarrqsautorizadaporfecha')}}", 
				{
					start: $('#fechaRQS').data('daterangepicker').startDate.format('YYYY-MM-DD'),
					end: $('#fechaRQS').data('daterangepicker').endDate.format('YYYY-MM-DD'),
					
				}, 
				function(data) {
					if(data){
						var rqs = [];
						$.each(data, function(index, element) {
							rqs[index] = element.requisicion;
							if(window.producto == 1 && window.primer_producto_cargado == false){
								$('#producto1').val(element.producto.id);
								$('#cantidad1').val(element.cant_apr_prd);
								$.get("{{ url('requisicion/cargarunidadesproducto')}}", 
								{
									option: $('#producto1').val(),
									
								}, 
								function(data) {
									var model = $('#unidad1');
									model.empty();
									model.append("<option value='' selected>Seleccionar</option>");
										$.each(data, function(index, element2) {
											var text_append="<option value='"+ element2.id +"'";
											if(element.unidad_solicitada.id == element2.id){
												text_append = text_append + " selected ";
											}
											text_append = text_append + ">" + element2.des_und + "</option>"
											model.append(text_append);
										});
								});
								
								$.get("{{ url('solicitudcompra/cargardisponibleproducto')}}", 
								{
									option: $('#producto1').val(),
									
								}, 
								function(data) {
									if(data){
										if(data.cnt_prd == null){
											document.getElementById("disponible1").value = '0 ' + data.und;
										}
										else{
											document.getElementById("disponible1").value = data.cnt_prd + ' ' + data.und;
										}
										
									}
									
									//model.setAttribute('value', );
								});
								window.primer_producto_cargado = true;
							}
							else{
								window.producto++;
								var objTo = document.getElementById('education_fields2');
								var divtest = document.createElement("tbody");
								divtest.setAttribute("class", "form-group tr removeclass"+producto);
								var rdiv = 'removeclass'+producto;
								var text = '<tr><td>' +
								(producto) +
								'</td>'+
								//Productos
								'<td class="nopadding" >'+
								'<select class="form-control" id="producto'+(producto)+'" name="producto'+(producto)+'" onchange="cambio_productos('+(producto)+');">'+
								'<option value="" selected>Seleccionar</option>';
								$.each(productos, function(index, element) {
										text = text + '<option value="'+ element.id +'">' + element.des_prd + '</option>';
									});
								text = text +
								'</select></td>'+
								//Unidades
								'<td class="nopadding" >'+
									'<select class="form-control" id="unidad'+(producto)+'" name="unidad'+(producto)+'"><option value="">Seleccionar</option></select>'+
								'</td>'+
								//Cantidad
								'<td class="nopadding" >'+
									'<div class="form-group"><input type="text" class="form-control" id="cantidad'+(producto)+'" name="cantidad'+(producto)+'" value="" placeholder="Cantidad"/></div>'+
								'</td>'+				
								//Disponible
								'<td class="nopadding" >'+
									'<div class="form-group"><input type="text" class="form-control" id="disponible'+(producto)+'" name="disponible'+(producto)+'" disabled style="background:rgba(247, 247, 247, 0.57);"/></div>'+
								'</td>'+
								//Botones
								'<td class="nopadding" >'+
									'<div class="input-group-btn"><button class="btn btn-sm btn-danger glyphicon glyphicon-minus btn-xs" type="button" onclick="remove_education_fields2('+ producto +');">'+
										'<span aria-hidden="true"></span>'+
									'</button></div>'+
								'</td></tr>';
								divtest.innerHTML = text;
								objTo.appendChild(divtest);
								$("#cantproductos").val(window.producto);  
								$('#producto'+window.producto).val(element.producto.id);
								$('#cantidad'+window.producto).val(element.cant_apr_prd);
								if(element.almacen.cnt_prd == null){
										$('#disponible'+window.producto).val('0 ' + element.almacen.und);
								}
								else{
									$('#disponible'+window.producto).val(element.almacen.cnt_prd + ' ' + element.almacen.und);
								}
								
								var model = $('#unidad'+window.producto);
								model.empty();
								model.append("<option value='' selected>Seleccionar</option>");
									$.each(element.producto.unidades, function(index, element2) {
										var text_append="<option value='"+ element2.id + "'>" + element2.des_und + "</option>"
										model.append(text_append);
									});
								$('#unidad'+window.producto).val(element.unidad_sol_id);
								
							}
						});
						var r = rqs.filter(onlyUnique);
						$.each(r, function(index, element) {
							var sw = true;
							if(window.rq > 1){
								var ii = 1;
								while(ii <= rq && sw == true) { 
									var rr = $("#rqs"+ii).val(); 
									if(element.id == rr){
										sw = false;
									}
									ii++;
								}
							}
							if(sw == true){
								var objTo2 = document.getElementById('rqs');
								var divtest2 = document.createElement("tbody");
								var text2 = '<tr><td>' +
								(element.id) +
								//'<input type="hidden" class="form-control" id="rqs'+(rq)+'" name="rqs'+(rq)+'" value="" /></div>'+
								'</td>'+
								//Fecha
								'<td class="nopadding" >'+
									'<div class="form-group"><input type="date" class="form-control" id="fecha'+(rq)+'" name="fecha'+(rq)+'" value="" placeholder="Fecha" readonly /></div>'+
								'</td>'+
								//Asunto
								'<td class="nopadding" >'+
									'<div class="form-group"><input type="text" class="form-control" id="asunto'+(rq)+'" name="cantidad'+(rq)+'" value="" placeholder="Asunto" readonly /></div>'+
								'</td>'+
								//Solicitante
								'<td class="nopadding" >'+
									'<div class="form-group"><input type="text" class="form-control" id="solicitante'+(rq)+'" name="solicitante'+(rq)+'" value="" placeholder="Cantidad"  readonly/></div>'+
								'</td></tr>';
								divtest2.innerHTML = text2;
								objTo2.appendChild(divtest2);
								$("#totalrqs").val(rq);  
								//$("#rqs"+window.rq).val(element.id);  
								$("#fecha"+window.rq).val(element.created_at);  
								$('#asunto'+window.rq).val(element.asn_rqs);
								//$('#solicitante'+window.rq).val(element.user);
								var input = document.createElement('input');
								input.setAttribute('type', 'hidden');
								input.setAttribute('class', 'form-control');
								input.setAttribute('id', 'rqs'+window.rq);
								input.setAttribute('name', 'rqs'+window.rq);
								input.setAttribute('value', element.id);
								var parent = document.getElementById("rqspanel");
								parent.appendChild(input);
								
								
								rq++;
							}							
						});
					}
					else{
						alert('Nada');
					}
					
					//model.setAttribute('value', );
			});
		}
		
		function education_fields2(productos) {
			producto++;
			var objTo = document.getElementById('education_fields2')
			var divtest = document.createElement("tbody");
			divtest.setAttribute("class", "form-group tr removeclass"+producto);
			var rdiv = 'removeclass'+producto;
			var text = '<tr><td>' + (producto) +'</td>'+
				//Productos
				'<td class="nopadding" >'+
				'<select class="form-control" id="producto'+(producto)+'" name="producto'+(producto)+'" onchange="cambio_productos('+(producto)+');">'+
				'<option value="" selected>Seleccionar</option>';
				$.each(productos, function(index, element) {
						text = text + '<option value="'+ element.id +'">' + element.des_prd + '</option>';
					});
				text = text +
				'</select></td>'+
				//Unidades
				'<td class="nopadding" >'+
					'<select class="form-control" id="unidad'+(producto)+'" name="unidad'+(producto)+'"><option value="">Seleccionar</option></select>'+
				'</td>'+
				//Cantidad
				'<td class="nopadding" >'+
					'<div class="form-group"><input type="text" class="form-control" id="cantidad'+(producto)+'" name="cantidad'+(producto)+'" value="" placeholder="Cantidad"/></div>'+
				'</td>'+				
				//Disponible
				'<td class="nopadding" >'+
					'<div class="form-group"><input type="text" class="form-control" id="disponible'+(producto)+'" name="disponible'+(producto)+'" disabled style="background:rgba(247, 247, 247, 0.57);"/></div>'+
				'</td>'+
				
				//Botones
				 '<td class="nopadding" >'+
					'<div class="input-group-btn"><button class="btn btn-sm btn-danger glyphicon glyphicon-minus btn-xs" type="button" onclick="remove_education_fields2('+ producto +');">'+
						'<span aria-hidden="true"></span>'+
					'</button></div>'+
				'</td></tr>';
				divtest.innerHTML = text;
				//'<tr><td>' + (producto) + '</td><td><div class="form-group "><select class="form-control"><option value="" selected>Seleccionar</option><option value="">Taller de Cocina</option><option value="">Papeleria</option><option value="" >Didacticos</option><option value="" >Aseo</option></select></div></td><td class="nopadding" ><select class="form-control" id="educationDate" name="educationDate[]"><option value="" selected>Seleccionar</option><option name="" value="">Aceite</option><option value="">Arepas antioqueñas precocidas </option><option value="" >Arroz  (bolsas de medio kilo)</option><option value="" >Bocadillo</option></select></td><td class="nopadding" ><div class="form-group"><input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="Detalle"></div></td><td class="nopadding" ><select class="form-control" id="educationDate" name="educationDate[]"><option value="" selected>Seleccionar</option><option name="" value="">Barra</option><option name="" value="">Bloque</option><option name="" value="">Bolsa</option><option name="" value="">Botella</option><option name="" value="">Caja</option><option name="" value="">Frasco</option><option value="">Lata</option><option value="">Paquete</option><option value="">Pote</option><option value="">Tarro</option><option value="">Tubo</option><option value="">Vaso</option><option name="" value="">Unidad</option><option value="">Kg</option><option value="">Kilo</option><option value="">Litro</option><option value="">Lonjas</option></select></td><td>1 Caja de 5 UND</td><td class="nopadding" ><div class="form-group"><input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="Cantidad"></div></td><td class="nopadding" ><div class="input-group-btn"><button class="btn btn-sm btn-danger glyphicon glyphicon-minus btn-xs" type="button" onclick="remove_education_fields2('+ producto +');"> <span  aria-hidden="true"></span> </button></div></td></tr>';
				objTo.appendChild(divtest)
				$("#cantproductos").val(window.producto);
		}
		
		function remove_education_fields2(rid) {
		   $('.removeclass'+rid).remove()
		   
		   producto--;
	   }
	   
	   function cambio_productos(rid) {
		   $.get("{{ url('solicitudcompra/cargarunidadesproducto')}}", 
				{
					option: $('#producto'+rid).val(),
					
				}, 
				function(data) {
					var model = $('#unidad'+rid);
					model.empty();
					model.append("<option value='' selected>Seleccionar</option>");
						$.each(data, function(index, element) {
							model.append("<option value='"+ element.id +"'>" + element.des_und + "</option>");
					});
			});
			
			$.get("{{ url('solicitudcompra/cargardisponibleproducto')}}", 
				{
					option: $('#producto'+rid).val(),
					
				}, 
				function(data) {
					if(data){
						if(data.cnt_prd == null){
							document.getElementById("disponible"+rid).value = '0 ' + data.und;
						}
						else{
							document.getElementById("disponible"+rid).value = data.cnt_prd + ' ' + data.und;
						}
						
					}
					
					//model.setAttribute('value', );
			});
	   }
		var start = moment().subtract(29, 'days');
		var end = moment();
		function cb(start, end) {
			$('#fechaRQS span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
		}
		$('#fechaRQS').daterangepicker({
			"locale": {
				"format": "MM/DD/YYYY",
				"separator": " - ",
				"applyLabel": "Aplicar",
				"cancelLabel": "Cancelar",
				"fromLabel": "Desde",
				"toLabel": "Hasta",
				"customRangeLabel": "Rango Personalizado",
				"weekLabel": "S",
				"daysOfWeek": [
					"Dom",
					"Lun",
					"Mar",
					"Mie",
					"Jue",
					"Vie",
					"Sab"
				],
				"monthNames": [
					"Enero",
					"Febrero",
					"Marzo",
					"Abril",
					"Mayo",
					"Junio",
					"Julio",
					"Augosto",
					"Septiembre",
					"Octubre",
					"Noviembre",
					"Diciembre"
				],
				"firstDay": 1
			},

			"alwaysShowCalendars": true,
			startDate: start,
			endDate: end,
			ranges: {
			'Hoy': [moment(), moment()],
			'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],
			'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
			'Este mes': [moment().startOf('month'), moment().endOf('month')],
			'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);
		cb(start, end);
	</script> 
@stop
