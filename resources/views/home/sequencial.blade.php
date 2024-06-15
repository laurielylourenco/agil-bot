@extends('auth.layouts')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Bot-Sequencial</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Lista Menus</li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <div class="col text-end">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#basicModalSeq">
                    <i class="bi bi-plus-lg me-1"></i> Nova Mensagem
                </button>
            </div>

            <div class="modal fade" id="basicModalSeq" tabindex="-1">
                <div class="modal-dialog modal-fullscreen-sm-down modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ESCREVA SUA MENSAGEM</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">


                            <!--  <form action="{{ route('create-sequencial') }}" method="post" class="row g-3 needs-validation"> -->
                            @csrf
                            <input type="hidden" name="email" id="email" value="{{Auth::user()->email}}">
                            <div class="col-md-8">
                                <label for="validationDefault04" class="form-label">Ordem</label>
                                <select class="form-select" id="ordem" name="ordem" required>
                                    <option selected disabled value="">Selecione uma opção</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Mensagem</label>
                                <div class="col-sm-10">
                                    <textarea id="mensagem" name="mensagem" class="form-control" style="height: 100px">{{ $mensagem_criada ?? '' }}</textarea>
                                </div>
                            </div>

                            <!--      </form> -->

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                            <button type="button" class="btn btn-success" id="insertSequencial" data-bs-dismiss="modal"><i class="bi bi-plus-lg"></i></button>

                        </div>
                    </div>
                </div>
            </div><!-- End Large Modal-->

        </div>

        <div class="row mt-5">

            <div class="list-group">

                <!--      <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    The current link item
                </a> -->
                @if (count($mensagens) !== 0)
                <ol class="list-group list-group-numbered">
                    @foreach($mensagens as $msg)

                    <li class="list-group-item"> {{$msg->mensagem}}</li>
                    @endforeach
                </ol>
                @endif


            </div>

        </div>

    </section>

</main>

<script>
    var campo = $(".mensagem");
    // outros códigos
    //  var digitado = campo.val().trim();
    // Verifique se há mensagem de sucesso
    @if(session('success'))

    console.log("aqui")
    Swal.fire({
        icon: 'success',
        title: 'Sucesso!',
        text: "{{ session('success') }}"
    });

    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Erro!',
        text: "{{ session('error') }}"
    });
    @endif
</script>


<script>
    $(document).ready(function() {

        $("#insertSequencial").click(function() {
            let ordem = $("#ordem").val();
            let mensagem = $("#mensagem").val();

            $.ajax({
                url: '/createMensagem',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'ordem': ordem,
                    'mensagem': mensagem,
                    'email': "{{Auth::user()->email}}",
                    'bot_id': '{{ $bot_id }}'
                },
                success: function(response) {

                    console.log("response.hasData", response.hasData)
                    if (response.hasData) {
                        // A opção já possui dados associados
                        $('#mensagem').val(response.mensagem);
                    } else {
                        // Limpar os campos se não houver dados associados
                        $('#mensagem').val('');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });


        $('#ordem').change(function() {
            var selectedOrdem = $(this).val();

            console.log("selectedOrdem", selectedOrdem)
            $.ajax({
                url: '/check-ordem',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'ordem': selectedOrdem,
                    'email': "{{Auth::user()->email}}",
                    'bot_id': '{{ $bot_id }}'
                },
                success: function(response) {

                    console.log("response.hasData", response.hasData)
                    if (response.hasData) {
                        // A opção já possui dados associados
                        $('#mensagem').val(response.mensagem);
                    } else {
                        // Limpar os campos se não houver dados associados
                        $('#mensagem').val('');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

@endsection