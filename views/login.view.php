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
      <form method="POST" action="/login">
        <div class="card">
          <div class="card-body">
            <div class="card-title">Faça o seu login</div>
            <?php require base_path('views/partials/_message.view.php'); ?>
            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Email</span>
              </div>
              <input
                class="input input-secondary w-full max-w-xs bg-white px-2"
                type="email"
                name="email"
                value="<?= old('email') ?>" />
              <?php if (isset($validations['email'])) { ?>
                <div class="label text-sm text-error"><?= $validations['email'][0] ?></div>
              <?php } ?>
            </label>

            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Senha</span>
              </div>
              <input
                class="input input-secondary w-full max-w-xs bg-white px-2"
                type="password"
                name="password" />
              <?php if (isset($validations['password'])) { ?>
                <div class="label text-sm text-error"><?= $validations['password'][0] ?></div>
              <?php } ?>
            </label>
            <div class="card-actions">
              <button class="btn btn-secondary btn-block">Login</button>
              <a href="/register" class="link link-secondary">Quero me registrar</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>