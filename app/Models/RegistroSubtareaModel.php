<?php 
namespace App\Models;
use CodeIgniter\Model;

class RegistroSubtareaModel extends Model{ 
   protected $table = 'registro_subtarea'; 
   protected $primaryKey = 'id';
   protected $useAutoIncrement = false; 
   protected $returnType = 'array';
   protected $useSoftDeletes = false; 
   protected $allowedFields = ['id','descripcion','estado','prioridad','fecha_vencimiento','comentario','responsable'];

   public function mostrarSubtarea($data){
         $Usuario = $this->db->table('registro_subtarea');
			$Usuario->where($data);
			return $Usuario->get()->getResultArray();
   }
}
?>