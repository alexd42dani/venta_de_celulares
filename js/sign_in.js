/*$.ajax('/jquery/getjsondata', 
{
    type: 'GET',
    data: {}, 
   // timeout: 500,     
    success: function (data,status,xhr) {   
       // $('p').append(data.firstName + ' ' + data.middleName + ' ' + data.lastName);
    },
    error: function (jqXhr, textStatus, errorMessage) { 
       // $('p').append('Error: ' + errorMessage);
    }
});*/

const user = document.getElementById("user");
const pass = document.getElementById("pass");

$("#btn-submit").click(function () {
   //alert( "Handler for .click() called." );
   valEmpty(user);
   valEmpty(pass);
   signin();
});

var msg_signup = sessionStorage.getItem('message_signup');
//toastr.success(msg_signup);
if (msg_signup != null){
   toastr.success(msg_signup);
   sessionStorage.clear();
   //window.sessionStorage.removeItem(msg_signup);
}

function valEmpty(p) {
   p.setAttribute('class', "form-control");
   if (p.value == "") {
      p.setAttribute('class', "form-control is-invalid");
   }
}

function signin() {
   $.ajax(
      {
         url: 'controller/signin_controller.php?request=signin',
         type: 'POST',
         data: { user: user.value, pass: pass.value},
         // timeout: 500,     
         success: function (data) {
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj);
            if (obj[0].user != null) {
               toastr.error(obj[0].user)
            }
            if (obj[1].pass != null) {
               toastr.error(obj[1].pass)
            }
           // console.log(obj[2].message);
            if (obj[2].message == "Contraseña o usuario incorrectas") {
               toastr.error(obj[2].message)
            }else{
               console.log("login");
               console.log(data);
             //  localStorage.setItem('message_signup', obj[5].message)
               window.location.href = 'http://' + window.location.hostname + '/venta_de_celulares/menu.php';
            }
         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
            // $('p').append('Error: ' + errorMessage);
         }
      });

};