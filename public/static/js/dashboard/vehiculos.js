$(document).on("ready",ready)
function ready(){
	var tabla_reporte=$('#table_reporte_vehiculos').DataTable({
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
	$("#table_reporte_vehiculos_filter").html("");
	//filtro por cuenta
	$.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
	        var cuenta_s=$("#bcuenta").val();
	        if(cuenta_s!==''){
	        	var cuenta =  data[1]; // use data for the age column
		         if ( cuenta_s===cuenta )
		        {
		            return true;
		        }
		        return false;
	        }else{
	        	return true;
	        }
	        
	    }
	);
	//filtro por placa error espaciossssssss
	$.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
        var placa_s=$("#bplaca option:selected").html();

        var placa =  data[2]; // use data for the age column
	        if(placa_s!=="Todos"){
	        	if ( placa_s===placa ){
		            return true;
		        }
		        return false;
			}else{
	        	return true;
	        }
		}
	);
		//filtro por Tag falta dataaa
	$.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
        var tag_s=$("#btag").val();
        var tag =  data[3]; // use data for the age column
	        if(tag_s!==""){
	        	if ( tag_s===tag ){
		            return true;
		        }
		        return false;
			}else{
	        	return true;
	        }
		}
	);
		//filtro por estado
	$.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
        var estado_s=$("#estado option:selected").html();
        var estado =  data[4]; // use data for the age column
	        if(estado_s!=="Todos"){
	        	if ( estado_s===estado ){
		            return true;
		        }
		        return false;
			}else{
	        	return true;
	        }
		}
	);	

	//filtro por marca
	$.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
        var marca_s=$("#bmarca").val();
        var marca =  data[5]; // use data for the age column
	        if(marca_s!==""){
	        	if ( marca_s===marca ){
		            return true;
		        }
		        return false;
			}else{
	        	return true;
	        }
		}
	);	//filtro por modelo
	$.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
        var modelo_s=$("#bmodelo").val();
        var modelo =  data[6]; // use data for the age column
	        if(modelo_s!==""){
	        	if ( modelo_s===modelo ){
		            return true;
		        }
		        return false;
			}else{
	        	return true;
	        }
		}
	);

	$("#btn_vehiculos").on("click",function(){
		tabla_reporte.draw();
	});
}
