<div class="ambient-box %book_header%">
  <h2 class="title">%h_widget5%</h2>
  <div class="ambient-box-content">
    <?php habboProfiles::GuestBook(ambientUser::name2id($_GET['qryName'])); ?>
  </div>
</div>
<?php if(loggedIn()) { ?>
<div class="ambient-box %book_header% status">
  <div class="ambient-box-content">
    <form method="post" class="status_update">
      <label>%leave_message%</label>
      <textarea name="gb_message" maxlength="150" onkeydown="return limitLines(this, event)"></textarea>
      <input type="submit" name="guestbook"/>
    </form>
  </div>
</div>
<?php } ?>
