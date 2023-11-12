<?php
require_once '/var/www/html/learn-bot/agil-bot/public/header.php';
?>

<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="/learn-bot/agil-bot/public/assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">AgilBot</span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Criar Conta</h5>
                  <p class="text-center small">Digite seus detalhes pessoais para criar uma conta</p>
                </div>

                <form class="row g-3 needs-validation" id="criarConta">
                  <div class="col-12">
                    <label for="yourName" class="form-label">Seu nome</label>
                    <input type="text" name="name" class="form-control" id="yourName" required>
                    <div class="invalid-feedback">Por favor seu nome!</div>
                  </div>

                  <div class="col-12">

                    <label for="telefone" class="form-label">Telefone com DDD</label>
                    <input class="form-control" name="telefone" required placeholder="Telefone com DDD" id="phone" name="phone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" />

                    <div class="invalid-feedback">Por favor digite um telefone </div>
                  </div>

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="email" name="username" class="form-control" id="yourUsername" required>
                      <div class="invalid-feedback">Por favor digite um email.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Por favor digite uma senha</div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Criar Conta</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Você possui uma conta? <a href="http://localhost/learn-bot/agil-bot/app/Views/Auth/login.php">Log in</a></p>
                  </div>
                </form>

              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php
require_once '/var/www/html/learn-bot/agil-bot/public/footer.php';
?>