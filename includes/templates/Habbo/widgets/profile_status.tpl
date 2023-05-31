<div class="ambient-box %status_header% status">
  <h2 class="title">%h_widget7%</h2>
  <div class="ambient-box-content" style="max-height:400px;overflow:scroll;">
    <?php if(ambientUser::name2id($_GET['qryName']) == habbo_id){ habboProfiles::statusUpdate(); ?>
      <form method="post" class="status_update">
        <label>%status_label%</label>
        <textarea name="status_message" maxlength="150"onkeydown="return limitLines(this, event)"></textarea>
        <input type="submit" name="status"/>
      </form>
    <?php } habboProfiles::getStatuses(ambientUser::name2id($_GET['qryName'])); ?>
  </div>
</div>
<script>
$('textarea').autoResize();
var keynum, lines = 2;

      function limitLines(obj, e) {
        // IE
        if(window.event) {
          keynum = e.keyCode;
        // Netscape/Firefox/Opera
        } else if(e.which) {
          keynum = e.which;
        }

        if(keynum == 13) {
          if(lines == obj.rows) {
            return false;
          }else{
            lines++;
          }
        }
      }
</script>
