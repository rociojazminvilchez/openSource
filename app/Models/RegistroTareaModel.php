<?php 
namespace App\Models;
use CodeIgniter\Model;

class RegistroTareaModel extends Model{ 
   protected $table = 'registro_tarea'; 
   protected $primaryKey = 'id';
   protected $useAutoIncrement = false; 
   protected $returnType = 'array';
   protected $useSoftDeletes = false; 
   protected $allowedFields = ['id','correo','tema','descripcion','prioridad','estado','estado_actualizado','fecha_vencimiento','fecha_recordatorio','color'];
   
   
   public function mostrarTarea($data){
      $Usuario = $this->db->table('registro_tarea');
  
      if (isset($data['correo'])) {
          $Usuario->where('correo', $data['correo']);
      }
  
      if (isset($data['ordenar']) && in_array($data['ordenar'], ['fecha_vencimiento', 'prioridad', 'estado'])) {
          $Usuario->orderBy($data['ordenar'], 'ASC');
      }
  
      return $Usuario->get()->getResultArray();
  }
  
}
?>