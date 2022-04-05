<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with('cicle', 'classGroups')->get();

        if($courses){
            return response()->json([
                'courses' => $courses,
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
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'cicle_id' => 'required',
                'name' => 'required',
                'min_age' => 'required',
                'max_age' => 'required'

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

            Course::create($data);
            
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
     * @param  \App\Models\Course  $course
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
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required',
                'min_age' => 'required',
                'max_age' => 'required'

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
            $course = Course::find($id);
            $course->name = $request['name'];
            $course->min_age = $request['min_age'];
            $course->max_age = $request['max_age'];
            $course->save();
            
            DB::commit();   
            return response()->json([
                'msg'=> 'Registro atualizado com sucesso!',
                'status'=> 201
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'msg' => 'Registro não encontrado.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if($course) {
            $course->delete();
            return response()->json([
                'msg' => 'Registro excluido com sucesso',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'msg' => 'O Registro não existe no sistema.',
                'status' => 200
            ]);

        }
    }
}
