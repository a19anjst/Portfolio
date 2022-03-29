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
    form{
        margin: 5px;
    }
    .skrift{
        margin: 8px;
    }
</style>    
<body>
<ul>
<li><a href="project_form_1.php">Kurser</a></li>
  <li><a href="project_form_2.php">Personal</a></li>
  <li><a href="project_form_3.php">Program</a></li>
</ul> 
   <h2 class="skrift">Sök efter en kurs: </h2>
    <form method='POST' action='project_response_1.php'>
      
    <input type='text' name='COURSE' />
      
    <button>Sök</button>
    </form>
</body>
</html>  