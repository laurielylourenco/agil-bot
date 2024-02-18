@extends('auth.layouts')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Bot-Menu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="index.html">Home</a> </li>
                <li class="breadcrumb-item active"><a href="{{ route('configBot') }}">Criar Bot</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row  justify-content-between">


            <div class="col-lg-12 ">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lista Bot</h5>

                        <!-- Default Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Token</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contas as $conta)

                                <tr>
                                    <th scope="row"> {{$conta->id}} </th>
                                    <td> {{$conta->token}}</td>
                                    <td> {{$conta->tipo_bot == 2 ? 'Sequencial' : 'Menu' }} </td>

                                    <td>
                                        <button type="button" class="btn btn-sm btn-info rounded-pill">Atualizar</button>
                                        <button type="button" class="btn btn-sm btn-danger rounded-pill">Arquivar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
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