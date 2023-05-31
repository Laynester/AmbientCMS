<?php if(isset($_GET['page']) && $_GET['page'] == 2){ ?>
<div class="ambient-box black">
  <h2 class="title">furck u</h2>
  <div class="ambient-box-content">
  </div>
</div>
<?php } elseif(isset($_GET['page']) && $_GET['page'] == 3){ ?>
  <div class="ambient-box black">
    <h2 class="title">%background_picker%</h2>
    <div class="ambient-box-content" id="backgroundPicker">
      <form method="POST">
      <div style="position:sticky;top: 0px;"><input type="submit" style="width:99%;" name="update_background" value="Save Changes"></div>
      <?php habboTheme::profileSettings(1); ?>
    </form>
    </div>
  </div>
<?php } elseif(isset($_GET['page']) && $_GET['page'] == 4){ ?>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script type="text/javascript">
  $(function() {
            $( "#sortable-5" ).sortable();
            $( "#sortable-6" ).sortable();
         });

    function saveOrder() {
  	var selectedLanguage = new Array();
  	$('ul#sortable-5 li').each(function() {
  	selectedLanguage.push($(this).attr("id"));
  	});
  	document.getElementById("row_order").value = selectedLanguage;
    }
    function saveOrder2() {
      var selectedLanguage = new Array();
    	$('ul#sortable-6 li').each(function() {
    	selectedLanguage.push($(this).attr("id"));
    	});
    	document.getElementById("row_order2").value = selectedLanguage;
    }
  </script>
  <div class="ambient-box black">
    <h2 class="title">%widget_placement%</h2>
    <div class="ambient-box-content">
      <form name="frmQA" method="POST" />
      	<input type = "hidden" name="row_order" id="row_order" />
        <div style="width:49.5%;display:inline-block;">
          <label>Column 1</label>
          <ul id="sortable-5">
      		<?php
          habboTheme::profileSettings('2','1');
      		?>
        </ul>
        </div>
        <input type = "hidden" name="row_order2" id="row_order2" />
        <div style="width:49.5%;display:inline-block;">
          <label>Column 2</label>
          <ul id="sortable-6">
          <?php
          habboTheme::profileSettings('2','2');
      		?>
          </ul>
        </div>
        <input type="hidden" name="submit2" onClick="saveOrder2();" />
      	<input type="submit" name="submit" value="Save Order" onClick="saveOrder();saveOrder2();" />
      </form>
    </div>
  </div>
<?php } elseif(isset($_GET['page']) && $_GET['page'] == 5){ ?>
  <div class="ambient-box black">
    <h2 class="title">%hide_widgets%</h2>
    <div class="ambient-box-content">
      <form method="post">
        <?php
        habboTheme::profileSettings(3);
        ?>
        <input type="submit" name="hide_widgets" value="Save Changes">
      </form>
    </div>
  </div>
<?php } elseif(isset($_GET['page']) && $_GET['page'] == 6){ ?>
  <div class="ambient-box black">
    <h2 class="title">%widget_colors%</h2>
    <div class="ambient-box-content" id="headerPicker">
      <?php habboTheme::profileSettings(4); ?>
      <form method="post">
        <label>%h_widget0%</label><br>
        <input hidden name="widget0" value="main">
        <input class="header_color" style="background:#FC5D08;"<?php if(habboProfiles::getProfileWidget('main', 'header_color',habbo_id) == null) {echo 'checked';} ?> type="radio" value="none" name="h_widget0">
        <input class="header_color" style="background:#DB3D44;"<?php if(habboProfiles::getProfileWidget('main', 'header_color',habbo_id) == '#DB3D44') {echo 'checked';} ?> type="radio" value="#DB3D44" name="h_widget0">
        <input class="header_color" style="background:#272727;"<?php if(habboProfiles::getProfileWidget('main', 'header_color',habbo_id) == '#272727') {echo 'checked';} ?> type="radio" value="#272727" name="h_widget0">
        <input class="header_color" style="background:#51a5d5;"<?php if(habboProfiles::getProfileWidget('main', 'header_color',habbo_id) == '#4ab501') {echo 'checked';} ?> type="radio" value="#4ab501" name="h_widget0">
        <input class="header_color" style="background:#4ab501;"<?php if(habboProfiles::getProfileWidget('main', 'header_color',habbo_id) == '#4ab501') {echo 'checked';} ?> type="radio" value="#4ab501" name="h_widget0">
        <input class="header_color" style="background:#4B0082;"<?php if(habboProfiles::getProfileWidget('main', 'header_color',habbo_id) == '#4B0082') {echo 'checked';} ?> type="radio" value="#4B0082" name="h_widget0">
        <input class="header_color" style="background:#FF00FF;"<?php if(habboProfiles::getProfileWidget('main', 'header_color',habbo_id) == '#FF00FF') {echo 'checked';} ?> type="radio" value="#FF00FF" name="h_widget0">
        <br><br>
        <label>%h_widget1%</label><br>
        <input hidden name="widget" value="Info">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('info', 'header_color',habbo_id) == null) {echo 'checked';} ?> style="background:#FC5D08;" type="radio" value="none" name="h_widget1">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('info', 'header_color',habbo_id) == 'red') {echo 'checked';} ?> style="background:#DB3D44;" type="radio" value="red" name="h_widget1">
        <input class="header_color" style="background:#272727;"<?php if(habboProfiles::getProfileWidget('info', 'header_color',habbo_id) == 'black') {echo 'checked';} ?> type="radio" value="black" name="h_widget1">
        <input class="header_color" style="background:#51a5d5;"<?php if(habboProfiles::getProfileWidget('info', 'header_color',habbo_id) == 'blue') {echo 'checked';} ?> type="radio" value="blue" name="h_widget1">
        <input class="header_color" style="background:#4ab501;"<?php if(habboProfiles::getProfileWidget('info', 'header_color',habbo_id) == 'green') {echo 'checked';} ?> type="radio" value="green" name="h_widget1">
        <input class="header_color" style="background:#4B0082;"<?php if(habboProfiles::getProfileWidget('info', 'header_color',habbo_id) == 'indigo') {echo 'checked';} ?> type="radio" value="indigo" name="h_widget1">
        <input class="header_color" style="background:#FF00FF;"<?php if(habboProfiles::getProfileWidget('info', 'header_color',habbo_id) == 'magenta') {echo 'checked';} ?> type="radio" value="magenta" name="h_widget1">
        </br></br>
        <label>%h_widget2%</label><br>
        <input hidden name="widget2" value="badges">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('badges', 'header_color',habbo_id) == null) {echo 'checked';} ?> style="background:#FC5D08;" type="radio" value="none" name="h_widget2">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('badges', 'header_color',habbo_id) == 'red') {echo 'checked';} ?> style="background:#DB3D44;" type="radio" value="red" name="h_widget2">
        <input class="header_color" style="background:#272727;"<?php if(habboProfiles::getProfileWidget('badges', 'header_color',habbo_id) == 'black') {echo 'checked';} ?> type="radio" value="black" name="h_widget2">
        <input class="header_color" style="background:#51a5d5;"<?php if(habboProfiles::getProfileWidget('badges', 'header_color',habbo_id) == 'blue') {echo 'checked';} ?> type="radio" value="blue" name="h_widget2">
        <input class="header_color" style="background:#4ab501;"<?php if(habboProfiles::getProfileWidget('badges', 'header_color',habbo_id) == 'green') {echo 'checked';} ?> type="radio" value="green" name="h_widget2">
        <input class="header_color" style="background:#4B0082;"<?php if(habboProfiles::getProfileWidget('badges', 'header_color',habbo_id) == 'indigo') {echo 'checked';} ?> type="radio" value="indigo" name="h_widget2">
        <input class="header_color" style="background:#FF00FF;"<?php if(habboProfiles::getProfileWidget('badges', 'header_color',habbo_id) == 'magenta') {echo 'checked';} ?> type="radio" value="magenta" name="h_widget2">
        <br><br>
        <label>%h_widget3%</label><br>
        <input hidden name="widget3" value="rooms">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('rooms', 'header_color',habbo_id) == null) {echo 'checked';} ?> style="background:#FC5D08;" type="radio" value="none" name="h_widget3">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('rooms', 'header_color',habbo_id) == 'red') {echo 'checked';} ?> style="background:#DB3D44;" type="radio" value="red" name="h_widget3">
        <input class="header_color" style="background:#272727;"<?php if(habboProfiles::getProfileWidget('rooms', 'header_color',habbo_id) == 'black') {echo 'checked';} ?> type="radio" value="black" name="h_widget3">
        <input class="header_color" style="background:#51a5d5;"<?php if(habboProfiles::getProfileWidget('rooms', 'header_color',habbo_id) == 'blue') {echo 'checked';} ?> type="radio" value="blue" name="h_widget3">
        <input class="header_color" style="background:#4ab501;"<?php if(habboProfiles::getProfileWidget('rooms', 'header_color',habbo_id) == 'green') {echo 'checked';} ?> type="radio" value="green" name="h_widget3">
        <input class="header_color" style="background:#4B0082;"<?php if(habboProfiles::getProfileWidget('rooms', 'header_color',habbo_id) == 'indigo') {echo 'checked';} ?> type="radio" value="indigo" name="h_widget3">
        <input class="header_color" style="background:#FF00FF;"<?php if(habboProfiles::getProfileWidget('rooms', 'header_color',habbo_id) == 'magenta') {echo 'checked';} ?> type="radio" value="magenta" name="h_widget3">
        <br><br>
        <label>%h_widget4%</label><br>
        <input hidden name="widget4" value="Groups">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('groups', 'header_color',habbo_id) == null) {echo 'checked';} ?> style="background:#FC5D08;" type="radio" value="none" name="h_widget4">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('groups', 'header_color',habbo_id) == 'red') {echo 'checked';} ?> style="background:#DB3D44;" type="radio" value="red" name="h_widget4">
        <input class="header_color" style="background:#272727;"<?php if(habboProfiles::getProfileWidget('groups', 'header_color',habbo_id) == 'black') {echo 'checked';} ?> type="radio" value="black" name="h_widget4">
        <input class="header_color" style="background:#51a5d5;"<?php if(habboProfiles::getProfileWidget('groups', 'header_color',habbo_id) == 'blue') {echo 'checked';} ?> type="radio" value="blue" name="h_widget4">
        <input class="header_color" style="background:#4ab501;"<?php if(habboProfiles::getProfileWidget('groups', 'header_color',habbo_id) == 'green') {echo 'checked';} ?> type="radio" value="green" name="h_widget4">
        <input class="header_color" style="background:#4B0082;"<?php if(habboProfiles::getProfileWidget('groups', 'header_color',habbo_id) == 'indigo') {echo 'checked';} ?> type="radio" value="indigo" name="h_widget4">
        <input class="header_color" style="background:#FF00FF;"<?php if(habboProfiles::getProfileWidget('groups', 'header_color',habbo_id) == 'magenta') {echo 'checked';} ?> type="radio" value="magenta" name="h_widget4">
        <br><br>
        <label>%h_widget5%</label><br>
        <input hidden name="widget5" value="guestbook">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('guestbook', 'header_color',habbo_id) == null) {echo 'checked';} ?> style="background:#FC5D08;" type="radio" value="none" name="h_widget5">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('guestbook', 'header_color',habbo_id) == 'red') {echo 'checked';} ?> style="background:#DB3D44;" type="radio" value="red" name="h_widget5">
        <input class="header_color" style="background:#272727;"<?php if(habboProfiles::getProfileWidget('guestbook', 'header_color',habbo_id) == 'black') {echo 'checked';} ?> type="radio" value="black" name="h_widget5">
        <input class="header_color" style="background:#51a5d5;"<?php if(habboProfiles::getProfileWidget('guestbook', 'header_color',habbo_id) == 'blue') {echo 'checked';} ?> type="radio" value="blue" name="h_widget5">
        <input class="header_color" style="background:#4ab501;"<?php if(habboProfiles::getProfileWidget('guestbook', 'header_color',habbo_id) == 'green') {echo 'checked';} ?> type="radio" value="green" name="h_widget5">
        <input class="header_color" style="background:#4B0082;"<?php if(habboProfiles::getProfileWidget('guestbook', 'header_color',habbo_id) == 'indigo') {echo 'checked';} ?> type="radio" value="indigo" name="h_widget5">
        <input class="header_color" style="background:#FF00FF;"<?php if(habboProfiles::getProfileWidget('guestbook', 'header_color',habbo_id) == 'magenta') {echo 'checked';} ?> type="radio" value="magenta" name="h_widget5">
        <br><br>
        <label>%h_widget6%</label><br>
        <input hidden name="widget6" value="stats">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('stats', 'header_color',habbo_id) == null) {echo 'checked';} ?> style="background:#FC5D08;" type="radio" value="none" name="h_widget6">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('stats', 'header_color',habbo_id) == 'red') {echo 'checked';} ?> style="background:#DB3D44;" type="radio" value="red" name="h_widget6">
        <input class="header_color" style="background:#272727;"<?php if(habboProfiles::getProfileWidget('stats', 'header_color',habbo_id) == 'black') {echo 'checked';} ?> type="radio" value="black" name="h_widget6">
        <input class="header_color" style="background:#51a5d5;"<?php if(habboProfiles::getProfileWidget('stats', 'header_color',habbo_id) == 'blue') {echo 'checked';} ?> type="radio" value="blue" name="h_widget6">
        <input class="header_color" style="background:#4ab501;"<?php if(habboProfiles::getProfileWidget('stats', 'header_color',habbo_id) == 'green') {echo 'checked';} ?> type="radio" value="green" name="h_widget6">
        <input class="header_color" style="background:#4B0082;"<?php if(habboProfiles::getProfileWidget('stats', 'header_color',habbo_id) == 'indigo') {echo 'checked';} ?> type="radio" value="indigo" name="h_widget6">
        <input class="header_color" style="background:#FF00FF;"<?php if(habboProfiles::getProfileWidget('stats', 'header_color',habbo_id) == 'magenta') {echo 'checked';} ?> type="radio" value="magenta" name="h_widget6">
        <br><br>
        <label>%h_widget7%</label><br>
        <input hidden name="widget7" value="status">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('status', 'header_color',habbo_id) == null) {echo 'checked';} ?> style="background:#FC5D08;" type="radio" value="none" name="h_widget7">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('status', 'header_color',habbo_id) == 'red') {echo 'checked';} ?> style="background:#DB3D44;" type="radio" value="red" name="h_widget7">
        <input class="header_color" style="background:#272727;"<?php if(habboProfiles::getProfileWidget('status', 'header_color',habbo_id) == 'black') {echo 'checked';} ?> type="radio" value="black" name="h_widget7">
        <input class="header_color" style="background:#51a5d5;"<?php if(habboProfiles::getProfileWidget('status', 'header_color',habbo_id) == 'blue') {echo 'checked';} ?> type="radio" value="blue" name="h_widget7">
        <input class="header_color" style="background:#4ab501;"<?php if(habboProfiles::getProfileWidget('status', 'header_color',habbo_id) == 'green') {echo 'checked';} ?> type="radio" value="green" name="h_widget7">
        <input class="header_color" style="background:#4B0082;"<?php if(habboProfiles::getProfileWidget('status', 'header_color',habbo_id) == 'indigo') {echo 'checked';} ?> type="radio" value="indigo" name="h_widget7">
        <input class="header_color" style="background:#FF00FF;"<?php if(habboProfiles::getProfileWidget('status', 'header_color',habbo_id) == 'magenta') {echo 'checked';} ?> type="radio" value="magenta" name="h_widget7">
        <br><br>
        <label>%h_widget8%</label><br>
        <input hidden name="widget8" value="friends">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('friends', 'header_color',habbo_id) == null) {echo 'checked';} ?> style="background:#FC5D08;" type="radio" value="none" name="h_widget8">
        <input class="header_color"<?php if(habboProfiles::getProfileWidget('friends', 'header_color',habbo_id) == 'red') {echo 'checked';} ?> style="background:#DB3D44;" type="radio" value="red" name="h_widget8">
        <input class="header_color" style="background:#272727;"<?php if(habboProfiles::getProfileWidget('friends', 'header_color',habbo_id) == 'black') {echo 'checked';} ?> type="radio" value="black" name="h_widget8">
        <input class="header_color" style="background:#51a5d5;"<?php if(habboProfiles::getProfileWidget('friends', 'header_color',habbo_id) == 'blue') {echo 'checked';} ?> type="radio" value="blue" name="h_widget8">
        <input class="header_color" style="background:#4ab501;"<?php if(habboProfiles::getProfileWidget('friends', 'header_color',habbo_id) == 'green') {echo 'checked';} ?> type="radio" value="green" name="h_widget8">
        <input class="header_color" style="background:#4B0082;"<?php if(habboProfiles::getProfileWidget('friends', 'header_color',habbo_id) == 'indigo') {echo 'checked';} ?> type="radio" value="indigo" name="h_widget8">
        <input class="header_color" style="background:#FF00FF;"<?php if(habboProfiles::getProfileWidget('friends', 'header_color',habbo_id) == 'magenta') {echo 'checked';} ?> type="radio" value="magenta" name="h_widget8">
        <br><br>
        <br><input type="submit" name="save_colors" value="Save Changes">
      </form>
    </div>
  </div>
