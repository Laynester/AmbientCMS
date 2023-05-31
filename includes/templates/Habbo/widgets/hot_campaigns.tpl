<?php if(ambientCore::siteConfig('campaigns_enabled') == '1'){ ?>
<div class="ambient-box">
  <h2 class="title">%campaigns%</h2>
  <div class="ambient-box-content">
    <?php habboTheme::getCampaigns(); ?>
  </div>
</div>
<?php } ?>
