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
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }else{
        $id="Unknown";
    }
    echo "<h2 style='padding: 5px;'>Du är på mer info om kursen ".$id."</h2>";
    $xml = file_get_contents("https://wwwlab.iit.his.se/gush/XMLAPI/scheduleservice/entries/?id=".$id);
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

echo "<tr><th>ID</th><th>Kurs</th><th>Poäng</th><th>Avdelning</th><th>Klasstillfällen</th></tr>";    
$entries= $dom->getElementsByTagName('COURSE');
foreach ($entries as $course){
    echo "<tr>";
    echo "<td style='background: #E0F0FF;'>".$course->getAttribute("ID")."</td>";
    echo "<td style='background: #F0FFFF;'>".$course->getAttribute("NAME")."</td>";
    echo "<td style='background: #E0F0FF;'>".$course->getAttribute("HP")."</td>";
    echo "<td style='background: #F0FFFF;'>".$course->getAttribute("DEPARTMENT")."</td>";
    echo "<td style='background: #E0F0FF;'><table>";
    echo "<tr><th>Period</th</tr>";
    foreach ($course->childNodes as $period){
        echo "<tr>";
        echo "<td>".$period->getAttribute("NUMBER")."</td>";
        echo "</tr>";
        echo "<tr><th>Starttid</th><th>Sluttid</th><th>Lärare</th><th>Typ</th><th>Klassrum</th><th>Grupp</th><th>Förkortning</th></tr>";
        foreach ($period->childNodes as $entry){
            echo "<tr>";
            echo "<td style='border: 1px dotted black;'>".$entry->getAttribute("STARTTIME")."</td>";
            echo "<td style='border: 1px dotted black;'>".$entry->getAttribute("ENDTIME")."</td>";
            echo "<td style='border: 1px dotted black;'>".$entry->getAttribute("SIGN")."</td>";
            echo "<td style='border: 1px dotted black;'>".$entry->getAttribute("COMMENT")."</td>";
            echo "<td style='border: 1px dotted black;'>".$entry->getAttribute("ROOM")."</td>";
            echo "<td style='border: 1px dotted black;'>".$entry->getAttribute("GROUP")."</td>";
            echo "<td style='border: 1px dotted black;'>".$entry->getAttribute("TYPE")."</td>";
            echo "</tr>";
        }
    }
    echo "</td></table>";
    echo "</tr>";
}
?>
</table>
</body>
</html>