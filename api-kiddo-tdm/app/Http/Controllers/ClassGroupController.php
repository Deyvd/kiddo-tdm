<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classGroup =   ClassGroup::with([
            'contracts',
            'classDay',
            'shedule',
            'course',
            'teacher',
            'room',
        ])->get();

        return response()->json([
        'classGroup' => $classGroup,
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
     * @param  \App\Http\Requests\StoreClassGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'start' => 'required',
                'class_day_id' => 'required',
                'course_id' => 'required',
                'course_id' => 'required',
                'room_id' => 'required',
                'teacher_id' => 'required'

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

            ClassGroup::create($data);
            
            DB::commit();   
            return response()->json([
                'msg'=> 'Registro adicionado com sucesso!',
                'status'=> 201
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 404,
                'message' => 'Registro adicionado com sucesso!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classGroup = ClassGroup::with([
                        'classDay',
                        'shedule',
                        'course',
                        'teacher',
                        'room',
                        'contracts',
                        ])
                        ->find($id);

        if($classGroup)
        {
            return response()->json([
                '$classGroup' => $classGroup, 
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
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassGroup $classGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassGroupRequest  $request
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'start' => 'required',
                'class_day_id' => 'required',
                'course_id' => 'required',
                'room_id' => 'required',
                'shedule_id' => 'required',
                'teacher_id' => 'required'

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

            $classGroup = ClassGroup::find($id);
            $classGroup->start = $data['start'];
            $classGroup->class_day_id = $data['class_day_id'];
            $classGroup->course_id = $data['course_id'];
            $classGroup->shedule_id = $data['shedule_id'];
            $classGroup->room_id = $data['room_id'];
            $classGroup->teacher_id = $data['teacher_id'];
            $classGroup->save();
            
            DB::commit();   
            return response()->json([
                'msg'=> 'Registro atualizado com sucesso!',
                'classGroup' => $classGroup,
                'status'=> 201
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 404,
                'message' => 'Registro não encontrado'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classGroup = ClassGroup::find($id);

        if($classGroup){
            $classGroup->delete();

            return response()->json([
                'status' => 200,
                'msg' => 'Registro excluido com sucesso.'            
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'msg' => 'Registro não encontrado.'            
            ]);
        }
    }
}
