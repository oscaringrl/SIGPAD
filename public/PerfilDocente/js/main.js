var ip =$('meta[name="current-url"]').attr('content');
//console.log(ip);
function getHistorialAcademico(idDcn){
  $.ajax({
           type:'POST',
           url:ip+'/getHistorial',
           data:{'docente':idDcn},
           success:function(data){
            //console.log(data.length);
            if (data.length == 0 ) {
                $("#seccionHistorial").append("<b>NO SE HAN REGISTRADO DATOS DE EXPERIENCIA ACADEMICA</b>");
             }else{
                var html = '<table class="table table-striped"><thead><tr><th scope="col">#</th><th scope="col">Cargo</th><th scope="col">Código</th><th scope="col">Materia</th><th scope="col">Ciclo</th><th scope="col">Año</th> </tr></thead><tbody>';

               for (var i = 0;i<data.length;i++) {
                body="";
                body+='<tr><th scope="row">'+(i+1)+'</th>';
                body+='<td>'+data[i]['Cargo']+'</td>';
                body+='<td>'+data[i]['Codigo']+'</td>';
                body+='<td>'+data[i]['Materia']+'</td>';
                body+='<td>'+data[i]['Ciclo']+'</td>';
                body+='<td>'+data[i]['anio']+'</td></tr>';
                html+=body;
               }

               html+=' </tbody></table>';
               $("#seccionHistorial").append(html)
             }


           },
        error : function(xhr, status) {
            alert("Hubo un problema al momento de obetener los datos de Docente");

        }
        });
}

function getExperienciaDocente(idDcn){
  $.ajax({
           type:'POST',
           url:ip+'/getExperiencia',
           data:{'docente':idDcn},
           success:function(data){
            //console.log(data.length);
             var html = "";
             if (data.length == 1 && data[0]['id_dcn_exp'] == '') {
                $("#seccionExperiencia").append("<b>NO SE HAN REGISTRADO DATOS DE EXPERIENCIA LABORAL</b>");
             }else{
                for (var i = 0;i<data.length;i++) {
                html="";
                html+='<div class="resume-item d-flex flex-column flex-md-row mb-5">';
                html+='<div class="resume-content mr-auto">';
                html+='<h3 class="mb-0">'+data[i]['lugar_trabajo_dcn_exp']+'</h3>';
                html+='<div class="subheading mb-3">'+data[i]['idiomaExper']+'</div>';
                html+='<div>'+data[i]['descripcionExperiencia']+'</div>';
                //html+='<p>GPA: 3.23</p>';
                html+='</div><div class="resume-date text-md-right">';
                html+='<span class="text-primary">Período '+data[i]['anio_inicio_dcn_exp']+' - '+data[i]['anio_fin_dcn_exp']+'</span> </div></div>';
                $("#seccionExperiencia").append(html);
               }
             }


           },
        error : function(xhr, status) {
            alert("Hubo un problema al momento de obtener los datos de Docente");

        }
        });
}

function getCertificacionesDocente(idDcn){
  $.ajax({
           type:'POST',
           url:ip+'/getCertificaciones',
           data:{'docente':idDcn},
           success:function(data){
            //console.log(data.length);
            if (data.length == 1 && data[0]['id_dcn_cer'] == '') {
                $("#seccionCertificaciones").append("<b>NO SE HAN REGISTRADO  CERTIFICACIONES</b>");
             }else{
                var html = '<table class="table table-striped"><thead><tr><th scope="col">#</th><th scope="col">Nombre</th><th scope="col">Año</th><th scope="col">Institución</th><th scope="col">Idioma</th></tr></thead><tbody>';

               for (var i = 0;i<data.length;i++) {
                body="";
                body+='<tr><th scope="row">'+(i+1)+'</th>';
                body+='<td>'+data[i]['nombre_dcn_cer']+'</td>';
                body+='<td>'+data[i]['anio_expedicion_dcn_cer']+'</td>';
                body+='<td>'+data[i]['institucion_dcn_cer']+'</td>';
                body+='<td>'+data[i]['idiomaCert']+'</td>';
                html+=body;
               }

             html+=' </tbody></table>';
             $("#seccionCertificaciones").append(html)
             }


           },
        error : function(xhr, status) {
            alert("Hubo un problema al momento de obetener los datos de Docente");

        }
        });
}

function getSkillsDocente(idDcn){
  $.ajax({
           type:'POST',
           url:ip+'/getSkills',
           data:{'docente':idDcn},
           success:function(data){
            //console.log(data.length);
            if (data.length == 1 && data[0]['id_cat_ski'] == '') {
                $("#seccionSkills").append("<b>NO SE HAN REGISTRADO HABILIDADES</b>");
             }else{
                var html = '<ul class="fa-ul mb-0">';
               for (var i = 0;i<data.length;i++) {
                body="";
                body+='<li><i class="fa-li fa fa-check"></i>'+data[i]['nombre_cat_ski']+' - '+data[i]['Nivel']+'</li>';
                html+=body;
               }

               html+='</ul>';
               $("#seccionSkills").append(html)
             }


           },
        error : function(xhr, status) {
            alert("Hubo un problema al momento de obetener los datos de Docente");

        }
        });
}


