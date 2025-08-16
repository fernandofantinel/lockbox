<div class="navbar bg-base-100 shadow-sm">
  <div class="flex-1">
    <a href="/notes" class="btn btn-ghost text-xl">LockBox</a>
  </div>
  <div class="flex-none">
    <ul class="menu menu-horizontal px-1">
      <li>
        <?php if (session()->get('showNotes')) { ?>
          <a href="/hide">🔓</a>
        <?php } else { ?>
          <a href="/confirm">🔐</a>
        <?php } ?>
      </li>
      <li>
        <details>
          <summary><?= auth()->name ?></summary>
          <ul class="bg-base-100 rounded-t-none p-2">
            <li><a href="/logout">Logout</a></li>
          </ul>
        </details>
      </li>
    </ul>
  </div>
</div>