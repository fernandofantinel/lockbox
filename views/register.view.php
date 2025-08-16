<?php
$validations = flash()->get('validations');
?>
<div class="grid grid-cols-2">
  <div class="hero min-h-screen flex ml-40">
    <div class="hero-content -mt-20">
      <div>
        <p class="py-2 text-xl">
          Bem vindo ao
        </p>
        <h1 class="text-6xl font-bold">LockBox</h1>
        <p class="pt-2 pb-4 text-xl">
          onde você guarda <span class="italic">tudo</span> com segurança.
        </p>
      </div>
    </div>
  </div>
  <div class="bg-white hero mr-40 min-h-screen text-black">
    <div class="hero-content -mt-20">
      <form method="POST" action="/register">
        <div class="card">
          <div class="card-body">
            <div class="card-title">Crie a sua conta</div>
            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Nome</span>
              </div>
              <input class="input input-secondary w-full max-w-xs bg-white" type="text" name="name" value="<?= old('name') ?>" />
              <?php if (isset($validations['name'])) { ?>
                <div class="label text-sm text-error"><?= $validations['name'][0] ?></div>
              <?php } ?>
            </label>

            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">E-mail</span>
              </div>
              <input class="input input-secondary w-full max-w-xs bg-white" type="text" name="email" value="<?= old('email') ?>" />
              <?php if (isset($validations['email'])) { ?>
                <div class="label text-sm text-error"><?= $validations['email'][0] ?></div>
              <?php } ?>
            </label>

            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Confirme o seu e-mail</span>
              </div>
              <input class="input input-secondary w-full max-w-xs bg-white" type="text" name="email_confirmation" />
              <?php if (isset($validations['email_confirmation'])) { ?>
                <div class="label text-sm text-error"><?= $validations['email_confirmation'][0] ?></div>
              <?php } ?>
            </label>

            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Senha</span>
              </div>
              <input class="input input-secondary w-full max-w-xs bg-white" type="password" name="password" />
              <?php if (isset($validations['password'])) { ?>
                <div class="label text-sm text-error"><?= $validations['password'][0] ?></div>
              <?php } ?>
            </label>
            <div class="card-actions">
              <button class="btn btn-secondary btn-block text-black">Registrar</button>
              <a href="/login" class="link link-secondary">Já tenho uma conta</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>