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
</style>    
<body>
<ul>
<li><a href="project_form_1.php">Kurser</a></li>
  <li><a href="project_form_2.php">Personal</a></li>
  <li><a href="project_form_3.php">Program</a></li>
</ul>    
<?php
echo "<h2 style='margin: 8px;'>Välj personal baserat på ID: </h2>";
echo "<form method='POST' action='project_response_2.php' style='margin: 5px;'>";
 
 $xml = file_get_contents('https://wwwlab.iit.his.se/gush/XMLAPI/scheduleservice/staff?login=ALL');
    $dom = new DomDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($xml);
    
    $stafflist = $dom->getElementsByTagName('STAFF');
    foreach ($stafflist as $staff){
    $arr[$staff->getAttribute("ID")]=$staff->getAttribute("ID");
    }
    echo "<select name='staffname'>";
    echo "<option value='ALL'>All staff</option>";
    foreach ($arr as $id){
        echo "<option value='".$id."'>";
        echo $id; 
        echo "</option>";
    }
    echo "</select>";
    echo "<button style='margin-left: 5px;'>Sök</button>";
echo "</form>";
?> 
</body>
</html>  