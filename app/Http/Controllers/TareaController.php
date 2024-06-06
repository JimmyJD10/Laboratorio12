<?php
namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function index(Request $request)
    {
        $query = Tarea::query();

        if ($request->has('descripcion') && !empty($request->input('descripcion'))) {
            $query->where('descripcion', 'like', '%' . $request->input('descripcion') . '%');
        }

        if ($request->has('categoria_id') && !empty($request->input('categoria_id'))) {
            $query->where('categoria_id', $request->input('categoria_id'));
        }

        if ($request->has('completada') && !is_null($request->input('completada'))) {
            $query->where('completada', $request->input('completada'));
        }

        $tareas = $query->where('user_id', Auth::id())->paginate(5); //aqui añadimos la paginacion 
                                                                     //en este caso le puse 5
        $categorias = Categoria::all();

        return view('tareas.index', compact('tareas', 'categorias'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);
        Auth::user()->tareas()->create($request->all());
        return redirect()->route('tareas.index');
    }

    public function edit(Tarea $tarea)
    {
        $categorias = Categoria::all();
        return view('tareas.edit', compact('tarea', 'categorias'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'descripcion' => 'required',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $tarea->update($request->all());
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada con éxito.');
    }

    public function toggle(Tarea $tarea)
{
    // Con esto se Verifica que el usuario es el propietario de la tarea
    if ($tarea->user_id !== Auth::id()) {
        return redirect()->route('tareas.index')->with('error', 'No tienes permiso para realizar esta acción.');
    }

    // Con esto Aactualizamos el estado de la tarea
    $tarea->completada = !$tarea->completada;
    $tarea->save();

    return redirect()->route('tareas.index')->with('success', 'El estado de la tarea ha sido actualizado.');
}


    public function obtenerTareasPorPrioridad($prioridad)
    {
        $tareas = Tarea::where('prioridad', $prioridad)->get();
        return view('tareas.prioridad', compact('tareas', 'prioridad'));
    }

    public function contarTareasCompletadasPorUsuario($usuario_id)
    {
        $conteoTareasCompletadas = Tarea::where('usuario_id', $usuario_id)->where('completada', true)->count();
        return view('tareas.conteo', compact('conteoTareasCompletadas', 'usuario_id'));
    }
    

}
