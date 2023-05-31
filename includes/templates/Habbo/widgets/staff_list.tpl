<?php
function GetDescr($level)
{
	switch ($level)
	{

                case 8:

                        return 'Due&ntilde;o del Hotel y Administradores';

		case 7:

			return 'Moderaci&oacute;n Principal';

		case 6:

			return 'Moderaci&oacute;n';

		case 5:

			return 'Moderaci&oacute;n Secundaria';

		case 4:

			return 'Moderaci&oacute;n en pruebas';

		case 3:

			return 'Hobba';

		default:

			return '';
	}
}
 ?>

 <div class="ambient-box black">
   <h2 class="title">%about_staff%</h2>
   <div class="ambient-box-content">
     <img src="https:/habboon.pw/web-gallery/v2/images/hiring.png" align="right">
     %about_staff2%
   </div>
 </div>
 <div class="ambient-box black">
   <h2 class="title">%join_team%</h2>
   <div class="ambient-box-content">
     <?php
     $getvars = $conn->prepare("SELECT * FROM `permissions`");
     $getvars->execute();
     while($val = $getvars->fetch()){
       echo $val['id'];
     }


     ?>
   </div>
 </div>
