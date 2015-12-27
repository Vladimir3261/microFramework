function emailValidate(){
    var keytext = document.forms["regiseter-form"].email.value;
    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
    var email_ok = document.getElementById("email-ok");
   if(pattern.test(keytext)){
      email_ok.style.cssText="display: inline-block;"; 
   }
   else {
       email_ok.style.cssText="display: none;";
   }
}

function validate(){
    var email = document.forms["regiseter-form"].email.value;
    var password = document.forms["regiseter-form"].password.value;
    if(email.length == ''){
        
    }
    return false;
}

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("upload").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
        document.getElementById("uploadPreview").style.display = "block";
    };
}
function registerVerify(){
    alert('reg');
    return false;
}
function chLang(lang){
    document.cookie="language="+lang;
    window.location.reload();
}
function ajaxEmail(email){
    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
    if(pattern.test(email)){
        ajax('email='+email, 'http://test.local/registerprocess/check', function(data){
            if(data.val =="OK"){alert('Ну наконец-то');}else{console.log(data.val);}
             
        });
   }
}

function ajax (data, url, callback) {
  var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
  xmlhttp.open('POST', url, true); // Открываем асинхронное соединение
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
  xmlhttp.send(data); // Отправляем POST-запрос
  xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
    if (xmlhttp.readyState == 4) { // Ответ пришёл
      if(xmlhttp.status == 200) { // Сервер вернул код 200 
                callback(JSON.parse(this.responseText));
            }
        }
    };
 }

function getXmlHttp(){
   var xmlhttp;
   try {
     xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
   catch (e) {
        try {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } 
       catch (E) {
         xmlhttp = false;
       }
    }
   if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
 return xmlhttp;
}