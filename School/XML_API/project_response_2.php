<html lang="sv">
    <head>
        <meta charset="utf-8">
    </head>    
<style>
 @import url('https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap');

  body{
    font-family: "Roboto", sans-serif;
    background: #eeeeee;
    }

  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #223366;
  }

  li {
    float: left;
  }

  li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  li a:hover {
    background-color: #445577;
  }

  .active{
    background-color: #aabbdd;
  }
    th{
      background: black;
      color: white;
  }    
</style>    
<body>
<ul>
<li><a href="project_form_1.php">Kurser</a></li>
  <li><a href="project_form_2.php">Personal</a></li>
  <li><a href="project_form_3.php">Program</a></li>
</ul>  
<table border='1'>
<?php
    if(isset($_POST['staffname'])){
        $indata=$_POST['staffname'];
    }else{
        $indata="Unknown";
    }
    echo "<h2 style='padding: 5px;'>Du har sökt efter ID: ".$indata."</h2>";
    $url="https://wwwlab.iit.his.se/gush/XMLAPI/scheduleservice/staff?login=".$indata;
    $data = file_get_contents($url);
   $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($data);
    
echo "<tr><th>ID</th><th>Förnamn</th><th>Efternamn</th><th>Titel</th><th>Avdelning</th><th>Födelseår</th><th>Telefonnummer</th></tr>";

$stafflist= $dom->getElementsByTagName('STAFF');
foreach ($stafflist as $staff){
    echo "<tr>";
    echo "<td style='background: #E0F0FF;'>".$staff->getAttribute("ID")."</td>";
    echo "<td style='background: #F0FFFF;'>".$staff->getAttribute("FNAME")."</td>";
    echo "<td style='background: #E0F0FF;'>".$staff->getAttribute("LNAME")."</td>";
    echo "<td style='background: #F0FFFF;'>".$staff->getAttribute("TITLE")."</td>";
    echo "<td style='background: #E0F0FF;'>".$staff->getAttribute("DEPARTMENT")."</td>";
    echo "<td style='background: #F0FFFF;'>".$staff->getAttribute("BIRTHYEAR")."</td>";
    echo "<td style='background: #E0F0FF;'>".$staff->getAttribute("TELNR")."</td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>