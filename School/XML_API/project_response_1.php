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
  .graph-bar{
      display:inline-block;
      width:20px;
      background-color:darkcyan;
      margin-right:2px;
      position:relative;
  }
  .graph-text{
      position:absolute;
      top:2px;
      left:2px;
      right:2px;
      text-align:center;
      color:white;
      font-size:8px;
  }
  .graph-container{
      display:inline-block;
      padding: 20px 40px 5px 40px;
      margin-bottom: 10px;
      margin-top: 0px;
      border:2px solid black;
      background: white;
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
    if(isset($_POST['COURSE'])){
        $indata=$_POST['COURSE'];
    }else{
        $indata="ALL";
    }
    echo "<h2 style='padding: 5px;'>Du letar bland: ".$indata."</h2>";
 $xml = file_get_contents("https://wwwlab.iit.his.se/gush/XMLAPI/scheduleservice/courses/?coursename=".$indata);
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);

echo "<tr><th>ID</th><th>Kurs</th><th>Poäng</th><th>Avdelning</th><th>Klass</th></tr>";    
$courses= $dom->getElementsByTagName('COURSE');   
foreach ($courses as $course){
    echo "<tr>";
    echo "<td style='background: #E0F0FF;'><a href='project_response_4.php?id=".$course->getAttribute("ID")."'>".$course->getAttribute("ID")."</a></td>";
    echo "<td style='background: #F0FFFF;'>".$course->getAttribute("NAME")."</td>";
    echo "<td style='background: #E0F0FF;'>".$course->getAttribute("HP")."</td>";
    echo "<td style='background: #F0FFFF;'>".$course->getAttribute("DEPARTMENT")."</td>";
    echo "<td style='background: #E0F0FF;'><table>";
    echo "<tr><th>Period</th</tr>";
    foreach ($course->childNodes as $period){
        echo "<tr>";
        echo "<td>".$period->getAttribute("NUMBER")."</td>";
        echo "</tr>";
        echo "<tr><th>ID</th><th>Klass</th><th>Studentantal</th><th>Avdelning</th></tr>";
        foreach ($period->childNodes as $program){
            echo "<tr>";
            echo "<td style='border: 1px dotted black;'>".$program->getAttribute("ID")."</td>";
            echo "<td style='border: 1px dotted black;'>".$program->getAttribute("NAME")."</td>";
            echo "<td style='border: 1px dotted black;'>".$program->getAttribute("STUDENTCOUNT")."</td>";
            echo "<td style='border: 1px dotted black;'>".$program->getAttribute("DEPARTMENT")."</td>";
            echo "</tr>";
        }
    }
    echo "</td></table>";
    echo "<tr>";
}
echo "<p>Stapeldiagram av studentantal:</p>";    
echo "<div class='graph-container'>";
foreach ($courses as $course){
    foreach ($course->childNodes as $period){
        foreach ($period->childNodes as $program){
            echo "<div class='graph-bar' style='height:".$program->getAttribute("STUDENTCOUNT")."px'><div class='graph-text'>".$program->getAttribute("STUDENTCOUNT")."</div></div>";
        }
    }
}
echo "</div>";     
?>
</table>
</body>
</html>