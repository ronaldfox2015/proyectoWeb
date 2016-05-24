$(document).on("ready",ready)
function ready(){
	var tabla_comprobantes=$('#table_reporte_comprobantes').DataTable({
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
	$("#table_reporte_comprobantes_filter").html("");
	//filtro por periodo
		$.fn.dataTable.ext.search.push(function( settings, data, dataIndex ) {
        var periodo_s=$("#periodo").val();
        var periodo =  data[1]; // use data for the age column
        var periodo_nuevo=periodo.substring(3,10);

	        if(periodo_s!==""){
	        	if ( periodo_s===periodo_nuevo ){
		            return true;
		        }
		        return false;
			}else{
	        	return true;
	        }
		}
	);

	$("#btn_buscar_comprobante").on("click",function(){
		tabla_comprobantes.draw();
	});
	$( "#btn_buscar_comprobante" ).trigger( "click" );
  $("#table_reporte_comprobantes").find(".dataTables_empty").attr("colspan",8);
  $(".contenedorInputsEpass").removeClass("hide");
}
function downloadComprobante(data){

	$(data).addClass("color-gray");
	$(data).attr("onclick","");
	var data_flag=$(data).attr("data-flag");

	if(data_flag==="1"){
		var _ruttEmpr =$(data).attr("data-ruc"); 
		var _folioDTE =$(data).attr("data-folio"); 
		var _tipoDTE =$(data).attr("data-tipo"); 
		var _serieInte =$(data).attr("data-serie"); 
		var _fechaDTE =$(data).attr("data-fecha"); 
		var _monTotal =$(data).attr("data-monto");

		$.ajax({
          url: basePath+'application/cuenta/generar-comprobantes',
          type: 'POST',
          async: true,
          data: {	_ruttEmpr:_ruttEmpr,
          			_folioDTE:_folioDTE,
          			_tipoDTE:_tipoDTE,
          			_serieInte:_serieInte,
          			_fechaDTE:_fechaDTE,
          			_monTotal:_monTotal,
          		},
          success:function(response) {
          		$(data).removeClass("color-gray");
          		$(data).attr("onclick","downloadComprobante(this)");
                if(response.flag===1) 
                {
                   window.location=response.url;
                }
                else if(response.flag===2)
                {
                	$("#error_generar_pdf").modal("show");
                }
                
            }
        });
	}else if(data_flag==="2"){
		var txtRecibo=$(data).attr("data-url");
		$.ajax({
          url: basePath+'application/cuenta/generar-recibo',
          type: 'POST',
          async: true,
          data: {	txtRecibo:txtRecibo,

          		},
          success:function(response) {
          	$(data).removeClass("color-gray");
          	$(data).attr("onclick","downloadComprobante(this)");
                if(response.flag===1) 
                {
                   window.location=response.url;
                }
                else if(response.flag===2)
                {
                	$("#error_generar_pdf").modal("show");
                }
                
            }
        });
	}



}
