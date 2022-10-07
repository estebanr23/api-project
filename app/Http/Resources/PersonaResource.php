<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PersonaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identificador' => $this->id,
            'nombre' => Str::upper($this->nombre),
            'apellido' => Str::upper($this->apellido),
            'dni' => $this->dni,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'fecha_creado' => $this->created_at->format('d-m-Y'),
            'fecha_actualizado' => $this->updated_at->format('d-m-Y')
        ];
    }

    // Con esta funcion agregamos mas parametros a la respuesta json
    public function with($request)
    {
        return [
            'resp' => true
        ];
    }
}
