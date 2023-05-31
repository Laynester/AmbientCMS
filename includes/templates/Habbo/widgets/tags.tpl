<?php if(ambientCore::siteConfig('user_tags') == '1'){ ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="ambient-box green" id="tabs">
  <h3 class="title with_tabs">
    %interests%
    <ul class="habbo-tabs">
      <li class="active"><a data-toggle="tab" href="#interests">%my_interests%</a></li>
      <li><a data-toggle="tab" href="#more_tags">%hot_now%</a></li>
    </ul>
  </h3>
  <div class="tab-content">
    <div id="interests" class="tab-pane active">
      <div style="border-bottom:1px dashed #CCCBCB;">
        <div class="ambient-box-content">
          %tags_desc%
        </div>
      </div>
      <div class="ambient-box-content">
        <form method="post">
        <?php habboTheme::meTags(); ?>
          <span class="right"><input type="text" name="add_tag"><input type="submit" name="1_add_tag" value="%add%"></span>
        </form>
      </div>
    </div>
    <div id="more_tags" class="tab-pane">
      hi
    </div>
  </div>
</div>
<?php } ?>
