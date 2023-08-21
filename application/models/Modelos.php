<?php
if (!defined('BASEPATH'))   exit('No direct script access allowed');
class Modelos  extends CI_Model { 
    
    /*
    $this->config->item('variable'); leer variable global
    $this->config->set_item('variable', 'nuevo_valor'); modificar variable global
    */


    public function __construct(){
         parent::__construct();
    }


    private function decomponer($datox){
        $DatFilas=null;
        if(!empty($datox)){
            $rest=$datox;
            $rest = str_replace(';', ',', $rest);
            $error=0;
            do{
                $rest=trim($rest);
                $dato=substr($rest, -1);
                if($dato==","){
                    $rest = trim($rest,",");
                    $error=1;
                }else{
                    $error=0;
                }
            }while ($error != 0);
            $DatFilas  = explode(",", $rest); //crea una matriz del pilinomio de polos
            $eliminador=array();
            foreach($DatFilas as $element) {
                    $eliminador[]=str_replace(' ', '', $element);
            }

            $DatFilas=$eliminador;
        }else{
            $DatFilas=$datox;
        }

        return $DatFilas;
    }


    private function potencia($datox){
        $DatFilas=null;
        if(!empty($datox)){
            $rest=$datox;
            //$rest = str_replace(' ', '', $rest);
            $error=0;
            do{
                $rest=trim($rest);
                $dato=substr($rest, -1);

                if($dato=="^"){
                    $rest = trim($rest,"^");
                    $error=1;
                }else{
                    $error=0;
                }
            }while ($error != 0);
            $DatFilas  = explode(",", $rest); //crea una matriz del pilinomio de polos
            //$tamano=count((array)$DatFilas);
            $eliminador=array();
            foreach($DatFilas as $element) {
                //if(is_numeric($element)) {
                    $eliminador[]=str_replace(' ', '', $element);
                //}
            }

            $DatFilas="Math.pow(".$eliminador[0].", ".$eliminador[1].");";
        }else{
            //echo '<script type="text/javascript">alert("uno de los cambos esta vacio");</script>';
            $DatFilas=$datox;
        }

        return $DatFilas;
        //echo count($DatFilas) ;Math.pow(base, exponente)
    }


    public function extraer_nombremodelo($id){
        $this->db->where('id_planta',$id);
        $consulta=$this->db->get('modelos_laplace');
        if($consulta->num_rows()>0){
            $texto="";
            foreach ($consulta->result() as $id) {
                $texto=$texto.$id->nombre;
            }

            return $texto;
        }else  null;
    }


    public function listar_modelos($id=0){
        $this->db->where('puedever',$id);
        $consulta=$this->db->get('modelos_laplace');
        if($consulta->num_rows()>0){
            return $consulta->result();
        }else  null;
    }

    private function compactar($matriz,$var="ka",$texbox="numerador"){
        $texto="\t\n";
        $texto2="\t\n ".$var."= ''+";
        $separador="";
        if(!is_array($matriz)){
            $texto=$texto.(String)$matriz;
        }else{
            for($i=0; $i<count((array)$matriz); $i++){
                $texto=$texto.$var.$i." = parseFloat(".$matriz[$i].").toFixed(4);"."\t\n";
                
                if($i==(count((array)$matriz)-1))  $texto2=$texto2.$var.$i.";"."\t\n";
                else  $texto2=$texto2.$var.$i."+', '+";

            } 
        }
        
        $texto2=$texto2.$texbox.".value=".$var.";\t\n";

        return $texto.$texto2;
    }

    public function extraer_TFmodelo($id){
        $this->db->where('id_planta',$id);
        $consulta=$this->db->get('modelos_laplace');
        if($consulta->num_rows()>0){
            $texto="";
            foreach ($consulta->result() as $id) {
                $a=$id->numerador;
                $b=$id->denominador;
            }

            $a=$this->compactar($this->decomponer($a),"Ma",'ceros1');
            $b=$this->compactar($this->decomponer($b),"ka",'polos1');

            return array($a,$b);
        }else  null;
    }

    public function extraer_listavariables($id){
        $this->db->where('id_modelos',$id);
        //$this->db->where('id_modelos',$id);
        $consulta=$this->db->get('variablestf');
        if($consulta->num_rows()>0){
            $texto="";
            $script="\n\t";

            foreach ($consulta->result() as $id) {
                $dato=$this->input->post($id->variable);
                if($dato==null) $cams=$id->pinicial;
                else $cams=$dato;

                $texto=$texto.'

                <label class="font-weight-bold text-primary small small">'.$id->descrip.'  [<span  id="'.$id->variable.'_data">'.$id->pinicial.'</span>]</label><br>    
                <input type="range" class="custom-range" id="'.$id->variable.'" name="'.$id->variable.'" value="'.$cams.'" onchange="barra(this);" onmousedown="barra(this);" step="0.0001" min="'.$id->minimo.'" max="'.$id->maximo.'" />

                ';
                $script=$script.$id->variable." = parseFloat(document.getElementById('".$id->variable."').value);\n\t";

            }

            return array($texto,$script);
        }else  null;
    }

    public function extraer_contenido($id){
        $this->db->where('id_planta',$id);
        $consulta=$this->db->get('modelos_laplace');
        if($consulta->num_rows()>0){
            $texto="";
            foreach ($consulta->result() as $id) {
                $texto=$texto.$id->descrip;
            }

            return $texto;
        }else  null;
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
