<?php 
namespace App\Models;
use CodeIgniter\Model;

class RegistroUsuarioModel extends Model{ 
   protected $table = 'usuario'; 
   protected $primaryKey = 'correo';
   protected $useAutoIncrement = false; 
   protected $returnType = 'array';
   protected $useSoftDeletes = false; 
   protected $allowedFields = ['nombre','apellido','contra','contra2'];
/*
   public function obtenerUsuario($data){
         $Usuario = $this->db->table('registrousuario');
			$Usuario->where($data);
			return $Usuario->get()->getResultArray();
   }

   public function obtenerInstructor($data){
      $Usuario = $this->db->table('registroinstructor');
      $Usuario->where($data);
      return $Usuario->get()->getResultArray();
}*/
}
?>