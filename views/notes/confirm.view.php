<?php
$validations = flash()->get('validations');
?>

<div class="bg-base-300 rounded-box w-full text-3xl font-bold pt-20 flex flex-col items-center">
  <form action="/show" method="POST" class="max-w-md flex flex-col gap-4">
    <div class="text-center">Digite a sua senha novamente para ver todas as suas notas descriptografadas</div>
    <label class="form-control">
      <div class="label">
        <span class="label-text">Senha</span>
      </div>
      <input
        class="input input-bordered bg-white text-black px-2"
        type="password"
        name="password" />
      <?php if (isset($validations['password'])) { ?>
        <div class="label text-sm text-error"><?= $validations['password'][0] ?></div>
      <?php } ?>
    </label>
    <button class="btn btn-secondary">Abrir minhas notas</button>
  </form>
</div>