<?php 
namespace App\Models;
use CodeIgniter\Model;

class IngresoModel extends Model{ 
   protected $table = 'ingreso'; 
   protected $primaryKey = 'id';
   protected $useAutoIncrement = false; 
   protected $returnType = 'array';
   protected $useSoftDeletes = false; 
   protected $allowedFields = ['correo','contraseña']; 

    public function obtenerUsuario($data){
         $Usuario = $this->db->table('registro_usuario');
			$Usuario->where($data);
			return $Usuario->get()->getResultArray();
   }

}
?>