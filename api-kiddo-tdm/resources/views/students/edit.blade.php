@extends('layouts.app')

@section('content')
<div class="container ">


    <div class="row my-3 text-left">
      <h1><span>Aluno</span></h1>
    </div>
    <div class="row my-3 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center ">
                  <p class=" h3 card-title m-2 text-center">Detalhes do Aluno</p>
                  <button class="btn btn-outline-success fw-bold font-monospace fw-light btn-sm">Atualizar</button>
                </div>

                <div class="card-body">
                    <form id="form_edit_student">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="name_studente" class="form-label">Aluno</label>
                                <input type="text" class="form-control" id="name_student" name="name_student" value="{{$student->name}}">
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="birth_date_student" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="birth_date_student" name="birth_date_student" value="{{$student->birth_date}}" >
                            </div>  

                            <div class="mb-3 col-md-3">
                                <label for="birth_date_student" class="form-label">Idade</label>
                                <input type="text" class="form-control" id="birth_date_student" name="birth_date_student" value="{{$student->birth_date}} Anos" >
                            </div>                         
                        </div>
                        
                    </form>
                            
                    <hr>
                    <div class="row mb-3 d-flex justify-content-between">
                          <h2> Responsável: </h2>
                          <p> {{$student->responsible->name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <p class=" h3  m-2 text-center">Turma(s)</p>
                  <button  class="add-new-class btn fw-bold font-monospace fw-light  btn-outline-info btn-sm">Matricular</button>
                </div>
                <div class="card-body ">
                  <p class=" d-none m-2 text-center">Aluno ainda não está matriculado</p>
                    <div>
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Turma</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Dia</th>
                            <th scope="col">professor</th>
                            <th scope="col">histórico</th>
                            <th><th>
                          </tr>
                        </thead>

                        <tbody id="fetch_class_groups">
                        </tbody>

                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row my-4 mb-5 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <p class=" h3  m-2 text-center">Histórico</p>
                  <a href="#" class="add-new-comments  btn fw-bold font-monospace fw-light  btn-outline-warning btn-sm">Ocorrência</a>
                </div>
                <div class="card-body ">
                 
                    <div>
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">data</th>
                            <th scope="col">ocorrencia</th>
                          
                          </tr>
                        </thead>

                        <tbody id="fetch_class_groups">
                          <tr>
                            <td scope="col">12/04/2021</td>
                            <td colspan="8" scope="col">
                                Lorem ipsum dolor sit amet, consectetur adip Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adip. Lorem ipsum dolor sit amet, consectetur adip eum. Lore 
                                Lorem ipsum dolor sit amet, consectetur adip Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adip. Lorem ipsum dolor sit amet, consectetur adip eum. Lore 
                                Lorem ipsum dolor sit amet, consectetur adip Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adip. Lorem ipsum dolor sit amet, consectetur adip eum. Lore 
                                Lorem ipsum dolor sit amet, consectetur adip Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adip. Lorem ipsum dolor sit amet, consectetur adip eum. Lore 
                                Lorem ipsum dolor sit amet, consectetur adip Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adip. Lorem ipsum dolor sit amet, consectetur adip eum. Lore 
                            </td>
                            
                            <td class="d-flex align-items-center"><button class="btn btn-primary ">Detalhes</button> <td>

                          </tr>
                        </tbody>

                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Maricula  -->
<div class="modal fade" id="contractClassGroupModal" tabindex="-1" aria-labelledby="contractClassGroupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contractClassGroupModalLabel">Nova Matricula</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form id="form_contract_class">
        @csrf

          <div class="row mb-3">            
            <div class="col-md-12 mb-3">
              <label for="filial" class="form-label">Unidade</label>
              <select type="text" class="form-control" id="filial" name="filial">
                <option value="">Escolha uma Unidade</option>
              </select>
            </div>          
          </div>

          <div id="message_error" class="d-none"><hr></div>

          <div id="contract_class_group" class="d-none">

            <hr>
          
            <div class="row mb-3">
              <div class="col-md-12 mb-3">
                <label for="courses" class="form-label">Cursos</label>
                <select type="text" class="form-control" id="courses" name="courses">
                  <option value="">Escolha o Curso</option>
                </select>
              </div>   

              <div id="data_class_group" class="d-none">
                
                <div class="row mb-3">
                  <div class="col-md-6 mb-3">
                    <label for="phone_resp" class="form-label">Dia</label>
                    <select type="text" class="form-control" id="name_resp" name="class_day">
                      <option value="">Escolha um Dia</option>
                    </select>
                  </div>  

                  <div class="col-md-6 mb-3">
                    <label for="phone_resp" class="form-label">Horário</label>
                    <select type="text" class="form-control" id="name_resp" name="shedule">
                      <option value="">Escolha um Horário</option>
                    </select>
                  </div>                  
                </div>

            </div>

          </div>
          

        </form>

      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">fechar</button>
        <button type="submit" class="btn-new-student btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('scripts')

<script type="text/javascript">

$(document).ready(function(){

  $(document).on('click', '.add-new-class', function(e) {
    e.preventDefault();

    $('#contractClassGroupModal').modal('show');

    $.get('/api/fetch-filials', res => {
      $.each(res.filials, function(key, item) {

        $('[name=filial]').append(
          `
            <option value="${item.id}">${item.name}</option>
          ` 
        )        
      })
    })   
  })   

  $(document).on('change', '[name=filial]', function(e) {
    e.preventDefault();

    let filial_id = $(this).val();
    $.get('/api/fetch-class-groups', res => {

      
      $.each(res.classGroup, function(key, item) {

        if(filial_id == item.room.filial_id) {

          $('#contract_class_group').removeClass('d-none')
          $('#message_error').remove()

          $('[name=courses]').append(
          `
            <option value="${item.course.id}">${item.course.name}</option>
          ` 
          )

        } else {

          $('#message_error').html('')
          $('#message_error').removeClass('d-none')
          $('#message_error').addClass('alert alert-danger')
          $('#message_error').text('Oops! Não encontramos turmas nessa unidade!')

        }
      })
    }) 
  }) 



  $(document).on('change', '[name=courses]', function(e) {
    e.preventDefault();
  
    $('#data_class_group').removeClass('d-none')

    $.get('/api/fetch-class-groups', res => {

      
      $.each(res.classGroup, function(key, item) {
        $('[name=class_day]').append(
          `
            <option value="${item.class_day.id}">${item.class_day.dia_of_week}</option>
          ` 
          )
        $('[name=shedule]').append(
          `
            <option value="${item.shedule.id}">${item.shedule.hour}</option>
          ` 
          )        
      })
    })   
  })  


})

</script>

@endsection
