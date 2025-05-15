# Sistema de Gestión de Tareas y Subtareas - OpenSource

## Inicio
- Breve descripción de lo que puede realizar el sistema.
- Muestra las **alertas** de tareas y subtareas (solo si se inició sesión).

##  Panel Principal
- Se muestran **todas las tareas activas**, excluyendo las archivadas y eliminadas (estas se visualizan desde el historial).
- Incluye **alertas visuales** para tareas y subtareas según prioridad o fechas clave:

  | Color     | Significado                                              |
  |-----------|-----------------------------------------------------------|
  | 🟧 Naranja | Tareas vencidas (se marcan automáticamente).             |
  | 🔴 Rojo    | Prioridad alta o cuando faltan 3 días para el vencimiento.|
  | 🔵 Celeste | Fecha del recordatorio asignado.                         |
  | 🟡 Amarillo| Prioridad normal.                                        |
  | 🟢 Verde   | Prioridad baja.                                          |

## Formulario de Subtareas
- Solo permite crear subtareas asociadas a tareas **activas** (no completadas, archivadas ni vencidas).
- **Los colaboradores no pueden crear subtareas** de las tareas en las que fueron invitados.

##  Historial de Tareas
- Muestra todas las tareas: propias y en las que se colaboró.
- Permite **editar tareas ARCHIVADAS o VENCIDAS** (solo si sos la persona que la creó).
- Permite ordenarlas por:
  - Fecha de vencimiento.
  - Estado: `Definido`, `En proceso`, `Completada`.
- Muestra solo las alertas de las tareas.

## 🗂️ Historial de Subtareas
- Muestra todas las subtareas: propias y en las que se colaboró.
- Permite ordenarlas por:
  - Fecha de vencimiento.
  - Estado: `Definido`, `En proceso`, `Completada`.
  - Prioridad: `Baja`, `Normal`, `Alta`.
- Muestra solo las alertas de las subtareas.
