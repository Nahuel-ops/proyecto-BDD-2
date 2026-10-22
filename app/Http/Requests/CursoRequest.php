<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CursoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, mixed>|string>
     */
    public function rules(): array
    {
        $cursoId = $this->route('curso')?->id;

        return [
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('cursos', 'name')
                    ->where(fn ($query) => $query->where('categoria_id', $this->input('categoria_id')))
                    ->ignore($cursoId),
            ],
            'descripcion' => ['nullable', 'string'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'categoria_id' => 'categoría',
            'name' => 'nombre del curso',
            'descripcion' => 'descripción',
            'imagen' => 'imagen',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'Ya existe un curso con este nombre en la categoría seleccionada.',
        ];
    }
}
