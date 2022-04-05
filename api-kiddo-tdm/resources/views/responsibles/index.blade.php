

@extends('layouts-admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h1>Lista de Responsáveis</h1>
                  <a class="btn btn-primary btn-sm ">Novo</a>
                </div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Nº Contratos</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($responsibles as $key => $responsible)
                      <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$responsible->name}}</td>
                        <td>{{$responsible->phone}}</td>
                        <td>{{count($responsible->students)}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
