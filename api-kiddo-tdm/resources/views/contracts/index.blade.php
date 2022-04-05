@extends('layouts-admin.app')

@section('content')
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Aluno</th>
            <th scope="col">Responsável</th>
            <th scope="col">Curso</th>
            <th scope="col">Sala</th>
            <th scope="col">Unidade</th>
            <th scope="col">Professor</th>
            <th scope="col">Situação</th>
            <th scope="col">Vigência</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($contracts as $key => $contract )
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$contract->student->name}}</td>
                    <td>{{$contract->student->responsible->name}}</td>
                    <td>{{$contract->classGroup->course->name}}</td>
                    <td>{{$contract->classGroup->room->name}}</td>
                    <td>{{$contract->classGroup->room->filial->name}}</td>
                    <td>{{$contract->classGroup->teacher->name}}</td>
                    <td>{{($contract->assigned == "y") ? "Ok" : "Pendente"}}</td>
                    <td>{{$contract->ended}}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection