<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'description' => 'string',
            'year' => 'integer',
            'image_1' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'image_2' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'image_3' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'image_4' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'image_5' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
        
            'description.string' => 'La descripción debe ser una cadena de texto.',

            'year.integer' => 'El año debe ser un número entero.',
        
            'image_1.image' => 'La primera imagen debe ser un archivo de imagen.',
            'image_1.mimes' => 'La primera imagen debe ser de tipo: jpeg, png, jpg o svg.',
            'image_1.max' => 'La primera imagen no debe pesar más de 2MB.',
        
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
        ];
    }
}
