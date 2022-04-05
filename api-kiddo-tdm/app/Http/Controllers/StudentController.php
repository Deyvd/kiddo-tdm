<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Responsible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function view()
    {
        $students = Student::with('responsible')->get();
        return view('students.index', ['students' => $students]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('responsible')->get();

        if($students){
            return response()->json([
                'status' => 200,
                'students' => $students
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
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
                'name_resp' => 'required',
                'phone_resp' => 'unique:responsibles,phone',
                'name_stud' => 'required',
                'birth_date_stud' => 'required',
            ],
            [
                'name_resp.required' => 'O nome do responsável é obrigatório',
                'phone_resp.unique' => 'Já existe um responsável com este número cadastrado, verifique e tente novamente',
                'name_stud.required' => 'O nome do aluno é obrigatório',
                'birth_date_stud.required' => 'É obrigatório a data de nascimento do Aluno',
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
        try{
            $responsible = new Responsible();
            $responsible->name = isset($data['name_resp']);
            $responsible->phone = isset($data['phone_resp']) ? $data['phone_resp'] : null;
            $responsible->birth_date = isset($data['birth_date_resp']) ? $data['birth_date_resp'] : null;
            $responsible->rg = isset($data['rg_resp']) ? $data['rg_resp'] : null;
            $responsible->org_emit = isset($data['org_emit_resp']) ? $data['org_emit_resp'] : null;
            $responsible->cpf = isset($data['cpf_resp']) ? $data['cpf_resp'] : null;
            $responsible->ocupation = isset($data['ocupation_resp']) ? $data['ocupation_resp'] : null;
            $responsible->whatsapp = isset($data['whatsapp_resp']) ? $data['whatsapp_resp'] : null;
            $responsible->email = isset($data['email_resp']) ? $data['email_resp'] : null;
            $responsible->full_address = isset($data['full_address_resp']) ? $data['full_address_resp'] : null;

            $responsible->save();

            $student = new Student();
            $student->name = $data['name_stud'];
            $student->birth_date = $data['birth_date_stud'];
            $student->responsible_id = $responsible->id;
            $student->save();

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
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        
        if(!$student)
        {
            return response()->json([
                'status'=> 404,
                'msg' => 'registro não encontrado'
            ]);
        }

        return response()->json([
            'status' => 200,
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $detail = null)
    {
        $student = Student::with(['responsible'])->find($id);

        if($detail != null) {
            return view('students.edit', ['student' => $student]);
        }
        else if($detail == null && $student == true) {
            return response()->json([
                'status' => 200,
                'students' => $student
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'msg' => 'Este usuário não existe no sistema'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        dd($data);

        $validator = Validator::make($data, [
                'edit_name_resp' => 'required',
                'edit_name_student' => 'required',
                'edit_birth_date_student' => 'required',
            ],
            [
                'edit_name_resp.required' => 'O nome do responsável é obrigatório',
                'edit_name_student.required' => 'O nome do aluno é obrigatório',
                'edit_birth_date_student.required' => 'É obrigatório a data de nascimento do Aluno',
            ]
        );
 
        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>  400,
                'msg' => $validator->messages(),               
            ]);
        } 
        else 
        {
            $student = Student::find($id);
            $student->responsible->name = $data['name_resp'];
            $student->responsible->phone = $data['phone_resp'];

            $student->name = $data['name_student'];
            $student->birth_date = $data['birth_date_student'];

            $student->update();

            return response()->json([
                'msg'=> 'Registro adicionado com sucesso!',
                'status'=> 201
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->delete();
            return response()->json([
                'status' => 203,
                'msg' => 'Registro Excluido com Sucesso'
            ]);
        }
        return response()->json([
            'status' => 404,
            'msg' => 'Registro Não encontrado!'
        ]);
     


    }
}
