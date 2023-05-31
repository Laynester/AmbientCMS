 <div class="mid_box">
  <div class="loginBox">
    <div class="login">
      <div class="title"><span class="titleText">%i_h1%</span></div>
      <div class="inputFields">
        <form method="post">
          <?php if($_SESSION['error'] == true){echo '<center>'.$_SESSION['emessage'].'</center>';} ?>
          <p>
            <input type="text" name="Username" placeholder="%username%">
          </p>
          <p>
            <input type="password" name="Password" placeholder="%password%">
          </p>
          <p>
            <input type="submit" name="login" value="%i_h1%">
          </p>
          <p>
            <button class="forgotButton">%forgot%</button>
          </p>
        </form>
      </div>
    </div>
  </div>
  <div class="indexBox">
    <div class="register">
      <button class="registerButton" onclick="window.location.href='/register';"><span class="registerAboveText">%i_r2%</span> <span class="registerUnderText">%i_r3%</span></button>
    </div>
  </div>
</div>
