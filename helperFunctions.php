<?php
   function writeHead($path = "")
   {
      echo "<meta charset='utf-8' />\n";
      echo "<script src='//code.jquery.com/jquery-1.10.2.js'></script>\n";
      echo "<script src='//code.jquery.com/ui/1.11.4/jquery-ui.js'></script>\n";
      echo "<script src='$path"."js/bootstrap.js' ></script>\n";

      //<!-- forcing the mobile view for phones -->
      echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
      echo "<link rel='shortcut icon' href='$path"."img/ico.ico' />\n";
      echo "<link rel='stylesheet' href='$path"."css/bootstrap.min.css' >\n";
      echo "<link rel='stylesheet' href='$path"."css/basic.css' type='text/css'/>\n";
   }

   function writeNav($path = "", $activeTab)
   {

      echo  "<div class='navbar navbar-inverse navbar-static-top'>\n";
      echo  "  <div class='container'>\n";
      echo  "     <div class='navbar-header'>\n";
      echo  "        <a href='$path"."index.php' class='navbar-brand'>Slayersoft</a>\n";
      echo  "        <button class='navbar-toggle' data-toggle='collapse' data-target='.navHeaderCollapse'>\n";
      echo  "        <span class='icon-bar'></span>\n";
      echo  "        <span class='icon-bar'></span>\n";
      echo  "        <span class='icon-bar'></span>\n";
      echo  "        </button>\n";
      echo  "     </div>\n";
      echo  "     <div class='collapse navbar-collapse navHeaderCollapse'>\n";
      echo  "        <ul class='nav navbar-nav navbar-right'>\n";
      if ($activeTab == "Home")
         echo "           <li class='active'>";
      else
         echo "           <li>";
      echo  "<a href='$path"."index.php' title='Home'>Home</a></li>\n";

      if ($activeTab == "Projects")
         echo "           <li class='active dropdown'>\n";
      else
         echo "           <li class='dropdown'>\n";
      echo "              <a href='#' class='dropdown-toggle' data-toggle='dropdown' title='Projects'>Social Media <b class='caret'></b></a>\n";
      echo "              <ul class='dropdown-menu'>\n";
      echo "                 <li><a href='#' title='Facebook'>Facebook</a></li>\n";
      echo "                 <li><a href='#' title='Google Plus'>Google Plus</a></li>\n";
      echo "                 <li><a href='https://www.linkedin.com/in/elfre-valdes-7080685a?' title='Linkedin'>Linkedin</a></li>\n";
      echo "              </ul>\n";
      echo "           </li>\n";

      if ($activeTab == "Contact")
         echo "<li class='active'>";
      else
         echo "           <li>";
      echo  "<a href='#contact' data-toggle='modal' title='Contact'>Contact</a></li>\n";
      // $path"."coming_soon.php
      if(!$path == "")
         echo  "           <li><a href='$path"."logout.php' title='Contact'>Logout <span class='glyphicon glyphicon-user'></span></a></li>\n";
      echo  "       </ul>\n";
      echo  "     </div>\n";
      echo  "  </div>\n";
      echo  "</div>\n";
   }

   function writeFooter($path = "")
   {
      $fecha = date('Y');
      echo  "<div class='clearfooter'></div>\n";
      echo  "<div class='navbar navbar-inverse navbar-bottom footer'>\n";
      echo  "  <div class='container'>\n";
      echo  "  <p class='navbar-text'> Copyright Slayersoft $fecha"."®</p>";
      echo  "  </div>\n";
      echo  "</div><br/>\n";

      echo " <div class='modal fadein' id='contact' role='dialog'>\n";
      echo " <div class='modal-dialog'>\n";
      echo "       <div class='modal-content'>\n";
      echo "          <div class='modal-header'>\n";
      echo "             <h4>\n";
      echo "                Contact me\n";
      echo "             </h4>\n";
      echo "          </div>\n";
      echo "          <div class='modal-body'>\n";
      echo "             <p>\n";
      echo "               Sorry not working quite yet :(\n";
      echo "             </p>\n";
      echo "          </div>\n";
      echo "          <div class='modal-footer'>\n";
      echo "             <a class='btn btn-default' data-dismiss='modal'>Close</a>\n";
      echo "             <a class='btn btn-primary' data-dismiss='modal'>Send</a>\n";
      echo "          </div>\n";
      echo "       </div>\n";
      echo "    </div>\n";
      echo " </div>\n";
   }
 ?>
