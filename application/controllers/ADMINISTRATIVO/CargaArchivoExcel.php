<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CargaArchivoExcel extends CI_Controller{

function __construct(){
    parent::__construct();
    $id_cargo_administrativo = $this->session->userdata('id_cargo_administrativo');

    if($id_cargo_administrativo=='3' or $id_cargo_administrativo=='4'){
    	$this->load->helper(array('form', 'url'));
        //load the excel library
        $this->load->library('excel');
        $this->load->library('email');
        //$this->removeCache();
        $this->load->model('ADMINISTRATIVO/CargaArchivoExcel_model');
    }
    else{
        redirect('home');
    }
}

public function index($mensaje = null){
    
    
        $data['mensaje'] = $mensaje;
        $data['output'] = null;
        $data['contenido']= 'ADMINISTRATIVO/FormCargaArchivoExcel';
        $this->load->view('templates/content',$data);


 //   $this->load->view('FormCargaArchivoExcel', array('error' => ' ' ));
}

public function CargaArchivo(){
    //SE CREARÁ UN ARCHIVO CON NOMBRE ALEATORIO 
    //DEBIDO AL CASO QUE SE PUEDEN CARGAS 2 ARCHIVOS SIMULTANEAMENTE POR 2 USUARIOS DIFERENTES
    $url_activacion= BASE_URL;
    $nombrearchivo = uniqid();
    $config['upload_path']          = './files/';
    $config['file_name']			= $nombrearchivo;//'test';
    $config['overwrite']			= true;
    $config['allowed_types']        = 'xls|xlsx';
    // $config['max_size']             = 100;
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('userfile')){
            $error = $this->upload->display_errors();
            $this->index($error);
    }
    else{
        
        $file = './files/'.$nombrearchivo.'.xlsx';
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        //get only the Cell Collection
        //echo($objPHPExcel->canRead());

        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            //columna
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            //fila
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            //valor
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

            $arr_data[$row][$column] = $data_value;

            //header will/should be in row 1 only. of course this can be modified to suit your need.
            //if ($row == 1) {
                //$header[$row][$column] = $data_value;
            //} else {
            //}
        }
        //send the data in an array format
        //$data['header'] = $header;
        $data = $arr_data;
        //echo(json_encode($data));

        //CONTADORES
        $cuenta_PDG = 0;
        $cuenta_PSS = 0;
        $mensaje_email = '';
        foreach($data as $row) {
            //SI LLEVA TODOS LOS DATOS SE INCLUYE, SINO SE PASA DE LARGO
            if(!empty($row['A']) and !empty($row['B']) and !empty($row['C']) and !empty($row['D']) and !empty($row['E']) and !empty($row['F']) ){
                    $enviar['id_due'] = substr($row['A'],0,7);
                    $enviar['apellido'] = substr($row['B'],0,25);
                    $enviar['nombre'] = substr($row['C'],0,30);
                    $enviar['email'] = substr($row['F'],0,50);

                    if($row['E']>=60){
                        //PROCESO DE SERVICIO SOCIAL
                        $email = $enviar['email'];
                        //echo("SERVICIO SOCIAL");
                        $verificar_PSS = $this->CargaArchivoExcel_model->InsertarEstudiantePSS($enviar);

                        switch($verificar_PSS['RETORNA']){
                            //CASO 2 ES SOLAMENTE QUE SE ASIGNÓ UN NUEVO ROL DEL USUARIO AUNQUE NO SE CREO EL USUARIO DESDE CERO
                            case 2:
                                $cuenta_PSS++;
                                $mensaje_email = 'Se ha asignado su Usuario para el Proceso de Servicio Social. PD: Es responsabilidad del estudiante comunicar al Coordinador/a de Servicio Social cuando se finalice el Servicio Social.'
                                .$url_activacion;
                            break;
                            //CASO 3 ES QUE SE CREO USUARIO Y ESTUDIANTE Y SE ASIGNO OTRO PROCESO
                            case 3:
                                $cuenta_PSS++;
                                $mensaje_email = 'Se ha creado su usuario para Proceso de Servicio Social, sus credenciales son Usuario: '.$enviar['id_due'].', Password: '.$enviar['id_due'].'. favor de seguir el siguiente link, si no puedes hacer click, favor de copiar y pegarlo en la barra de direcciones de tu navegador. PD: Es responsabilidad del estudiante comunicar al Coordinador/a de Servicio Social cuando se finalice el Servicio Social.'
                                    .$url_activacion;
                            break;
                        }//switch
                        
                        //////////////$url_activacion = BASE_URL;
                        $this->email->from('sigpa.fia.ues@gmail.com','Sistema Informático para el Control de Procesos Académicos-Administrativos UES');
                        $this->email->to($email);
                        $this->email->subject('Notificación: Creación de Usuario de Proceso de Servicio Social');
                        $this->email->message($mensaje_email);
                        $this->email->send();
                        
                        //LA FILA E TIENE EL PORCENTAJE DE AVANCE DE LA CARRERA

                        if($row['E']>=100){
                            //PROCESO DE GRADUACION
                            //echo($email);
                            //echo("PDG");
                            $verificar_PDG = $this->CargaArchivoExcel_model->InsertarEstudiantePDG($enviar);
                                
                            switch($verificar_PDG['RETORNA']){
                                case 2:
                                    $cuenta_PDG++;
                                    $mensaje_email = 'Se ha asignado su Usuario para el Proceso de Graduación. '
                                    .$url_activacion;
                                break;
                                case 3:
                                    $cuenta_PDG++;
                                    $mensaje_email = 'Se ha creado su usuario para Proceso de Graduación, sus credenciales son Usuario: '.$enviar['id_due'].', Password: '.$enviar['id_due'].'. favor de seguir el siguiente link, si no puedes hacer click, favor de copiar y pegarlo en la barra de direcciones de tu navegador. '
                                        .$url_activacion;
                                break;
                            }//switch
                            
                            //////////////$url_activacion = BASE_URL;
                            $this->email->from('sigpa.fia.ues@gmail.com','Sistema Informático para el Control de Procesos Académicos-Administrativos UES');
                            $this->email->to($email);
                            $this->email->subject('Notificación: Creación de Usuario de Proceso de Graduación');
                            $this->email->message($mensaje_email);
                            $this->email->send();

                        }
                    }

            }


        }
        $mensaje = "RESULTADO: Alumnos insertados a Servicio Social ".$cuenta_PSS.", Alumnos insertados a Proceso de Graduacion ".$cuenta_PDG;
        $this->index($mensaje);

                
    }

}










	public function LeeExcel(){

		
	$file = './files/test.xlsx';

		//load the excel library
$this->load->library('excel');



//read file from path
$objPHPExcel = PHPExcel_IOFactory::load($file);
//get only the Cell Collection
//echo($objPHPExcel->canRead());

$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
//extract to a PHP readable array format
foreach ($cell_collection as $cell) {
    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
    //header will/should be in row 1 only. of course this can be modified to suit your need.
    if ($row == 1) {
        $header[$row][$column] = $data_value;
    } else {
        $arr_data[$row][$column] = $data_value;
    }
}
//send the data in an array format
//$data['header'] = $header;
$data['values'] = $arr_data;
	echo(json_encode($data));
	}

}