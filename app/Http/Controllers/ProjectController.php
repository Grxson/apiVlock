<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index($service_id = 0){
        try {

            /**
             * The attribute $service_id should only used when you want to 
             * get the projects that bellow to an specific service.
             */
            if($service_id){
                $service = Service::find($service_id);
                $projects = $service->projects;
            }else{
                $projects = Project::all();
            }

            if ($projects->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontraron proyectos.',
                    'data' => [],
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Proyectos recuperados exitosamente.',
                'data' => $projects,
            ], 200); 
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error recuperando proyectos.',
                'error' => $e->getMessage(),
            ], 500); 
        } 
    }

    public function show($id){
        try{
            $project = Project::find($id);

            if ($project->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el proyecto.',
                    'data' => [],
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Proyecto recuperado exitosamente.',
                'data' => $project,
            ], 200); 
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error recuperando proyecto',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request){
        try {
             $validated = $request->validate([
                 'name' => 'required|string|max:255',
                 'description' => 'required|string',
                 'year' => 'required|integer',
                 'image_1' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                 'image_2' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                 'image_3' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
                 'image_4' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
                 'image_5' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
             ], [
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser una cadena de texto.',
                'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            
                'description.required' => 'La descripción es obligatoria.',
                'description.string' => 'La descripción debe ser una cadena de texto.',

                'year.required' => 'El año es obligatorio.',
                'year.integer' => 'El año debe ser un número entero.',
            
                'image_1.required' => 'La primera imagen es obligatoria.',
                'image_1.image' => 'La primera imagen debe ser un archivo de imagen.',
                'image_1.mimes' => 'La primera imagen debe ser de tipo: jpeg, png, jpg o svg.',
                'image_1.max' => 'La primera imagen no debe pesar más de 2MB.',
            
                'image_2.required' => 'La segunda imagen es obligatoria.',
                'image_2.image' => 'La segunda imagen debe ser un archivo de imagen.',
                'image_2.mimes' => 'La segunda imagen debe ser de tipo: jpeg, png, jpg o svg.',
                'image_2.max' => 'La segunda imagen no debe pesar más de 2MB.',
            
                'image_3.image' => 'La tercera imagen debe ser un archivo de imagen.',
                'image_3.mimes' => 'La tercera imagen debe ser de tipo: jpeg, png, jpg o svg.',
                'image_3.max' => 'La tercera imagen no debe pesar más de 2MB.',
            
                'image_4.image' => 'La cuarta imagen debe ser un archivo de imagen.',
                'image_4.mimes' => 'La cuarta imagen debe ser de tipo: jpeg, png, jpg o svg.',
                'image_4.max' => 'La cuarta imagen no debe pesar más de 2MB.',
            
                'image_5.image' => 'La quinta imagen debe ser un archivo de imagen.',
                'image_5.mimes' => 'La quinta imagen debe ser de tipo: jpeg, png, jpg o svg.',
                'image_5.max' => 'La quinta imagen no debe pesar más de 2MB.',
            ]);

            $project = Project::create($validated);

            $project->status = "Activo";

            return response()->json([
                'success' => true,
                'message' => 'Proyecto creado exitosamente.',
                'data' => $project,
            ], 201); 
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creando proyecto.',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }

    public function update($id, Request $request){
        try {
            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proyecto no encontrado.',
                ], 404); 
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'year' => 'required|integer',
                'image_1' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'image_2' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'image_3' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
                'image_4' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
                'image_5' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            $project->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Proyecto actualizado exitosamente.',
                'data' => $project,
            ], 200); 
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error actualizando proyecto.',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }
    
    public function destroy($id){
        try {
            
            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proyecto no encontrado.',
                ], 404); 
            }

            $project->status = "Inactivo";

            return response()->json([
                'success' => true,
                'message' => 'Proyecto dado de baja exitosamente.',
            ], 200); 
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error dando de baja proyecto.',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }

}
