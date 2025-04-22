<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
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

    public function store(StoreProjectRequest $request){
        try {
            
            $validated = $request->validated();

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

    public function update($id, UpdateProjectRequest $request){
        try {
            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proyecto no encontrado.',
                ], 404); 
            }

            $validated = $request->validated();

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
