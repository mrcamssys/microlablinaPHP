<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');
class Mrcamssys404 extends CI_Controller { 
   public function index(){
      echo 'Error 404. Usted está intentando acceder a una página que no existe.';
   }
}