<?php } elseif(isset($_GET['page']) && $_GET['page'] == 7){ ?>
  <?php updateLook(); ?>
  <link href="/includes/templates/habbo/style/v1/imaging/app/css/avatargenerate.css" rel="stylesheet" />
  <div class="ambient-box black">
    <h2 class="title">%change_looks%</h2>
    <div class="ambient-box-content">
      <div id="avatarSelector" class="builder-viewport">
        <!-- Main Navigation -->
        <div class="main-navigation">
            <ul>
                <li class="active">
                    <a href="#" data-navigate="hd" data-subnav="gender"><img src="/includes/templates/habbo/style/v1/imaging/app/img/body.png" /></a>
                </li>
                <li>
                    <a href="#" data-navigate="hr" data-subnav="hair"><img src="/includes/templates/habbo/style/v1/imaging/app/img/hair.png" /></a>
                </li>
                <li>
                    <a href="#" data-navigate="ch" data-subnav="tops"><img src="/includes/templates/habbo/style/v1/imaging/app/img/tops.png" /></a>
                </li>
                <li>
                    <a href="#" data-navigate="lg" data-subnav="bottoms"><img src="/includes/templates/habbo/style/v1/imaging/app/img/bottoms.png" /></a>
                </li>
                <li>
                    <a href="#"><img src="/includes/templates/habbo/style/v1/imaging/app/img/saved-looks.png" /></a>
                </li>
            </ul>
        </div>
        <!-- End Main Navigation -->
        <!-- Sub Navigation -->
        <div class="sub-navigation">
            <ul id="gender" class="display">
                <li>
                    <a href="#" class="male nav-selected" data-gender="M"></a>
                </li>
                <li>
                    <a href="#" class="female" data-gender="F"></a>
                </li>
            </ul>
            <ul id="hair" class="hidden">
                <li>
                    <a href="#" class="hair nav-selected" data-navigate="hr"></a>
                </li>
                <li>
                    <a href="#" class="hats" data-navigate="ha"></a>
                </li>
                <li>
                    <a href="#" class="hair-accessories" data-navigate="he"></a>
                </li>
                <li>
                    <a href="#" class="glasses" data-navigate="ea"></a>
                </li>
                <li>
                    <a href="#" class="moustaches" data-navigate="fa"></a>
                </li>
            </ul>
            <ul id="tops" class="hidden">
                <li>
                    <a href="#" class="tops nav-selected" data-navigate="ch"></a>
                </li>
                <li>
                    <a href="#" class="chest" data-navigate="cp"></a>
                </li>
                <li>
                    <a href="#" class="jackets" data-navigate="cc"></a>
                </li>
                <li>
                    <a href="#" class="accessories" data-navigate="ca"></a>
                </li>
            </ul>
            <ul id="bottoms" class="hidden">
                <li>
                    <a href="#" class="bottoms nav-selected" data-navigate="lg"></a>
                </li>
                <li>
                    <a href="#" class="shoes" data-navigate="sh"></a>
                </li>
                <li>
                    <a href="#" class="belts" data-navigate="wa"></a>
                </li>
            </ul>
        </div>
        <!-- End Sub Navigation -->
        <div id="clothes-colors">
            <div id="clothes"></div>
            <div id="colors"></div>
        </div>
        <div id="avatar">
            <img id="myHabbo" src="" alt="My Habbo" title="My Habbo" />
            <form action="" id="avatarSelectionForm" method="POST" name="avatarSelectionPost">
                <input type="hidden" name="habbo-avatar" id="avatar-code">
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
    </div>
  </div>
  <script src="/includes/templates/habbo/style/v1/imaging/app/js/jquery.avatargenerate.js?v=18" type="text/javascript"></script>
  <script>AG.importFigure("%look%");</script>
<?php } else { ?>
<div class="ambient-box black">
  <h2 class="title">%your_profile%</h2>
  <div class="ambient-box-content">
  </div>
</div>
<?php } ?>
