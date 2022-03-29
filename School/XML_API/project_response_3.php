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
<style>
</style> 
<table border='1'>
<?php
    if(($_POST['namesearch'])){
        $indata=$_POST['namesearch'];
    }else{
        $indata="Unknown";
    }
    echo "<h2 style='padding: 5px;'>Du har sökt efter program: ".$indata."</h2>";
    $url="https://wwwlab.iit.his.se/gush/XMLAPI/scheduleservice/programs?namesearch=".$indata;
    $data = file_get_contents($url);
   $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($data);
    
    echo "<tr><th>ID</th><th>Program</th><th>Poäng</th><th>Nivå</th><th>Avdelning</th><th>Studentantal</th><th>Kurser</th></tr>";
    $programs= $dom->getElementsByTagName('PROGRAM');
    foreach ($programs as $program){
    echo "<tr>";
    echo "<td style='background: #E0F0FF;'>".$program->getAttribute("ID")."</td>";
    echo "<td style='background: #F0FFFF;'>".$program->getAttribute("NAME")."</td>";
    echo "<td style='background: #E0F0FF;'>".$program->getAttribute("HP")."</td>";
    echo "<td style='background: #F0FFFF;'>".$program->getAttribute("LEVEL")."</td>";
    echo "<td style='background: #E0F0FF;'>".$program->getAttribute("DEPARTMENT")."</td>";
    echo "<td style='background: #F0FFFF;'>".$program->getAttribute("STUDENTCOUNT")."</td>";
    echo "<td style='background: #E0F0FF;'><table>";
    echo "<tr><th colspan='7'>Period</th></tr>";   
    foreach ($program->childNodes as $period){
        echo "<tr>";
        echo "<td>".$period->getAttribute("NUMBER")."</td>";
        echo "</tr>";
        echo "<tr><th>ID</th><th>Poäng</th><th>Avdelning</th></tr>"; 
        foreach($period->childNodes as $course){
            echo "<tr>";
            echo "<td>".$course->getAttribute("ID")."</td>";
            echo "<td>".$course->getAttribute("HP")."</td>";
            echo "<td>".$course->getAttribute("AREA")."</td>";
            echo "</tr>";
                foreach($course->childNodes as $name){
                    echo "<tr>";
                    $text=trim($name->nodeValue);
                    if($text!=""){
                            echo "<td style='border-bottom: 1px solid black;' colspan='7'>".$text."</td>";
                        }
                    echo "</tr>";
                }
        }
    }
    echo "</td></table>";
    echo "<tr>";
}
echo "<p>Stapeldiagram av studentantal:</p>";    
echo "<div class='graph-container'>";
foreach ($programs as $program){
            echo "<div class='graph-bar' style='height:".$program->getAttribute("STUDENTCOUNT")."px'><div class='graph-text'>".$program->getAttribute("STUDENTCOUNT")."</div></div>";
}
echo "</div>";      

?>
</table>
</body>
</html>