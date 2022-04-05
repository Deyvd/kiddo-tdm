<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::with('classGroups')->get();

        if($teachers){
            return response()->json([
                'teachers' => $teachers,
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Não encontramos alunos cadastrados'
            ]);
        }
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
     * @param  \App\Http\Requests\StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required'
            ],
            [
                'required' => 'O campo é obrigatório.'
            ]
        );

        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>  400,
                'msg' => $validator->messages(),               
            ]);
        }

        DB::beginTransaction();
        try {

            Teacher::create($data);
            
            DB::commit();   
            return response()->json([
                'msg'=> 'Registro adicionado com sucesso!',
                'status'=> 201
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);

        if($teacher)
        {
            return response()->json([
                '$teacher' => $teacher, 
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
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherRequest  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required'
            ],
            [
                'required' => 'O campo é obrigatório.'
            ]
        );

        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>  400,
                'msg' => $validator->messages(),               
            ]);
        }

        DB::beginTransaction();
        try {

            $teacher = Teacher::find($id);
            $teacher->update($data);
            
            DB::commit();   
            return response()->json([
                'msg'=> 'Registro atualizado com sucesso!',
                'teacher' => $teacher,
                'status'=> 201
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if($teacher){
        $teacher->delete();

        return response()->json([
            'msg'=>'Registro excluido com sucesso!',
            'status' => '200'
        ]);
        } else {
            return response()->json([
                'msg'=>'Registro não encontrado!',
                'status' => '404'
            ]); 
        }

    }
}
