<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RepListadoAseTribuEva_gc extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $id_cargo_administrativo = $this->session->userdata('id_cargo_administrativo');
        if($id_cargo_administrativo=='4' or $id_cargo_administrativo == '1'){
            $this->load->database();
            $this->load->helper('url');
            $this->load->model('PDG/RepListadoAseTribuEva_gc_model');
            $this->load->library('grocery_CRUD');
        }
        else{
            redirect('Login');
        }
    }
    public function _RepListadoAseTribuEva_gc_output($output = null)
    {

        $data['output'] = $output;
        $data['contenido']='PDG/FormRepListadoAseTribuEva_gc';
        $this->load->view('templates/content',$data);
                      
    }

    public function index()
    {

            $crud = new grocery_CRUD();
            $crud->set_table('rep_listado_docen_ase_tribu_eva_pdg');
            $crud->set_primary_key('id_equipo_tg'); 
            $crud->order_by('id_equipo_tg');
            $crud->set_language('spanish');
            $crud->set_subject('Listado de Asesores y Tribunal Evaluador de TG');
            //Definiendo las columnas que apareceran
            $crud->columns('id_equipo_tg','anio_tg','NombreApellidoAlumno','id_due','tema_tesis','NombreApellidoDocente','NombreApellidoTribuEva');
            //Cambiando nombre a los labels de los campos
            $crud->display_as('id_equipo_tg','Equipo TG')
                 ->display_as('anio_tg','Año TG')
                 ->display_as('id_due','DUE')
                 ->display_as('tema','Tema')
                 ->display_as('NombreApellidoDocente','Docente Asesor')
                 ->display_as('NombreApellidoTribuEva','Docente Tribunal Evaluador');
                
            $output = $crud->unset_add();
            $output = $crud->unset_edit();
            $output = $crud->unset_delete();
            $output = $crud->unset_read();
            $output = $crud->render();
            $this->_RepListadoAseTribuEva_gc_output($output);
    }


}