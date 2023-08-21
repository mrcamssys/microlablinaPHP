<?php
if (!defined('BASEPATH'))   exit('No direct script access allowed');
class Preguntas  extends CI_Model { 
    
    /*
    $this->config->item('variable'); leer variable global
    $this->config->set_item('variable', 'nuevo_valor'); modificar variable global
    */

    public function __construct(){
         parent::__construct();
    }

    public function list_preguntas_Admin($email){

        $this->db->where('correo',$email);
        $q= $this->db->get('usuarios');
        if($q->num_rows()>0){
            foreach ($q->result() as $id) {
                return $id->id_usuarios;
            }
        } 
        else return false;
    }


    public function Buscar($pin){
        $this->db->where('pin',$pin);
        $q= $this->db->get('verificador');
        if($q->num_rows()>0){
            foreach ($q->result() as $id) {
                return $id->npin;
            }
        } 
        else return false;
    }


     public function Buscarvin($pin){
        $this->db->where('coduser',$pin);
        $q= $this->db->get('usuarios');
        if($q->num_rows()>0){
            foreach ($q->result() as $id) {
                return $id->nombre;
            }
        } 
        else return false;
    }

    public function pines($pin){
        $this->db->where('coduser',$pin);
        $q= $this->db->get('usuarios');
        if($q->num_rows()>0){
            return true;
        } 
        else return false;
    }

    public function crear($pin,$npin){ 
        $data = array(
                'id_verif'=>null,
                'pin'=>$pin,
                'npin'=>$npin,
          );   
      return $this->db->insert('verificador', $data);
    }


    public function mipin($email){
        $this->db->where('correo',$email);
        $q= $this->db->get('usuarios');
        if($q->num_rows()>0){
            foreach ($q->result() as $id) {
                return $id->coduser;
            }
        } 
        else return false;
    }



    public function extraer_contenido($id){
        $this->db->where('pin',$id);
        $consulta=$this->db->get('preguntas');
        //if($consulta->num_rows()>0){
            return $consulta->result();
        //}else  null;
    }

    public function delete($id)
    {
        $this->db->delete('preguntas', array('id_pregunta' => $id));
    }

       public function delete2($id)
    {
        $this->db->delete('verificador', array('pin' => $id));
    }




    public function nuevapregunta($pin,$titulo,$url){ 
        $data = array(
                'id_pregunta'=>null,
                'fecha_pub'=>date("Y:m:d"),
                'pin'=>$pin,
                'titulo'=>$titulo,
                'id_usuario'=>'1',
                'url'=>$url
          );   
      return $this->db->insert('preguntas', $data);
    }


    public function registrousuario($correo, $nombre, $apellido, $clave1, $cargo,$institucion ){ 
        $data = array(
                'correo'=>$correo,
                'nombre'=>$nombre,
                'apellido'=>$apellido,
                'clave'=>md5($clave1),
                'recordatorio'=>'',
                'id_cargo'=>$cargo,
                'institucion'=>$institucion
          );   
      return $this->db->insert('usuarios', $data);
    }

    public function Actualizar($correo, $nombre, $apellido, $clave1, $cargo,$institucion ){ 
        $data = array(
                'correo'=>$correo,
                'nombre'=>$nombre,
                'apellido'=>$apellido,
                'clave'=>md5($clave1),
                'recordatorio'=>'',
                'id_cargo'=>$cargo,
                'institucion'=>$institucion
          );   
      return $this->db->update('usuarios', $data);
    }
}
