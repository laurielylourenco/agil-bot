@extends('auth.layouts')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Bot</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="index.html">Home</a> </li>
                <li class="breadcrumb-item active"><a href="{{ route('configBot') }}">Criar Bot</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row justify-content-between">
            <div class="col text-end">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <i class="bi bi-plus-lg me-1"></i> Novo bot
                </button>
            </div>
            <!-- modal-dialog-centered -->
            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog modal-fullscreen-sm-down modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Bot</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="botname" placeholder="Nome do bot">
                                        <label for="botname">Nome do bot</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="descBot" placeholder="Your Email">
                                        <label for="descBot">Descrição</label>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="tipobot" aria-label="Tipo">
                                            <option selected>...</option>
                                            <option value="1">Menu</option>
                                            <option value="2">Sequencial</option>
                                        </select>
                                        <label for="floatingSelect">Tipo</label>
                                    </div>
                                </div>
                            </div><!-- End floating Labels Form -->



                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                            <button type="button" class="btn btn-success" id="insertBot" data-bs-dismiss="modal"><i class="bi bi-plus-lg"></i></button>

                        </div>
                    </div>
                </div>
            </div><!-- End Basic Modal-->
        </div>

        <div class="row mt-5">

        @if (count($contas) !== 0)

        @foreach($contas as $c)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{$c->nome}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$c->tipo_bot == 1 ? 'Menu' : 'Sequencial'  }}</h6>
                        <p class="card-text">{{$c->descricao}}</p>

                        <a type="button" href="{{ route('configBot') }}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> </a>
                        <a type="button" href="{{ route('configBot') }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <a type="button" href="{{$c->tipo_bot == 1 ? route('menu',['id' => $c->id]) : route('menu-sequencial',['id' => $c->id])  }}" class="btn btn-sm btn-info"><i class="bi bi-arrows-angle-expand"></i> </a>


                    </div>
                </div>
            </div>
            @endforeach
            @endif

            <!-- <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">GranelBot</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Tipo: Sequencial</h6>
                        <p class="card-text">Informaçoes sobre a loja</p>

                        <a type="button"  href="{{ route('configBot') }}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> </a>
                        <a type="button"  href="{{ route('configBot') }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <a type="button"  href="{{ route('configBot') }}" class="btn btn-sm btn-info"><i class="bi bi-arrows-angle-expand"></i> </a>

                    </div>
                </div>
            </div> -->

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
        $("#insertBot").click(function() {
            let botname = $("#botname").val();
            let descBot = $("#descBot").val();
            let tipobot = $("#tipobot").val();

            console.log("Aqui", botname, descBot, tipobot)

            $.ajax({
                url: '/create-bot',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'botname': botname,
                    'descBot': descBot,
                    'tipo_bot': tipobot,
                    'email': "{{Auth::user()->email}}"
                },
                success: function(response) {

                    console.log("response.hasData", response.hasData)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    });
</script>

@endsection