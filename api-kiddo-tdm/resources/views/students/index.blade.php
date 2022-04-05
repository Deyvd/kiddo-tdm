@extends('layouts-admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <p class="  m-2 text-center">Alunos</p>
                  <a href="#" class="new-client btn btn-primary btn-sm">Cadastrar Novo</a>
                </div>

                <div class="card-body">

                  <div id="response_message"></div>

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Responsável</th>
                          <th scope="col">Aluno</th>
                          <th scope="col">Idade</th>
                          <th><th>
                          <th><th>
                        </tr>
                      </thead>
                      <tbody id="fetch_students"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add  -->
<div class="modal fade" id="newClientModal" tabindex="-1" aria-labelledby="newClientModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newClientModalLabel">Novo Aluno</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div id="response_message_modal"></div>
        
        <form id="form_new_student">
        @csrf
          <div class="mb-3">
            <label for="name_resp" class="form-label">Responsável</label>
            <input type="text" class="form-control" id="name_resp" name="name_resp">
          </div>
            <ul id="error_name_resp"></ul>

          <div class="mb-3">
            <label for="phone_resp" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="phone_resp" name="phone_resp">
          </div>
            <ul id="error_phone_resp"></ul>

          <div class="mb-3">
            <label for="name_stud" class="form-label">Aluno</label>
            <input type="text" class="form-control" id="name_stud" name="name_stud">
          </div>
            <ul id="error_name_stud"></ul>

          <div class="mb-3">
            <label for="birth_date_stud" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="birth_date_stud" name="birth_date_stud" >
          </div>  
            <ul id="error_birth_date_stud"></ul>

        </form>

      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">fechar</button>
        <button type="submit" class="btn-new-student btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal Edit  -->
<div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newClientModalLabel">Edição Rápida</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div id="response_message_modal"></div>
        
        <form id="form_edit_student">
        @csrf
          <div class="mb-3">
            <label for="edit_name_resp" class="form-label">Responsável</label>
            <input type="text" class="form-control" id="edit_name_resp" name="edit_name_resp">
          </div>

          <div class="mb-3">
            <label for="edit_phone_resp" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="edit_phone_resp" name="edit_phone_resp">
          </div>

          <div class="mb-3">
            <label for="ediet_name_student" class="form-label">Aluno</label>
            <input type="text" class="form-control" id="ediet_name_student" name="ediet_name_student">
          </div>

          <div class="mb-3">
            <label for="edit_birth_date_student" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="edit_birth_date_student" name="edit_birth_date_student" >
          </div>  

        </form>

      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">fechar</button>
        <button type="submit" class="btn-updated-student btn btn-primary">Atualizar</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')

<script type="text/javascript">

  $(document).ready(function(){

  fetchStudents()
  
  
  function calcIdade(birth_date){
    let age = new Date(birth_date).getTime()
    
    return Math. floor((Date.now() - age) / (31557600000))
    }
  
  function fetchStudents() {
    $('#fetch_students').html('')

    $.get('/api/students', res => {
      
      $.each(res.students, function(key, item){

        let idade = calcIdade(item.birth_date)
        
        $('#fetch_students').append(
          `
            <tr>
              <td>${key+1}</td>
              <td>${item.responsible.name}</td>
              <td>${item.name}</td>
              <td><strong>${idade}</strong> - ano(s)</td>
              <td><button class="btn btn-info btn-sm btn-detail-student" value="${item.id}">Detalhes</button></td>
              <td><button class="btn btn-danger btn-sm btn-delete-student" value="${item.id}">Excluir</button></td>
            <tr>
          `)
      })
    })
  }
  //<td><button class="btn btn-secondary btn-sm btn-edit-student" value="${item.id}">Editar</button></td>



  $(document).on('click', '.new-client', function(e) {
    e.preventDefault();
    
    $('#newClientModal').modal('show');    

  })


  $(document).on('click', '.btn-new-student', function(e){
    e.preventDefault()

    let data =  $('#form_new_student').serialize()

    $.ajax({
      method: 'POST',
      url: 'api/students', 
      data: data, 
      datatype: 'json',
      success: data = function(res) {
      
        console.log('salvar usuário', res)      
        
        if(res.status === 200){
        
          $('#response_message').text(res.msg)
          $('#response_message').addClass('alert alert-success')

          $('#form_new_student').each(function(){
            this.reset()
          })

          $('#newClientModal').modal('hide')

          fetchStudents()
        
        } else {
          $.each(res.msg, function(key, item){
            console.log(key)
            $(`#error_${key}`).html('')
            $(`#error_${key}`).text(item)
            $(`#error_${key}`).addClass('alert alert-danger')
          })
        }
      }
    })
    
  })




  $(document).on('click', '.btn-edit-student', function(e) {
    e.preventDefault();
    
    let student_id = $(this).val();

    $.get(`api/students/${student_id}`, function(res){
      console.log(res)
      $('#editClientModal').modal('show');

      $('#edit_name_resp').val(res.students.responsible.name)
      $('#edit_phone_resp').val(res.students.responsible.phone) 
      $('#ediet_name_student').val(res.students.name)
      $('#edit_birth_date_student').val(res.students.birth_date)
    })    

  })




  $(document).on('click', '.btn-updated-student', function(e){
    e.preventDefault()

    let student_id = $(this).val();

    let data =  $('#form_edit_student').serialize()

    $.ajax({
      url: `/api/students/${student_id}`,
      method: 'put',
      dataType: 'json',
      data : data,
      success: function(res){
        console.log(res)
      }
    })
    
  })



  $(document).on('click', '.btn-detail-student', function(e) {
    e.preventDefault();

    let rede
    let student_id = $(this).val();  
    window.location.href =`/students/${student_id}/detail/param`
  })

  //Deletar aluno

  $(document).on('click', '.btn-delete-student', function(e) {
    e.preventDefault();

    let student_id = $(this).val();  
    $.ajax({
      url: `/api/students/${student_id}`,
      method: 'DELETE',
      dataType: 'json',
      success: function(res){
        if(res.status !== 204){
        $('#response_message').text(res.msg)
        $('#response_message').addClass('alert alert-warning')

        fetchStudents()
      
        } else {
          $('#response_message').text(res.msg)
          $('#response_message').addClass('alert alert-secondary')
        }
      }
    })
  })

})

</script>

@endsection
