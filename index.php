
  <!DOCTYPE html>
  <html lang="de">
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i|Roboto:100,100i,300,300i,400,400i" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="style.css" />
          <title>
            Open Notes - My Notes
          </title>
          <!--[if IE]>
        <center>
            <h1>Sorry, Internet Explorer is not supported.<h1>
                Get a newer Browser, for example <a href="http://firefox.com">Firefox</a> or <a href="http://chrome.google.com">Chrome</a>
        </center>
         <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
         <![endif]-->
    </head>

    <body>

      <nav>
       <div class="nav-wrapper white">
         <div class="left">
           <img style="position: relative; top: 5px;" src="images/logo.png" width=48px height=48px> <span class="black-text brand-logo" style="position: relative; bottom: 10px; left: 8px; font-size:18px">Open Notes</span>
         </div>
         <ul id="nav-mobile" class="right">
           <li class="waves waves-dark" style="font-family:'Questrial'"><a class="black-text" href="index.html">My Notes</a></li>
           <li class="waves waves-dark" style="font-family:'Questrial'"><a class="black-text" href="login.html">Login with personal key</a></li>
         </ul>
       </div>
     </nav>

     <div class="container">
          <!-- Body -->
          <TEXT style="font-family: 'Roboto'; font-weight: 100; font-size: 60px;">Pending notes</TEXT>
          <div id="container" class="void">
            <notes id="notes">

                <?php

                include "api/Database.php";
                $db = connect();
                $id = "id=" . $_COOKIE['id'];
                $res = $db->query("SELECT * FROM notes WHERE added = '{$id}'");
                $data = $res->fetch_all(MYSQLI_ASSOC);
                if(count($data) <= 0) {
                    echo "<note>Add more Notes!</note>\n";
                } else {
                    foreach ($data as $note) {
                        echo "<note>{$note['contents']}</note>\n";
                    }
                }
                echo "<span style='position:fixed;right:0px;bottom:0px;color:white'>" . $_COOKIE['id'] . "</span>";

                ?>
            </notes>
          </div>
     </div>

      <script>
          $(document).ready(function(){
              $('.modal').modal();
              if(!(document.cookie.length > 5)) {
                document.cookie = "id=" + Math.random();
                document.location("index.php");
              }
          });
      </script>

      <a style="background-color:#578af2;position: fixed;right: 15px;bottom: 15px;" class="btn-floating btn-large waves-effect waves-light modal-trigger" href="#modal1"><i class="material-icons">add</i></a>
      <div id="modal1" class="modal">
          <div class="modal-content">
              <h4>Add a new Note</h4>
              <p id="helper">Please enter a Note to be added</p>
              <div class="row">
                  <div class="input-field col s12">
                      <input id="note" type="text">
                      <label for="note">Note</label>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <a href="#!" onclick="addNote()" class="waves-effect waves-green btn-flat">Add Note</a>
          </div>
      </div>

      <script>

          function addNote() {
              var note = $("#note").val();
              if(note.length < 3) {
                  $("#helper").html("Please enter a Note longer than " + note.length + " characters!");
              } else {
                  getUserIP(function (addr) {
                      console.debug("preparing to upload note....", "USER COOKIE: " + document.cookie);
                      var xmlhttp = new XMLHttpRequest();
                      xmlhttp.onreadystatechange = function() {
                          console.debug(this.status, this.readyState, this.responseText);
                          if (this.readyState === 4 && this.status === 200) {
                              console.debug("[DATABASE] Uploaded 1 Note");
                          }
                      };
                      xmlhttp.open("GET", "api/add_note.php?addr=" + document.cookie + "&note=" + note, true);
                      xmlhttp.send();
                  });
                  newElement(note);
                  $('.modal').modal("close");
              }
              console.debug(note);
          }

      </script>

      <script type="text/javascript" src="main.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
