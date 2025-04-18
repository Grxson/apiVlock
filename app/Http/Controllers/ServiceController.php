<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Exception;

class ServiceController extends Controller
{
    public function index()
    {
        try {
            $services = Service::all();

            if ($services->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontraron servicios.',
                    'data' => [],
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Servicios recuperados exitosamente.',
                'data' => $services
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error recuperando servicios',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $service = Service::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Servicio recuperado exitosamente.',
                'data' => $service
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio no encontrado.',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser una cadena de texto.',
                'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            
                'image.required' => 'La imagen es obligatoria.',
                'image.image' => 'El archivo debe ser una imagen.',
                'image.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o svg.',
                'image.max' => 'La imagen no debe pesar más de 2MB.',
            ]);

            $service = Service::create($validated);

            $service->status = "Activo";

            return response()->json([
                'success' => true,
                'message' => 'Servicio creado exitosamente.',
                'data' => $service
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creando servicio.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $service = Service::findOrFail($id);

            $validated = $request->validate([
                'name' => 'string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);

            $service->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Servicio actualizado exsitosamente.',
                'data' => $service
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error actualizando sevicio.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->status = "Inactivo";

            return response()->json([
                'success' => true,
                'message' => 'Service dado de baja exitosamente.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error dando de baja servicio.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
