<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use App\Http\Requests\StorePersona;
use App\Http\Requests\UpdatePersona;
use App\Http\Resources\PersonaResource;


class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Sin el resource
        // return Persona::all();

        // Usando el resource
        return PersonaResource::collection(Persona::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersona $request)
    {
        /* Persona::create($request->all());
        return response()->json([
            'res' => true,
            'message' => 'Persona guardada correctamente',
        ], 200); */

        return (new PersonaResource(Persona::create($request->all())))
                ->additional(['msg' => 'Persona guardada correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        /* return response()->json([
            'res' => true,
            'persona' => $persona
        ], 200); */

        return new PersonaResource($persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersona $request, Persona $persona)
    {
        /* $persona->update($request->all());
        return response()->json([
            'res' => true,
            'message' => 'El registro se actualizo correctamente'
        ], 200); */

        $persona->update($request->all());
        // En la linea anterior primero actualizo la persona y le paso la persona actualizada al recurso.
        return (new PersonaResource($persona))
                ->additional(['res' => 'El registro se actualizo correctamente'])
                ->response() // Indico que voy a manejar la respuesta
                ->setStatusCode(202); // Indico el codigo de estado a emviar cuando se actualice un registro
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        /* $persona->delete();
        return response()->json([
            'res' => true,
            'message' => 'El registro se elimino correctamente'
        ], 200); */

        $persona->delete();
        return (new PersonaResource($persona))->additional(['res' => 'El registro se elimino correctamente']);
    }
}
