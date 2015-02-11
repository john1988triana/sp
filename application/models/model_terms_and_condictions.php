<?php

/* title: model_my_contents
 * Modelo de contenidos, pagina principal donde se carga loguea, registra y se muestran todos los contenidos.
 *
 * Author: Yeisson Ibarra - yeissonibarra@gmail.com
 * Date Update: 23 Sept 2013*/

if (!defined('BASEPATH'))
    exit('No hay acceso directo al script permite');



class Model_Terms_And_Condictions extends CI_Model {
    /* Variable: db_am3
     * Conexion a la base de datos amigas, de tipo Objecto.*/
    private $db_am3;


    /* function: __construct
     * Inicializar base de datos. */
    function __construct() {
        parent::__construct();

        /* Inicializar Objecto base de datos de AM3. */
        $this->db_am3 = $this->load->database('am3', TRUE);
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
        try {
            $info_terms = $this->_get_info_terms();
            $info_agreements = $this->_get_info_agreements();

            if(!empty($info_terms) AND !empty($info_agreements)) {
                $array_terms_and_condictions = array(
                    'terms' => $info_terms,
                    'agreements' => $info_agreements
                );

                return $array_terms_and_condictions;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }



    /* --------------------------------------------- Funciones Privadas --------------------------------------------------- */



    /* function: _get_info_terms
     * Listar informacion de los terminos.
     *
     * parameter:
     *      $id_term - Integer id de los terminos.
     *
     * return:
     *      $result - Array
     *      FALSE - Boolean
     */
    private function _get_info_terms() {
        try {
            $this->db_am3->select_max('Id');
            $id_term = $this->db_am3->get('termsandconditions');

            if($id_term->num_rows() > 0) {
                $id_term = $id_term->result();

                $this->db_am3->where('Id', $id_term[0]->Id);
                $result = $this->db_am3->get('termsandconditions');

                if($result->num_rows() > 0) {
                    return $result->result();
                } else {
                    return FALSE;
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    /* function: _get_info_agreements
     * Listar informacion de las condiciones.
     *
     * parameter:
     *      void.
     *
     * return:
     *      $result - Array informacion de las condiciones: Id, Text - Url.
     *      FALSE - Boolean ah ocurrido un error.
     */
    private function _get_info_agreements() {
        try {
            $this->db_am3->select_max('Id');
            $id_agreement = $this->db_am3->get('useragreements');

            if($id_agreement->num_rows() > 0) {
                $id_agreement = $id_agreement->result();

                $this->db_am3->where('Id', $id_agreement[0]->Id);
                $result = $this->db_am3->get('useragreements');

                if($result->num_rows() > 0) {
                    return $result->result();
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
           echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

}
