<?php 
namespace App\Models;
use CodeIgniter\Model;

class RegistroTareaModel extends Model{ 
   protected $table = 'registro_tarea'; 
   protected $primaryKey = 'id';
   protected $useAutoIncrement = false; 
   protected $returnType = 'array';
   protected $useSoftDeletes = false; 
   protected $allowedFields = ['tema','descripcion','prioridad','estado','fecha_vencimiento','fecha_recordatorio','color'];

   public function obtenerUsuario($data){
         $Usuario = $this->db->table('registro_tarea');
			$Usuario->where($data);
			return $Usuario->get()->getResultArray();
   }
}
?>