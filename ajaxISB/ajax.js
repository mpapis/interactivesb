<!--
function getHttpRequest()
{
    var req;
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        req = null;
    }
    return req;
}

var disp_req = getHttpRequest();
var stat_req = getHttpRequest();
var mesg_req = getHttpRequest();

var user_pos = -1;
var user = "";
var ka1 = setInterval("refreshStatus()",  5000);
var ka2 = setInterval("refreshMessages()",3333);

function initISB()
{
  document.all.msg_text.focus();
  var loc = new String(window.location);
  user_pos = loc.indexOf("?name="); //if -1 no user name specified
  if (user_pos>-1)
  {
    user = loc.substring(user_pos+6,9999);
    refreshStatus();
    refreshMessages();
  }
  else
  {
    clearInterval(ka1);
    clearInterval(ka2);
    user_pos=0;
    user=prompt("Podaj nazwe uytkownika","");
    if (user!=null)
    {
      window.location += "?name="+user;
      window.reload();
      return;
    }
  }
}

function sendMessageResponse()
{
  // only if req shows "complete"
  if (mesg_req.readyState == 4) {
    // only if not "OK"
    if (mesg_req.status == 200) {
      refreshMessages();
    }
    else
    {
      alert("Niepowiodo si�wysyanie wiadomoci:\n" + mesg_req.statusText);
    }
  }
}

function sendMessage()
{
  if (user_pos>-1)
  {
    mesg_req.open("GET","write.php?name="+user+"&body="+document.getElementById("msg_text").value);
    mesg_req.onreadystatechange = sendMessageResponse;
    mesg_req.send("name="+user+"&body="+document.getElementById("msg_text").value);
    document.getElementById("msg_text").value = "";
  }
  return false;
}

function refreshStatusResponse()
{
  // only if req shows "complete"
  if (stat_req.readyState == 4) {
    // only if not "OK"
    if (stat_req.status == 200) {
      document.getElementById("status").innerHTML=stat_req.responseText;
    } else {
      document.getElementById("status").innerHTML=user+"<br />Niemona pobra�listy uytkownik�<br />"+stat_req.statusText;
    }
  }
}

function refreshStatus()
{
  if (user_pos>-1)
  {
    stat_req.open("GET","status.php?name="+user);
    stat_req.onreadystatechange = refreshStatusResponse;
    stat_req.send("name="+user);
  }
}

function refreshMessagesResponse()
{
  // only if req shows "complete"
  if (disp_req.readyState == 4) {
    // only if not "OK"
    if (disp_req.status == 200) {
      document.getElementById("display").innerHTML=disp_req.responseText;
    } else {
      document.getElementById("display").innerHTML="Interaktywny ShoutBox, Niemona pobra�wiadomoci<br />"+disp_req.statusText;
    }
  }
}

function refreshMessages()
{
  if (user_pos>-1)
  {
    disp_req.open("GET","messages.php");
    disp_req.onreadystatechange = refreshMessagesResponse;
    disp_req.send("");
  }
}

//-->
