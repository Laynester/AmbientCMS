<div class="ambient-box grey myhabbo" id="myhabbo">
  <h2 class="title">%habboname% <span class="right">%last_sign%: %last_login%</span></h2>
  <div class="ambient-box-content" id="new-personal-info">
    <div class="habbo_info">
      <div id="habbo-plate">
        <?php
        if(ambientUser::userData(habbo_id,'motto') == 'Crikey!'){echo'<img src="/includes/templates/'.THEME.'/style/v1/imaging/personal_info/crikey.gif"/>';}
        elseif(ambientUser::userData(habbo_id,'motto') == 'King of Pop!'){echo'<img src="/includes/templates/'.THEME.'/style/v1/imaging/personal_info/michael_jackson.png"/>';}
        elseif(ambientUser::userData(habbo_id,'motto') == 'Key to '.hotelname){echo'<img src="/includes/templates/'.THEME.'/style/v1/imaging/personal_info/frank_key.gif"/>';}
        elseif(ambientUser::userData(habbo_id,'motto') == 'Frank the gold miner'){echo'<img src="/includes/templates/'.THEME.'/style/v1/imaging/personal_info/frank_miner.gif"/>';}
        elseif(ambientUser::userData(habbo_id,'motto') == 'Frank wants a hug'){echo'<img src="/includes/templates/'.THEME.'/style/v1/imaging/personal_info/frank_hug.gif"/>';}
        elseif(ambientUser::userData(habbo_id,'motto') == 'He just made a mess!'){echo'<img src="/includes/templates/'.THEME.'/style/v1/imaging/personal_info/frank_clean.gif"/>';}
        elseif(ambientUser::userData(habbo_id,'motto') == 'Lost Boy'){echo'<img src="%imager%"/>';}
        else{echo'<img src="%imager%%look%&direction=3&head_direction=3&action=wav"/>';}
        ?>
      </div>
      <div class="enter-hotel-btn">
        <div class="open enter-btn">
          <a href="/client" target="_blank">Play %hotelname%<i></i></a>
          <b></b>
        </div>
      </div>
    </div>
  </div>
  <div class="more information">
      <div class="habbo_info credits">%credits%</div>
      <div class="habbo_info duckets">%duckets%</div>
      <div class="habbo_info diamonds">%diamonds%</div>
  </div>
</div>
