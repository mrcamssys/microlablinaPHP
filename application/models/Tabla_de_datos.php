<?php
if (!defined('BASEPATH'))   exit('No direct script access allowed');
class Tabla_de_datos  extends CI_Model { 
    
    /*
    $this->config->item('variable'); leer variable global
    $this->config->set_item('variable', 'nuevo_valor'); modificar variable global
    */


    public function __construct(){
         parent::__construct();
    }

    
    public function logr($user, $pass){
     	$this->db->where('correo',$user);
    	$this->db->where('clave',$pass);
    	$q= $this->db->get('usuarios');
    	if($q->num_rows()>0){
            return true;
        } 
    	else return false;
    }

    public function extraer_nombreuser(){
        
        $this->db->where('correo',$this->session->email);
        $consulta=$this->db->get('usuarios');
        if($consulta->num_rows()>0){
            $texto="";
            foreach ($consulta->result() as $id) {
                $texto=$texto.$id->nombre;
            }

            return $texto;
        }else  null;
    }

    public function verificar_usuario($usuariox){
        $this->db->where('correo',$usuariox);
        $consulta=$this->db->get('usuarios');
        if($consulta->num_rows()>0){
            //$texto="";
            //foreach ($consulta->result() as $id) {
            //    $texto=$texto.$id->nombre;
            //}

            //return $texto;
            return 1;
        }else
        return 0;
    }

    public function registrousuario($correo, $nombre, $apellido, $clave1, $cargo,$institucion ){ 
        $data = array(
                'correo'=>$correo,
                'nombre'=>$nombre,
                'apellido'=>$apellido,
                'clave'=>md5($clave1),
                'recordatorio'=>'',
                'id_cargo'=>$cargo,
                'institucion'=>$institucion,
                'coduser'=>date('ymdHis')
          );   
      return $this->db->insert('usuarios', $data);
    }
}