var myNodelist = document.getElementsByTagName("NOTE");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var card = document.createElement("DIV");
  card.classList.add("row");
  card.classList.add("card-panel");
  card.classList.add("col");
  card.classList.add("s12");
  card.classList.add("m8");
  card.classList.add("note-card");
  // var text = document.createElement("H6");
  // text.appendChild(document.createTextNode(myNodelist[i].textContent));
  var text = document.createElement("TEXT");
  text.textContent = myNodelist[i].textContent;
  text.classList.add("note-text");
  card.appendChild(text);
  var span = document.createElement("I");
  var txt = document.createTextNode("check");
  span.classList.add("material-icons");
  span.classList.add("waves-effect");
  span.classList.add("waves-blue");
  span.classList.add("right");
  span.classList.add("close");
  span.appendChild(txt);
  card.appendChild(span);
  myNodelist[i].textContent = "";
  myNodelist[i].appendChild(card);
}

var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function(ev) {
    ev.target.parentNode.classList.toggle("checked");
    ev.target.classList.toggle("checked-mark");
    if(ev.target.textContent === "check") {
      ev.target.parentNode.classList.add("animated", "bounceOutDown");
      ev.target.textContent = "close";
      console.debug("deleting 1 note....");
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        console.debug(this.status, this.readyState, this.responseText);
        if (this.readyState === 4 && this.status === 200) {
          console.debug("[DATABASE] Deleted 1 Note");
        }
      };
      xmlhttp.open("GET", "api/delete_note.php?id=" + ev.target.parentNode.childNodes[0].textContent, true);
      xmlhttp.send();
      setTimeout(function() { removeNote(ev.target.parentNode, true); }, 700);
      setTimeout(function() { removeNote(ev.target.parentNode, true); }, 700);
    }
    else ev.target.textContent = "check";
  }
}

function removeNote(parentNode, state) {
  if(state) {
      //parentNode.parentNode.parentNode.parentNode.classList.add("animated", "bounceInUp");
      parentNode.parentNode.removeChild(parentNode);
    }
    else {

    }
}

function newElement(inputValue) {
  var note = document.createElement("NOTE");
  var card = document.createElement("DIV");
  card.classList.add("row");
  card.classList.add("card-panel");
  card.classList.add("col");
  card.classList.add("s12");
  card.classList.add("m8");
  card.classList.add("note-card");
  // var text = document.createElement("H6");
  // text.appendChild(document.createTextNode(myNodelist[i].textContent));
  var text = document.createElement("TEXT");
  text.textContent = inputValue;
  text.classList.add("note-text");
  card.appendChild(text);
  var span = document.createElement("I");
  var txt = document.createTextNode("check");
  span.classList.add("material-icons");
  span.classList.add("waves-effect");
  span.classList.add("waves-blue");
  span.classList.add("right");
  span.classList.add("close");
  span.appendChild(txt);
  card.appendChild(span);
  note.appendChild(card);
  document.getElementById("notes").appendChild(card);
  for (i = 0; i < close.length; i++) {
    close[i].onclick = function(ev) {
      ev.target.parentNode.classList.toggle("checked");
      ev.target.classList.toggle("checked-mark");
      if(ev.target.textContent === "check") {
        ev.target.parentNode.classList.add("animated", "bounceOutDown");
        ev.target.textContent = "close";
        console.debug("deleting 1 note....");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          console.debug(this.status, this.readyState, this.responseText);
          if (this.readyState === 4 && this.status === 200) {
            console.debug("[DATABASE] Deleted 1 Note");
          }
        };
        xmlhttp.open("GET", "api/delete_note.php?id=" + ev.target.parentNode.childNodes[0].textContent, true);
        xmlhttp.send();
        setTimeout(function() { removeNote(ev.target.parentNode, true); }, 700);
      }
      else ev.target.textContent = "check";
    };
  }
}

function href(url) {
  var win = window.open(url, '_blank');
  win.focus();
}

function msieversion()
{
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0) // If Internet Explorer, return version number
    {
        alert("Internet Explorer Version: " + parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))) + "is no longer supported.");
    }
    else  // If another browser, return 0
    {
        return false;
    }

    return false;
}

function getUserIP(onNewIP) {
  $.getJSON("https://jsonip.com?callback=?", function(data) {
    onNewIP(data.ip);
  });
}


msieversion();
