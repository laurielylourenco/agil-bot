@extends('auth.layouts')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Bot-Menu</h1>
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
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#basicModalMenu">
                    <i class="bi bi-plus-lg me-1"></i> Novo Menu
                </button>
            </div>

            <div class="modal fade" id="basicModalMenu" tabindex="-1">
                <div class="modal-dialog modal-fullscreen-sm-down modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">CRIE NOVO MENU</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="email" id="email" value="{{Auth::user()->email}}">
                            <div class="col-md-8">
                                <label for="validationDefault04" class="form-label">Opção</label>
                                <select class="form-select" id="option" name="option" required>
                                    <option selected disabled value="">...</option>
                                    <option value="0">Mensagem inicial</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>


                            <div class="col-md-12" id="bloco-menu">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Menu</label>
                                <div class="col-sm-10">
                                    <textarea id="menu" name="menu" class="form-control" style="height: 20px"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Resposta</label>
                                <div class="col-sm-10">
                                    <textarea id="resposta" name="resposta" class="form-control" style="height: 100px"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                            <button type="button" class="btn btn-success" id="insertMenu" data-bs-dismiss="modal"><i class="bi bi-plus-lg"></i></button>

                        </div>
                    </div>
                </div>
            </div><!-- End Large Modal-->


        </div>

        <div class="row mt-5">
            @if (count($menus) !== 0)

            @foreach($menus as $m)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @if ($m->menu)
                        <h5 class="card-title text-center">{{$m->menu}}</h5>
                        @else
                        <h5 class="card-title text-center">Mensagem inicial</h5>
                        @endif
                        <p class="card-text"><b>Resposta</b>: {{$m->resposta}} </p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </section>

</main>


<script>
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
        // var campo = $(".msg_welcome");
        // outros códigos
        ///  var digitado = campo.val().trim();

        $("#insertMenu").click(function() {
            let option = $("#option").val();
            let menu = $("#menu").val();
            let resposta = $("#resposta").val();

            $.ajax({
                url: '/createOption',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'option': option,
                    'resposta': resposta,
                    'menu': menu,
                    'email': "{{Auth::user()->email}}"
                },
                success: function(response) {

                    console.log("response.hasData", response.hasData)
                    if (response.hasData) {
                        // A opção já possui dados associados
                        $('#mensagem').val(response.mensagem);
                    } else {
                        // Limpar os campos se não houver dados associados
                        //$('#mensagem').val('');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $('#option').change(function() {
            var selectedOption = $(this).val();

            console.log("selectedOption", selectedOption)

            if (selectedOption == 0) {

                $("#bloco-menu").hide();
            } else {
                $("#bloco-menu").show();
            }
            $.ajax({
                url: '/check-option',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'option': selectedOption,
                    'email': "{{Auth::user()->email}}"
                },
                success: function(response) {

                    if (response.hasData) {
                        // A opção já possui dados associados
                        $('#menu').val(response.menu);
                        $('#resposta').val(response.resposta);
                    } else {
                        // Limpar os campos se não houver dados associados
                        $('#menu').val('');
                        $('#resposta').val('');
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