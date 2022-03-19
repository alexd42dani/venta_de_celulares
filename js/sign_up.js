
document.getElementById("signin").setAttribute("href", 'http://' + window.location.hostname + '/alex_1/signin.html');
val = 0;
val1 = 0;
const name = document.getElementById("name");
const user = document.getElementById("user");
const email = document.getElementById("email");
const pass = document.getElementById("pass");
const pass1 = document.getElementById("pass1");
$("#user").keyup(function () {
    testuser();
});
$("#btn-submit").click(function () {
   //toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
   //console.log("helloo");
   val = 0;
    val = valEmpty(name, val);
    val = valEmpty(user, val);
    val = valEmpty(email, val);
    val = valEmpty(pass, val);
    val = valEmpty(pass1, val);
    val = valpass(pass, pass1, val);
    val = testemail(email, val)
    val = testpass(pass, pass1, val)
   //console.log(val);
   //testuser();
   // val = testuser(user, val);
   //console.log(testuser(email, val));

   if (document.getElementById('agreeTerms').checked) {
      //console.log("val "+val);
      //console.log("val1 "+val1);
     // if (val == 0 && val1 == 0) {
         signup();
      //}
   } else {
      alert("Agree the terms and policy");
   }
});

function valEmpty(p, p2) {
   // const p1 = document.getElementById(p);
   p.setAttribute('class', "form-control");
   if (p.value == "") {
      p.setAttribute('class', "form-control is-invalid");
      return 1;
   }
   if (p2 == 1) {
      return 1
   }
   return 0;
}

function valpass(p1, p2, p3) {
   //const p1 = document.getElementById("pass");
   //const p2 = document.getElementById("pass1");
   //  p1.setAttribute('class', "form-control");
   //  p2.setAttribute('class', "form-control");
   if (p1.value != p2.value) {
      p1.setAttribute('class', "form-control is-invalid");
      p2.setAttribute('class', "form-control is-invalid");
      return 1;
   }
   if (p3 == 1) {
      return 1
   }
   return 0;
}

function testpass(p, p1, p2) {
   var re = /[a-z]\d|\d[a-z]/i;
   var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(\W|_)).{8,}$/;
   p3 = document.getElementById('msg_pass1');
   p3.innerHTML = '';
   if (!re.test(p.value)) {
      p.setAttribute('class', "form-control is-invalid");
      p1.setAttribute('class', "form-control is-invalid");
      p3.innerHTML = 'La contraseña debe tener como minimo ocho caracteres, una letra, mayuscula, minuscula y un caracter';
      return 1;
   }
   if (p2 == 1) {
      return 1;
   }
   return 0;
   return re.test(p) && p.length > 8;
}

function testemail(p, p1) {
   var re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/;
   //var re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
   if (!re.test(p.value)) {
      p.setAttribute('class', "form-control is-invalid");
      //  document.getElementById('msg_email').innerHTML = 'Email incorrecto';
      return 1;
   }
   if (p1 == 1) {
      return 1;
   }
   return 0;
}

function testuser() {
   $.ajax(
      {
         url: 'controller/signup_controller.php?request=usertest',
         type: 'POST',
         data: { user: user.value },
         success: function (data) {
            const obj = JSON.parse(data);
            user.setAttribute('class', "form-control");
            val1 = 0;
            if (obj != null) {
               //  console.log(obj[0].id_user);
               console.log(obj[0]);
               user.setAttribute('class', "form-control is-invalid");
               val1 = 1;
               console.log("1 " + val1);
               return;
            }

         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
         }
      });
   val1 = 0;
   console.log("3 " + val1);
   return;
}

function signup() {
   $.ajax(
      {
         url: 'controller/signup_controller.php?request=signup',
         type: 'POST',
         data: { user: user.value, name: name.value, pass: pass.value, pass1: pass1.value, email: email.value },
         // timeout: 500,     
         success: function (data) {
           // console.log("success");
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj);
            if (obj[0].name != null) {
               toastr.error(obj[0].name)
            }
            if (obj[1].user != null) {
               toastr.error(obj[1].user)
            }
            if (obj[2].email != null) {
               toastr.error(obj[2].email)
            }
            if (obj[3].pass != null) {
               toastr.error(obj[3].pass)
            }
            if (obj[4].pass1 != null) {
               toastr.error(obj[4].pass1)
            }
            /*if (obj[5].message != null) {
               sessionStorage.setItem('message_signup', obj[5].message)
            }*/
            if (typeof obj[5] === 'undefined') {
              // sessionStorage.setItem('message_signup', obj[5].message)
              console.log("undefined");
            }else{
               sessionStorage.setItem('message_signup', obj[5].message)
               window.location.href = 'http://' + window.location.hostname + '/alex_1/signin.html';
            }

            // $('p').append(data.firstName + ' ' + data.middleName + ' ' + data.lastName);
         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
            // $('p').append('Error: ' + errorMessage);
         }
      });
};
