<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::with('filial', 'classGroups.teacher', 'classGroups.contracts.student')->get();
        if($rooms){
            return response()->json([
                'rooms' => $rooms,
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
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required',
                'filial_id' => 'required'
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

            Room::create($data);
            
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
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::with(
                    'filial', 
                    'classGroups', 
                    'classGroups.teacher', 
                    'classGroups.contracts.student', 
                    'classGroups.shedule', 
                    'classGroups.classDay',
                    'classGroups.course'
                    )->find($id);

        if($room)
        {
            return response()->json([
                '$room' => $room, 
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
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required',
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
            $room = Room::find($id);
            $room->name = $request['name'];
            $room->save();
            
            DB::commit();   
            return response()->json([
                'msg'=> 'Registro atualizado com sucesso!',
                'room'=> $room,
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
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);

        if($room) {
            $room->delete();
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
