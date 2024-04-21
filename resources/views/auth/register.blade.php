@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="/learn-bot/agil-bot/public/assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">AgilBot</span>
            </a>
        </div>

        <div class="card mb-3">

            <div class="card-body">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Criar Conta</h5>
                    <p class="text-center small">Digite seus detalhes pessoais para criar uma conta</p>
                </div>

                <form class="row g-3 " action="{{ route('store') }}" method="post">
                    @csrf
                    <div class="col-12">
                        <label for="yourName" class="form-label">Seu nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>


                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Senha</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="password_confirmation" class="col-form-label ">Confirm Senha</label>
                      
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                  
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Criar Conta</button>
                    </div>
                    <div class="col-12">
                        <p class="small mb-0">Você possui uma conta? <a href="{{ route('login') }}">Login</a></p>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>


@endsection