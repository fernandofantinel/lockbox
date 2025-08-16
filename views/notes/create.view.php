<?php
$validations = flash()->get('validations');
?>

<div class="bg-base-300 rounded-l-box w-56">
  <div class="bg-base-200 p-4 rounded-tl-box">
    + Nova nota
  </div>
</div>

<div class="bg-base-200 rounded-r-box w-full p-10">
  <form action="/notes/create" method="POST" class="flex flex-col space-y-6">

    <label class="form-control w-full">
      <div class="label">
        <span class="label-text">Título</span>
      </div>
      <input type="text" name="title" class="input input-bordered w-full" />
      <?php if (isset($validations['title'])) { ?>
        <div class="label text-sm text-error"><?= $validations['title'][0] ?></div>
      <?php } ?>
    </label>

    <label class="form-control">
      <div class="label">
        <span class="label-text">Sua nota</span>
      </div>
      <textarea name="note" class="textarea textarea-bordered h-24"></textarea>
      <?php if (isset($validations['note'])) { ?>
        <div class="label text-sm text-error"><?= $validations['note'][0] ?></div>
      <?php } ?>
    </label>

    <div class="flex justify-end items-center">
      <button class="btn btn-secondary">Salvar</button>
    </div>
  </form>
</div>