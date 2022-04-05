<?php

namespace App\Http\Controllers;

use App\Models\Filial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filials = Filial::with(['rooms'])->get();
        return response()->json([
            'filials' => $filials,
            'status' => 200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFilialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required',
                'full_address' => 'required'
            ],
            [ 
                'required' => ' Campo é obrigatório'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status' => '400',
                'msg' => $validator->messages()
            ]);
        }

        $filial = Filial::create($data);

        if($filial) {
            return response()->json([
                'status' => 201,
                'msg' => 'Registro adicionado com sucesso.'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);

        if($course)
        {
            return response()->json([
                '$course' => $course, 
                'status' => 200]);
        }
        return response()->json([
            'status' => 404,
            'msg' => 'Registro não encontrado'

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function edit(Filial $filial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFilialRequest  $request
     * @param  \App\Models\Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required',
                'full_address' => 'required'
            ],
            [ 
                'required' => ' Campo é obrigatório'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status' => '400',
                'msg' => $validator->messages()
            ]);
        }

        $filial = Filial::find($id);
        $filial->name = $data['name'];
        $filial->full_address = $data['full_address'];
        $filial->save();

        if($filial) {
            return response()->json([
                'status' => 201,
                'filial' => $filial
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'msg' => 'Registro não encontrado.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filial  $filial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filial = Filial::find($id);

        if($filial) {
            $filial->delete();
            return response()->json([
                'msg' => 'Registro excluido com sucesso',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'msg' => 'O Registro não existe no sistema.',
                'status' => 400
            ]);

        }
    }
}
