<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContractController extends Controller
{
    public function view()
    {
        $contracts = Contract::with(['student','student.responsible', 'classGroup', 'classGroup.course', 'classGroup.teacher', 'classGroup.room', 'classGroup.room.filial'])->paginate(10);
        return view('contracts.index', ['contracts' => $contracts]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::with([
            'student', 'classGroup'
        ])->get();

        return response()->json([
            'contracts' => $contracts,
            'msg' => 'success',
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
     * @param  \App\Http\Requests\StoreContractRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator= Validator::make(
            $data,
            [
                'student_id' => 'required',
                'class_group_id' => 'required',
            ]
        );

        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>  400,
                'msg' => $validator->messages(),               
            ]);
        }

        $contractExists = Contract::where('student_id', $data['student_id'])
                                ->whereIn('class_group_id', [$data['class_group_id']])
                                ->exists();
        
                                       
        if($contractExists)
        {
            return response()->json([
                'status' => 400,
                'msg' => "Este aluno já está matriculado"

            ]);
        }

        DB::beginTransaction();
        try{

            $newContract = new Contract();
            $newContract->student_id = $data['student_id'];
            $newContract->class_group_id = $data['class_group_id'];
            $newContract->assigned = 'n';
            $newContract->status = 'i';
            $newContract->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Contrato realizada com sucesso!'
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
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::find($id);
        if($contract)
        {
            return response()->json([
                'status' => 200,
                'contract' => $contract

            ]);
        }
        return response()->json([
            'msg' => 'Contrato não encontrado', 
            'status' => 404]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContractRequest  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        DB::beginTransaction();
        try{

            $newContract = Contract::find($id);
            $newContract->status = isset($data['status']) ? $data['status'] : null;
            $newContract->assigned = isset($data['assigned']) ? $data['assigned'] : null;
            $newContract->started = isset($data['started']) ? $data['started'] : null;
            $newContract->ended = isset($data['ended']) ? $data['ended'] : null;
            $newContract->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Contrato atualizada com sucesso!'
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
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = Contract::find($id)->delete();

        if($contract)
        {
            return response()->json([
                'msg' => 'Contrato excluido co sucesso', 
                'status' => 200]);
        }
        return response()->json([
            'status' => 404,
            'msg' => 'Registro não encontrado'

        ]);

    }
}
