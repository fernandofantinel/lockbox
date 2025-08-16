<?php
$validations = flash()->get('validations');
?>

<div class="bg-base-300 rounded-l-box w-56 flex flex-col divide-y divide-base-100">
  <?php foreach ($notes as $key => $note): ?>
    <a href="/notes?id=<?= $note->id ?><?= request()->get('search', '', '&search=') ?>"
      class="w-full p-2 cursor-pointer hover:bg-base-200
      <?php if ($key == 0) { ?> rounded-tl-box <?php } ?>
      <?php if ($note->id == $selectedNote->id) { ?> bg-base-200 <?php } ?>
    ">
      <?= $note->title ?> <br />
      <span class="text-xs">Atualizada: <?= $note->updatedDate()->locale('pt_BR')->diffForHumans() ?></span>
    </a>
  <?php endforeach; ?>
</div>
<div class="bg-base-200 rounded-r-box w-full p-10 flex flex-col space-y-6">
  <form action="/note" method="POST" id="form-update">
    <input type="hidden" name="__method" value="PUT" />
    <input type="hidden" name="id" value="<?= $selectedNote->id ?>" />
    <label class=" form-control w-full">
      <div class="label">
        <span class="label-text">Título</span>
      </div>
      <input type="text" name="title" class="input input-bordered w-full" value="<?= $selectedNote->title ?>" />
      <?php if (isset($validations['title'])) { ?>
        <div class="label text-sm text-error"><?= $validations['title'][0] ?></div>
      <?php } ?>
    </label>
    <label class="form-control">
      <div class="label">
        <span class="label-text">Sua nota</span>
      </div>
      <textarea
        <?php if (! session()->get('showNotes')) { ?> disabled <?php } ?>
        name="note"
        class="textarea textarea-bordered h-24"><?= $selectedNote->note() ?></textarea>
      <?php if (isset($validations['note'])) { ?>
        <div class="label text-sm text-error"><?= $validations['note'][0] ?></div>
      <?php } ?>
    </label>
  </form>

  <div class="flex justify-between items-center">
    <form action="/note" method="POST">
      <input type="hidden" name="__method" value="DELETE" />
      <input type="hidden" name="id" value="<?= $selectedNote->id ?>" />
      <button class="btn btn-error" type="submit">Remover</button>
    </form>
    <button class="btn btn-secondary" type="submit" form="form-update">Atualizar</button>
  </div>
</div>