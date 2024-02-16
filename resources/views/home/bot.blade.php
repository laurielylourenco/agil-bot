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
        <div class="row  justify-content-between">


            <div class="col-lg-12 ">



                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Configurações bot</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingName" placeholder="Your Name">
                                    <label for="floatingName">Token Telegram</label>
                                </div>
                            </div>
        
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="State">
                                        <option selected disabled value="">...</option>
                                        <option value="1">Sequencial</option>
                                        <option value="2">Menu</option>
                                    </select>
                                    <label for="floatingSelect">State</label>
                                </div>
                            </div>
                  
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </div>
                        </form>
                        
                        <!-- End floating Labels Form -->

                    </div>
                </div>

            </div>


        </div>

    </section>

</main>

@endsection