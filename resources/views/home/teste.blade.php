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


            <div class="col-lg-6">


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">TESTE</h5>
                        <p>Aqui vem texto Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime modi laboriosam eos doloribus doloremque assumenda incidunt. Dignissimos commodi sequi quo nisi in reprehenderit, iure, maiores facere temporibus excepturi nulla ratione! </p>

                        <!-- Custom Styled Validation -->
                        <form class="row g-3 needs-validation" action="{{ route('createWelcome') }}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <!--  <label for="inputPassword" class="col-sm-2 col-form-label"></label> -->
                                <div class="col-sm-10">
                                    <textarea class="form-control" style="height: 100px"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </form><!-- End Custom Styled Validation -->

                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Menu</h5>
                        <p>Aqui vem texto Lorem ipsum dolor sit amet consectetur! </p>

                        <!-- Custom Styled Validation -->
                        <form action="{{ route('createWelcome') }}" method="post" class="row g-3 needs-validation">
                            @csrf

                           <!--  <input type="hidden" name="email" id="email" value="{{Auth::user()->email}}"> -->
                            <div class="col-md-8">
                                <label for="validationDefault04" class="form-label">Opção</label>
                                <select class="form-select" id="option" name="option" required>
                                    <option selected disabled value="">...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>


                            <div class="col-md-12">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Menu</label>
                                <div class="col-sm-10">
                                    <textarea id="menu" name="menu" class="form-control" style="height: 50px"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Resposta</label>
                                <div class="col-sm-10">
                                    <textarea id="resposta" name="resposta" class="form-control" style="height: 50px"></textarea>
                                </div>
                            </div>


                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>

</main>

@endsection