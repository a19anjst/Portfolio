<!DOCTYPE html>
<?php

require_once 'db_connection.php';
if(isset($_POST['Spara'])) {
mysqli_query($conn,"UPDATE texttable SET Info = '" . $_POST['Spara'] . "' WHERE texttable.ID= '1'");
$message = "Record Modified Successfully";
}
$result = mysqli_query($conn,"SELECT* FROM texttable WHERE ID='1'");
$row= mysqli_fetch_array($result);
 ?>
<html lang="sv">
  <head>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/CSS_shared.css">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=PT+Serif&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Chilanka&display=swap');
    </style>
    <script src="https://cdn.tiny.cloud/1/tin4w1iyk6qxzd1q5rmzukk73zb0xfmfe4ay7a62vuws6zbn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="js/tinymce.js" defer></script>
  </head>
  <body>
    <div class="portrait"></div>
    <div class="landscape"></div>
    <nav id="menu">
      <div class="dropdown">
      <a href="index.php" class="menubutton" id="logo-menu-portrait"><img src="css/logo.svg" alt=""></a>
      <button onclick="dropFunction()" class="dropbtn">Meny</button>
      <div id="myDropdown" class="dropdown-content">
        <a href="index.php" class="menubutton" id="logo-menu-landscape"><img src="css/logo.svg" alt="" onmouseover="hoverlogo2(this);" onmouseout="unhoverlogo2(this);"></a>
        <a href="education.php" class="menubutton" id="active"><img src="css/TjänsterOchVerktyg_ikon_black.png" alt="" class="menuicon">Tjänster</a>
        <a href="aboutus.php" class="menubutton"><img src="css/OmOss_ikon.png" alt="" class="menuicon">Om oss</a>
        <a href="info.php" class="menubutton"><img src="css/book-solid.png" alt="" class="menuicon">Fakta</a>
        <?php
          if(isset($_SESSION["token"])){
            echo '<a href="userprofile.php" class="profilebutton"><img src="css/Nätverk_ikon_black.png" alt="" class="menuicon">Profil</a>';
          }
          else{
            echo '<a href="login.php" class="profilebutton"><img src="css/Nätverk_ikon.png" alt="" class="menuicon">Logga in</a>';
          }
        ?>
      </div>
    </div>
    </nav>
    <div class="title" id="title_education">
      <span id="titletext">Tjänster</span>
    </div>
    <div id="textfield">
    <div class="textblock" id="textblock1">
        <div class="content_second">
          <div class="content_dir1">
            <?php
            echo $row[2];
            echo '</div>
        </div>';
          if(isset($_SESSION["token"])){//Visar modal beroende på om man är inloggad
            echo '<button id="editorBtn">Ändra</button>';


              echo '<div id="theEditor" class="editor">';


              echo '<div class="editor-content">';
              echo '<form action="workshops.php" method="post">';//Form för editorn
              echo '<textarea id="Spara" name="Spara" >'. $row[2] .'</textarea>';
              echo '<input type="submit" value="Spara" id="sparaBtn">';
              echo '</form>';
              echo '<span class="close">&times;</span>';//Stäng knapp för modal

              echo '</div>';

            echo '</div>';
          }
          else{
            echo '';
          }
        ?>

      </div>
    </div>
    <script src="js/JS_shared.js"></script><!--script måste kallas här annars blir det problem med modal knappen-->
  </body>
</html>
