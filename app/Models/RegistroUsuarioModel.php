<?php 
namespace App\Models;
use CodeIgniter\Model;

class RegistroUsuarioModel extends Model{ 
   protected $table = 'registro_usuario'; 
   protected $primaryKey = 'correo';
   protected $useAutoIncrement = false; 
   protected $returnType = 'array';
   protected $useSoftDeletes = false; 
   protected $allowedFields = ['correo','nombre','apellido','contra','contra2'];

   public function obtenerUsuario($data){
      $Usuario = $this->db->table('registro_usuario');
		$Usuario->where($data);
		return $Usuario->get()->getResultArray();
   }
}
?>