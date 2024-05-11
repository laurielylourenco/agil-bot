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

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ESCREVA SUA MENSAGEM</h5>
                        <p>Faça perguntas sequenciais para seu cliente.</p>

                        <form action="{{ route('create-sequencial') }}" method="post" class="row g-3 needs-validation">
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
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Mensagem</label>
                                <div class="col-sm-10">
                                    <textarea id="mensagem" name="mensagem" class="form-control" style="height: 50px">{{ $mensagem_criada ?? '' }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Cadastrar</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>

</main>

<script>
    var campo = $(".mensagem");
    // outros códigos
    var digitado = campo.val().trim();
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
        $('#ordem').change(function() {
            var selectedOrdem = $(this).val();

            console.log("selectedOrdem", selectedOrdem)
            $.ajax({
                url: '/check-ordem',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'ordem': selectedOrdem,
                    'email': "{{Auth::user()->email}}"
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