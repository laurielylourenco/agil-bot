@extends('auth.layouts')

@section('content')


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Configuração</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row  justify-content-between">


            <div class="col-lg-6">
                <a href="">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Bot</h5>
                            <div class="d-flex align-items-center justify-content-center">
                            <i class="bx bxs-bot" style="font-size: 50px;"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-6">
                <a href="">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Usuario</h5>
                            <div class="d-flex align-items-center justify-content-center">
                            <i class="bx bxs-user-circle" style="font-size: 50px;"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </section>

</main>

@endsection