function getInformacionDocente(idDcn){
  var d = new Date();
  var t= d.getTime();
  $.ajax({
           type:'POST',
           url:ip+'/getGeneralInfo',
           data:{'docente':idDcn},
           success:function(data){
            var docente = data[0];
            var html = "";
            html+='<span class="text-primary">';
            html+=docente["display_name"];
            html+='</span>';
            $("#nombreDocente").append(html);
            $("#descripcionDocente").append(docente["descripcionDocente"]);
            $("#correoDocente").append(docente["email"]);
            $("#correoDocente").attr("href","mailto:"+docente["email"]);
            $("#cargoDocente").append(docente["nombre_cargo"]);
            $("#profileFoto").attr("src",ip+"/Uploads/PerfilDocente/"+docente["dcn_profileFoto"]+"?"+t);
            $("#linkLinkedind_").attr("href",docente["link_linke"]);
            $("#linkGit_").attr("href",docente["link_git"]);
            $("#linkTw_").attr("href",docente["link_tw"]);
            $("#linkFb_").attr("href",docente["link_fb"]);



           },
        error : function(xhr, status) {
            alert("Hubo un problema al momento de obetener los datos de Docente");

        }
        });
}


function getListadoDocente(idJornada){
  $.ajax({
      type:'POST',
      url:ip+'/getListadoDocentes',
      data:{'jornada':idJornada},
      success:function(data){
          //console.log(data);
          var seccionesHtmlString = armarSecciones(data);
          var dataHtmlArray = distribuirData(data);
          for(var m = 1; m<dataHtmlArray.length; m++){
              seccionesHtmlString = seccionesHtmlString.replace('replaceable_'+m,dataHtmlArray[m]);
          }
          $("#divDataEmpleados").append(seccionesHtmlString);
      }, error : function(xhr, status) {
          console.log("Hubo un problema al momento de obetener los datos de Docente");
      }
  });
}

function armarSecciones(data){
    var html = '';
    var sections = [];
    for(var i = 0; i<data.length; i++){
        var currSec = parseInt(data[i]['tipoJornada']);
        if(!sections.includes(currSec)){
            sections.push(currSec);
            var currTitle = data[i]['emp_clasif'];
            html += '<section class="customSectionStyle" id="listado"> ' +
                    '<div class="my-auto" id="seccionListado_' + currSec + '"> ' +
                    '<span class="elementor-divider-separator"></span> ' +
                    '<h2 class="mb-5 customSectionH2Title">' + currTitle + '</h2> ' +
                    '<span class="elementor-divider-separator"></span> ' + 'replaceable_' + currSec +
                    '</div></section><br/>';
        }
    }
    return html;
}
function distribuirData(data) {
    var sectionData = [];
    var counters = [];
    var rowFlags = [];
    var d = new Date();
    var t= d.getTime();
    for(var i = 0; i<data.length; i++){
        var cargo2 = data[i]['nombre_cargo2'];
        var tpoPriv = parseInt(data[i]['perfilPrivado']);
        var currSec = parseInt(data[i]['tipoJornada']);
        var aux = parseInt(counters[currSec]);
        var flag = rowFlags[currSec];

        if(isNaN(aux)||aux===0){//primera
            aux = 1;
            flag = true;
            sectionData[currSec] = "";
        }
        sectionData[currSec] +=
            (flag?'<div class = "row">':'') +
            '<div class="col-md-4"><blockquote>'+
            (tpoPriv===1?'':'<a href="'+ip+'/perfilDocente/'+data[i]['id_pdg_dcn']+'"  data-target="#myModal" target="myModal">')+
            '<div class=""><div class="text-center">'+
            '<img class="img-circle" id="imgPerfil" src="'+ip+'/Uploads/PerfilDocente/'+data[i]['dcn_profileFoto']+'?'+t+'" style="object-fit: cover;" > '+
            '</div><div class=" text-center">'+
            '<p style="color:#7c0000;">'+data[i]['display_name']+'</p>'+
            '<small>'+data[i]['nombre_cargo']+ (cargo2===''?'':'&nbsp;&sol;&nbsp;<i>'+cargo2+'</i>')+'</small>'+
            '</div></div>'+
            (tpoPriv===1?'':'</a>')+
            '</blockquote></div>';
        rowFlags[currSec] = false;
        counters[currSec] =  aux + 1;
    }
    for(var j = 1; j<counters.length; j++){
        sectionData[j] += '</div>';
    }
    return sectionData;
}
// NUEVAS FUNCIONES DE AJAX PARA EL PERFIL PUBLICO GP04-2019
function getDiplomadosDocente(idDcn){
  $.ajax({
           type:'POST',
           url:ip+'/getDiplomados',
           data:{'docente':idDcn},
           success:function(data){
           console.log(data);

         if (data.length == 1 && data[0]['id_dcn_dip'] == '') {
                $("#seccionDiplomados").append("<b>NO SE HAN REGISTRADO  DIPLOMADOS</b>");
             }else{
              //  var html = '<table class="table table-striped"><thead><tr><th scope="col">#</th><th scope="col">Nombre</th><th scope="col">Descripción</th><th scope="col">Desde</th><th scope="col">Hasta</th><th scope="col">Institucion</th><th scope="col">Modalidad</th><th scope="col">Pais</th></tr></thead><tbody>';
               var html= '<div class="col-md-12">';

               for (var i = 0;i<data.length;i++) {
                startD= new Date (data[i]['fecha_inicio_dip']);
                endD= new Date (data[i]['fecha_fin_dip']);
                d1= monthNames[startD.getMonth()]+' '+startD.getDate()+' del '+startD.getFullYear();
                d2= monthNames[endD.getMonth()]+' '+endD.getDate()+' del '+endD.getFullYear();
                body="";
                body+='<div>';
                body+='<h4>'+data[i]['nombre_diplomado']+'</h4>';
                body+='<span>'+data[i]['nombre_ins']+', '+data[i]['nombre_pais']+'</span>'+'</br>';
                body+='<span><b>Modalidad:</b> '+data[i]['nombre_modalidad']+'</span>'+'</br>'+'</br>';
                body+='<p style="text-align:justify">'+data[i]['descripcion_dip']+'</p>';
                body+='<div align="right"><span>'+d1+' - '+d2+'</span></div>';
                body+='</div>';
                if(i < data.length-1){
                body+='<hr>';
                }
                html+=body;
               }

             //html+=' </tbody></table>';
             html+='</div>';
             $("#seccionDiplomados").append(html)
           }


           },
        error : function(xhr, status) {
            alert("Hubo un problema al momento de obetener los datos de Docente");

        }
        });
}

