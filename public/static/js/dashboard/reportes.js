$(document).on("ready",ready)
function ready(){

	var tabla=$('#table_reporte_movimiento').DataTable({
		"info":     false,
		"bFilter": true,
		"bLengthChange": false,
		"iDisplayLength": 10,
		"bSort": false,
		"language": {
      	"emptyTable": "<p style='color:red;text-align:center;font-size:14px'>No se encontraron registros.</p>",
      	"zeroRecords": "<p style='color:red;text-align:center;font-size:14px'>No se encontró resultados en su búsqueda.</p>",
			"paginate": {
	      		"next": "<i class='fa fa-step-forward'></i>",
	      		"previous": "<i class='fa fa-step-backward'></i>"
	    	}
	    } 
	});
	$("#table_reporte_movimiento_filter").html("");
	var tabla_transacciones=$('#table_reporte_transacciones').DataTable({
		"info":     false,
		"bFilter": true,
		"bLengthChange": false,
		"iDisplayLength": 10,
		"bSort": false,
		"language": {
      	"emptyTable": "<p style='color:red;text-align:center;font-size:14px'>No se encontraron registros.</p>",
      	"zeroRecords": "<p style='color:red;text-align:center;font-size:14px'>No se encontró resultados en su búsqueda.</p>",
			"paginate": {
	      		"next": "<i class='fa fa-step-forward'></i>",
	      		"previous": "<i class='fa fa-step-backward'></i>"
	    	}
	    } 
	});
	
	$("#table_reporte_transacciones_filter").html("");

	var filter_medio_pago_movimiento=function( settings, data, dataIndex ){
			var mediopago_s=$("#medio_pago option:selected").html();
	        var mediopago =  data[3]; // use data for the age column
	        if(mediopago_s!=='Todos'){
	        	
		         if ( mediopago_s===mediopago )
		        {
		            return true;
		        }
		        return false;
	        }else{
	        	return true;
	        }
	        
	};
	var filter_periodo_movimiento=function(settings,data,dataIndex){
		 var periodo_s=$("#periodo").val();
                
	        var periodo =  data[0]; // use data for the age column
	        var periodo_nuevo=periodo.substring(3,10);
		        if(periodo_s!==""){
		        	if ( periodo_s===periodo_nuevo ){
			            return true;
			        }
			        return false;
				}else{
		        	return true;
		        }
	};
	var filter_placa_transacciones=function(settings,data,dataIndex){
				var placa_s=$("#placa").val();
		        var placa =  data[3]; // use data for the age column
		        if(placa_s!==""){	        	
			         if ( placa_s===placa )
			        {	
			            return true;
			        }
			        return false;
		        }else{
		        	return true;
		        }
	};
	var filter_periodo_transacciones=function(settings,data,dataIndex){
	        var periodo1_s=$("#periodo-transaccion").val();
	        var periodo1 =  data[0]; // use data for the age column
	        var periodo1_nuevo=periodo1.substring(3,11);
		        if(periodo1_s!==""){
		        	if ( periodo1_s===periodo1_nuevo ){
			            return true;
			        }
			        return false;
				}else{
		        	return true;
		        }
   
	};
	var filter_plaza_transacciones=function(settings,data,dataIndex){
		 var plaza_s=$("#plaza option:selected").html();
		        var plaza =  data[2]; // use data for the age column
		        if(plaza_s!=='Todos'){
		        	
			         if ( plaza_s===plaza )
			        {
			            return true;
			        }
			        return false;
		        }else{
		        	return true;
		        }
	};





	

	$("#btn_reporte_transacciones").on("click",function(){

		$.fn.dataTable.ext.search=[];
		$.fn.dataTable.ext.search.push(filter_placa_transacciones);
		$.fn.dataTable.ext.search.push(filter_periodo_transacciones);
		$.fn.dataTable.ext.search.push(filter_plaza_transacciones);
		tabla_transacciones.draw();
		
	});
	$("#btn_reporte_movimiento").on("click",function(){

		$.fn.dataTable.ext.search=[];
		$.fn.dataTable.ext.search.push(filter_medio_pago_movimiento);
		$.fn.dataTable.ext.search.push(filter_periodo_movimiento);
		tabla.draw();

	});

	$( "#btn_reporte_movimiento" ).trigger( "click" );
	$( "#btn_reporte_transacciones" ).trigger( "click" );
	$(".contenedorInputsEpass").removeClass("hide");
	$("#table_reporte_transacciones").find(".dataTables_empty").attr("colspan",10);
	$("#table_reporte_movimiento").find(".dataTables_empty").attr("colspan",4);
}