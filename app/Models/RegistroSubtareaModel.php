<?php 
namespace App\Models;
use CodeIgniter\Model;

class RegistroSubtareaModel extends Model{ 
   protected $table = 'registro_subtarea'; 
   protected $primaryKey = 'id';
   protected $useAutoIncrement = false; 
   protected $returnType = 'array';
   protected $useSoftDeletes = false; 
   protected $allowedFields = ['id','tarea','descripcion','estado','estado_actualizado','prioridad','fecha_vencimiento','comentario','responsable'];

   public function mostrarSubtarea($data){
         $Usuario = $this->db->table('registro_subtarea');
			if (isset($data['responsable'])) {
            $Usuario->where('responsable', $data['responsable']);
        }
        if (isset($data['ordenar']) && in_array($data['ordenar'], ['fecha_vencimiento', 'prioridad', 'estado'])) {
            $Usuario->orderBy($data['ordenar'], 'ASC');
        }
			return $Usuario->get()->getResultArray();
   }

   public function mostrarSubtareaID($data){
    $Usuario = $this->db->table('registro_subtarea');
    if (isset($data['responsable'])) {
        $Usuario->where('responsable', $data['responsable']);
        $Usuario->where('tarea', $data['tarea']);
    }
 return $Usuario->get()->getResultArray();
}
}
?>