//Grupo 04
function getPostgradosDocente(idDcn){
  $.ajax({
           type:'POST',
           url:ip+'/getPostgrados',
           data:{'docente':idDcn},
           success:function(data){
            //console.log(data.length);
            if (data.length == 1 && data[0]['id_dcn_post'] == '') {
                $("#seccionPostgrados").append("<b>NO SE HAN REGISTRADO  POSTGRADOS</b>");
             }else{
              //  var html = '<table class="table table-striped"><thead><tr><th scope="col">#</th><th scope="col">Abreviatura</th><th scope="col">Nombre</th><th scope="col">Descripcion</th><th scope="col">Fecha de Inicio</th><th scope="col">Fecha de Finalización</th><th scope="col">Institución</th><th scope="col">País</th></tr></thead><tbody>';
              var html= '<div class="col-md-12">';

               for (var i = 0;i<data.length;i++) {
                body="";
                start= new Date(data[i]['fecha_inicio']);
                end= new Date(data[i]['fecha_fin']);
                body+='<div>';
                body+='<h4 style="display:inline;">'+data[i]['nombre_p_grado']+'</h4>'+'  <b>('+data[i]['abreviatura']+')</b>';
                body+='</br><span>'+data[i]['nombre_ins_post']+', '+data[i]['nombre_pais_post']+'</span>'+'</br>';
           //NO MOSTRAR LA DESCRIPCION DEL POSTGRADO
                //body+='<p style="text-align:justify">'+data[i]['descripcion_p_grado']+'</p>';
                body+='<span>'+start.getFullYear() +' - '+end.getFullYear()+'</span>';
                body+='</div>';
                if( i < data.length-1){
                body+='<hr>';
                }
                html+=body;
               }

            // html+=' </tbody></table>';
            html+='</div>';
             $("#seccionPostgrados").append(html)
             }


           },
        error : function(xhr, status) {
            alert("Hubo un problema al momento de obetener los datos de Docente");

        }
        });
}

