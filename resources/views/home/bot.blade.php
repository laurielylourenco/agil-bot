@extends('auth.layouts')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Bot-Menu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="index.html">Home</a> </li>
                <li class="breadcrumb-item active"><a href="{{ route('lista-bot') }}" >Lista Bot</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row  justify-content-between">


            <div class="col-lg-12 ">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Configurações bot</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" action="{{ route('configBotForm') }}" method="post">
                            @csrf
                            <input type="hidden" name="email" id="email" value="{{Auth::user()->email}}">

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="token_bot" name="token_bot" placeholder="Token Telegram">
                                    <label for="token_bot">Token Telegram</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="tipo_bot" name="tipo_bot" aria-label="Tipo Bot">
                                        <option selected disabled value="">...</option>
                                        <option value="1">Menu</option>
                                        <option value="2">Sequencial</option>
                                    </select>
                                    <label for="tipo_bot">Tipo Bot</label>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Criar</button>
                            </div>
                        </form>

                        <!-- End floating Labels Form -->

                    </div>
                </div>

            </div>


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

    @if(session('info'))
    Swal.fire({
        icon: 'info',
        title: 'Atenção',
        text: "{{ session('info') }}"
    });
    @endif
</script>

@endsection