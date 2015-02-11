<?php

/* title: model_my_contents
 * Modelo de contenidos, pagina principal donde se carga loguea, registra y se muestran todos los contenidos.
 *
 * Author: Yeisson Ibarra - yeissonibarra@gmail.com
 * Date Update: 23 Sept 2013*/

if (!defined('BASEPATH'))
    exit('No hay acceso directo al script permite');



class model_process_login
 extends CI_Model {
    /* Variable: db_am3
     * Conexion a la base de datos amigas, de tipo Objecto.*/
    private $db_super_pro;


    /* function: __construct
     * Inicializar base de datos. */
    function __construct() {
        parent::__construct();

        /* Inicializar Objecto base de datos de AM3. */
        $this->db_super_pro = $this->load->database('superpro', TRUE);
    }


    /* function: index
     * void.
     *
     * parameters:
     *      void.
     * return:
     *      void.
     */
    public function index() {}
    

    /* function: get_terms_and_agreements
     * Listar y agrupar los terminos y condiciones mas actuales.
     *
     * parameters:
     *      void.
     *
     * return:
     *      $array_terms_and_condictions - Array terms - Terminos y agreements - Condiciones.
     *      FALSE - Boolean ah ocurrido un error.
     */
    public function get_terms_and_agreements() {
        
    }

    /* function: set_progress_login_registro
     * Verifica si el usuario es nuevo para super profe y lo almacena en la base de datos de super profe.
     *
     * parameters:
     *      void.
     *
     * return:
     *      $array -Array con el contenido de la tabla perfiles del usuario en superprofe.
     */
    public function set_progress_login_registro() {
   		
   		$this->db_super_pro->select('*');
        $this->db_super_pro->from('tbl_perfiles_usuarios');        
        $this->db_super_pro->where('id_usuario', $this->session->userdata('sIdUser'));        
         
        $result = $this->db_super_pro->get();
         
         if ($result->num_rows() == 0) {
             
             $data = array(
					               'id_usuario' => $this->session->userdata('sIdUser'),
					               'paso_registro' => '2',
					               'verificar_cuenta' => '0'
					               );

            $this->db_super_pro->insert('tbl_perfiles_usuarios', $data);  
            
            return $data;      
         
         }else{
         	
         	$result = json_encode($result->result());
         	$result = json_decode($result, true);
         	
         	$data = array(
     							   'id_usuario' => $result[0]['id_usuario'],
				                   'paso_registro' => $result[0]['paso_registro'],
				                   'verificar_cuenta' => $result[0]['paso_registro']
         						   );
	         
	         return $data;
         }
    }
    
    /* function: set_progress_login_registro
     * Verifica si el usuario es nuevo para super profe y lo almacena en la base de datos de super profe.
     *
     * parameters:
     *      void.
     *
     * return:
     *      $array -Array con el contenido de la tabla perfiles del usuario en superprofe.
     */
    public function set_progress_login_data_user() {
   		
   		$this->db_super_pro->select('*');
        $this->db_super_pro->from('professor');        
        $this->db_super_pro->where('id_user', $this->session->userdata('sIdUser'));        
         
        $result = $this->db_super_pro->get();
         
         if ($result->num_rows() > 0) {
         
         	$data_insert = array(
					   'status' => '1',
					   'linkedin' => $this->input->post('cpprofileLinkedin'),
					   );

            $this->db_super_pro->where('id_user', $this->session->userdata('sIdUser'));
            $this->db_super_pro->update('professor', $data_insert);   
             
            $result = json_encode($result->result());
         	$result = json_decode($result, true);
         	
         	$data = array(
					   'id_user' => $result[0]['id_user'],
					   'status' => '1',
					   'verificar_cuenta' => $result[0]['paso_registro']
					   );
	         
	         return $data;     
         
         }else{
	         return FALSE;
         }
    }


}