//Grupo 04
function getRepresentacionesDocente(idDcn){
  $.ajax({
           type:'POST',
           url:ip+'/getRepresentaciones',
           data:{'docente':idDcn},
           success:function(data){
            //console.log(data.length);
            if (data.length == 1 && data[0]['id_dcn_rep'] == '') {
                $("#seccionRepresentaciones").append("<b>NO SE HAN REGISTRADO REPRESENTACIONES</b>");
             }else{
               //  var html = '<table class="table table-striped"><thead><tr><th scope="col">#</th><th scope="col">Abreviatura</th><th scope="col">Nombre</th><th scope="col">Descripcion</th><th scope="col">Fecha de Inicio</th><th scope="col">Fecha de Finalización</th><th scope="col">Institución</th><th scope="col">País</th></tr></thead><tbody>';
               var html= '<div class="col-md-12">';

               for (var i = 0;i<data.length;i++) {

              startR= new Date (data[i]['fecha_inicio_rep']);
              endR= new Date (data[i]['fecha_fin_rep']);
              dt1= monthNames[startR.getMonth()]+' '+startR.getDate()+' del '+startR.getFullYear();
              dt2= monthNames[endR.getMonth()]+' '+endR.getDate()+' del '+endR.getFullYear();
              body="";
              body+='<div>';
              body+='<h4>'+data[i]['evento_re_ues']+'</h4>';
              body+='<span>'+data[i]['nombre_ins_rep']+', '+data[i]['nombre_pais_rep']+'</span>'+'</br>';
              body+='<span><b>Tipo de Participación:</b> '+data[i]['nombre_tip_repre_rep']+'</span>'+'</br>';
              if(data[i]['mision_oficial']!=1){
              body+='<span><b>Mision Oficial:</b> NO</span>'+'</br>'+'</br>';
              }
              else
              body+='<span><b>Mision Oficial:</b> SI</span>'+'</br>'+'</br>';
              body+='<p style="text-align:justify">'+data[i]['descripcion_re_ues']+'</p>';
              body+='<div align="right"><span>'+dt1+' - '+dt2+'</span></div>';
              body+='</div>';
              if(i < data.length-1){
              body+='<hr>';
              }
              html+=body;
             }

           //html+=' </tbody></table>';
           html+='</div>';
             $("#seccionRepresentaciones").append(html)
             }


           },
        error : function(xhr, status) {
            alert("Hubo un problema al momento de obetener los datos de Docente");

        }
        });


}

function getInvestigacionesDocente(idDcn){
  $.ajax({
           type:'POST',
           url:ip+'/getInvestigaciones',
           data:{'docente':idDcn},
           success:function(data){
            //console.log(data.length);
            if (data.length == 1 && data[0]['id_dcn_inv'] == '') {
                $("#seccionInvestigaciones").append("<b>NO SE HAN REGISTRADO INVESTIGACIONES</b>");
             }else{
               //  var html = '<table class="table table-striped"><thead><tr><th scope="col">#</th><th scope="col">Abreviatura</th><th scope="col">Nombre</th><th scope="col">Descripcion</th><th scope="col">Fecha de Inicio</th><th scope="col">Fecha de Finalización</th><th scope="col">Institución</th><th scope="col">País</th></tr></thead><tbody>';
               var html= '<div class="col-md-12">';

               for (var i = 0;i<data.length;i++) {

              startR= new Date (data[i]['fecha_inicio_inv']);
              endR= new Date (data[i]['fecha_fin_inv']);
              dt1= monthNames[startR.getMonth()]+' '+startR.getDate()+' del '+startR.getFullYear();
              dt2= monthNames[endR.getMonth()]+' '+endR.getDate()+' del '+endR.getFullYear();
              body="";
              body+='<div>';
              body+='<h4>'+data[i]['tema_inv']+'</h4>';
              body+='<span>'+data[i]['nombre_ins_inv']+', '+data[i]['nombre_pais_inv']+'</span>'+'</br>';
              body+='<span><b>Tipo de Participación:</b> '+data[i]['tpoPartInv']+'</span>'+'</br>';
              if(data[i]['alumno']!=1){
              body+='<span><b>Alumno:</b> NO</span>'+'</br>';
              }
              else{
              body+='<span><b>Alumno:</b> SI</span>'+'</br>';}
              if(data[i]['publicado']!=1){
              body+='<span><b>Publicada:</b> NO</span>'+'</br>';
              }
              else {
              body+='<span><b>Publicada:</b> SI</span>'+'</br>';
              }
              body+='<span><b>Idioma:</b> </span>'+'</br>';
              body+='<span><b>Revista:</b> </span>'+'</br>';
              body+='<span><b>URL:</b> </span>'+'</br>'+'</br>';
              body+='<p style="text-align:justify">'+data[i]['descripcion_inv']+'</p>';
              body+='<div align="right"><span>'+dt1+' - '+dt2+'</span></div>';
              body+='</div>';
              if(i < data.length-1){
              body+='<hr>';
            }
              html+=body;
             }

           //html+=' </tbody></table>';
           html+='</div>';
             $("#seccionInvestigaciones").append(html)
             }


           },
        error : function(xhr, status) {
            alert("Hubo un problema al momento de obetener los datos de Docente");

        }
        });


}
const monthNames = ["Ene", "Feb", "Mar", "Abr", "May", "Jun",
                     "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
                   ];
