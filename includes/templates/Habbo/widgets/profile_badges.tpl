<div class="ambient-box %badges_header%">
  <h2 class="title">%h_widget2%<?php habboProfiles::getBadges(ambientUser::name2id($_GET['qryName']),1); ?></h2>
  <div class="ambient-box-content" style="max-height:250px;overflow:scroll;">
    <?php habboProfiles::getBadges(ambientUser::name2id($_GET['qryName']),2); ?>
  </div>
</div>
