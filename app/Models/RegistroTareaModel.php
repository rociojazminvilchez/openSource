<?php 
namespace App\Models;
use CodeIgniter\Model;

class RegistroTareaModel extends Model{ 
   protected $table = 'registro_tarea'; 
   protected $primaryKey = 'id';
   protected $useAutoIncrement = false; 
   protected $returnType = 'array';
   protected $useSoftDeletes = false; 
   protected $allowedFields = ['id','correo','colaborador','tema','descripcion','prioridad','estado','estado_actualizado','fecha_vencimiento','fecha_recordatorio'];
   
#MOSTRAR  
   public function mostrarTarea($data){
    $Usuario = $this->db->table('registro_tarea');
    if (isset($data['correo'])) {
         $Usuario->groupStart() 
                ->where('correo', $data['correo'])
                ->orWhere('colaborador', $data['correo'])
                ->groupEnd(); 
    }
  
    if (isset($data['ordenar']) && in_array($data['ordenar'], ['fecha_vencimiento', 'prioridad', 'estado'])) {
        $Usuario->orderBy($data['ordenar'], 'ASC');
    }
    return $Usuario->get()->getResultArray();
    }

    public function mostrarTareaID($data){
    $Usuario = $this->db->table('registro_tarea');
    if (isset($data['id'])) {
        $Usuario->where('id', $data['id']);
    }
    return $Usuario->get()->getResultArray();
    }

    public function seleccionarTarea($data){
    $Usuario = $this->db->table('registro_tarea');
    if (isset($data['correo'])) {
        $Usuario->where([
            'correo' => $data['correo'],
            'estado !=' => 'Completada'
        ]);
    }
    // Solo muestra tareas cuya fecha de vencimiento sea mayor o igual al día actual
    $Usuario->where('fecha_vencimiento >=', date('Y-m-d'));
    return $Usuario->get()->getResultArray();
   }
}
?>