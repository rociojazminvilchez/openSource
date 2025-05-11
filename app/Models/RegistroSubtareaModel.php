<?php 
namespace App\Models;
use CodeIgniter\Model;

class RegistroSubtareaModel extends Model{ 
   protected $table = 'registro_subtarea'; 
   protected $primaryKey = 'id';
   protected $useAutoIncrement = false; 
   protected $returnType = 'array';
   protected $useSoftDeletes = false; 
   protected $allowedFields = ['id','tarea','descripcion','estado','estado_actualizado','prioridad','fecha_vencimiento','comentario','responsable','colaborador'];

#MOSTRAR
   public function mostrarSubtarea($data){
    $Usuario = $this->db->table('registro_subtarea');
	if (isset($data['responsable'])) {
        $Usuario->groupStart() 
        ->where('responsable', $data['responsable'])
        ->orWhere("FIND_IN_SET('" . $data['responsable'] . "', colaborador) >", 0)
        ->groupEnd();    
    }

    if (isset($data['ordenar']) && in_array($data['ordenar'], ['fecha_vencimiento', 'prioridad', 'estado'])) {
        $Usuario->orderBy($data['ordenar'], 'ASC');
    }
	return $Usuario->get()->getResultArray();
   }

   public function mostrarSubtareaID($data){
    $Usuario = $this->db->table('registro_subtarea');
    if (isset($data['tarea'])) {
        $Usuario->where('tarea', $data['tarea']);
    }
    return $Usuario->get()->getResultArray();
   }

#MODIFICAR
    public function mostrarSubtareaID2($data){
        $Usuario = $this->db->table('registro_subtarea');
    if (isset($data['id'])) {
        $Usuario->where('id', $data['id']);
    }
    return $Usuario->get()->getResultArray();
    }
}
?>