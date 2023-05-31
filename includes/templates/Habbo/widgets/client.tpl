<style>
.loader .loader-image{
    background-image:url(%logo%);
  }
  .loader {background:%bgcolor%;}
</style>
<link rel="stylesheet" href="%www%/includes/templates/Habbo/style/v1/css/client.css?%nocache%" type="text/css">
<script type="text/javascript" src="%www%/includes/templates/habbo/style/v1/js/swfobject.js"></script>
</head>

<body>
  <?php if(isset($_GET['error'])){ ?>
    <div id="client-disconnect-overlay" class="client-disconnect-overlay default-cursor not-selectable" unselectable="on">
<div class="client-landing-image client-landing-left"></div>
<div class="client-landing-image client-landing-right"></div>
<div class="client-disconnect-logo"></div>
<div class="client-disconnect-info centered">
<form action="%www%/client" method="post">
<button type="submit" id="disconnect-reload-button" class="disconnect-button button button-green uppercase rounded black-outline">
Reconnect
</button>
</form>
</div>
</div>

  <?php } else { ?>
  <script type="text/javascript">
      var BaseUrl = "%swf_base%";
      var flashvars =
      {
          "client.starting" : "Please wait! %hotelname% is starting up.",
  "client.starting.revolving":"For science, you monster\/Loading funny message\u2026please wait.\/Would you like fries with that?\/Follow the yellow duck.\/Time is just an illusion.\/Are we there yet?!\/I like your t-shirt.\/Look left. Look right. Blink twice. Ta da!\/It's not you, it's me.\/Shhh! I'm trying to think here.\/Loading pixel universe.",
          "client.allow.cross.domain" : "1",
          "client.notify.cross.domain" : "1",
          "connection.info.host":"%client_ip%",
          "connection.info.port":"%client_port%",
          "site.url" : "%www%",
          "url.prefix" : "%www%",
          "client.reload.url" : "%www%/client/error",
          "client.fatal.error.url" : "%www%/client/error",
          "client.connection.failed.url" : "%www%/client/error",
  "logout.url" : "%www%/client/error",
  "logout.disconnect.url" : "%www%/client/error",
          "external.variables.txt" : "%client_variables%",
          "external.texts.txt" : "%client_flash_texts%",
  "external.override.texts.txt" : "%client_override_texts%",
  "external.override.variables.txt" : "%client_override_variables%",
          "productdata.load.url" : "%client_productdata%",
          "furnidata.load.url" : "%client_furnidata%",
  "external.figurepartlist.txt" : "%client_figuredata%",
  "use.sso.ticket" : "1",
          "sso.ticket" : "%user_sso%",
          "processlog.enabled" : "0",
          "flash.client.url" : BaseUrl,
          "flash.client.origin" : "popup"
      };
      var params =
      {
          "base" : "%swf_base%",
          "allowScriptAccess" : "always",
          "menu" : "false"
      };
      swfobject.embedSWF(BaseUrl + "/%swf%", "client", "100%", "100%", "10.0.0", "", flashvars, params, null, null);
    </script>
    <script src="%www%/includes/templates/habbo/style/v1/js/loader.js?%nocache%"></script>
    <div id="client">
    <habbo-client-error>
    <div class="client-error__background-frank">
    <span class="client-error__text-contents">
    <h1 class="client-error__title" translate="CLIENT_ERROR_TITLE">You're nearly in %hotelname%</h1>
    <p translate="CLIENT_ERROR_FLASH">Click the yellow Hotel button below, then click 'run Flash' when prompted to. See you in the Hotel!</p>
    </span>
    <div class="client-error__hotel-button-div">
    <a target="_blank" rel="noopener noreferrer" class="hotel-button" href="http://www.adobe.com/go/getflashplayer"><span class="hotel-button__text" translate="NAVIGATION_HOTEL">Hotel</span></a>
    </div>
</div>
</habbo-client-error>
</div>
<?php } ?>
</body>
