cliente();
orden();
telefonos();
recibos();
function cliente() {
   $.ajax(
      {
         url: 'controller/menu_controller.php?request=cliente',
         type: 'POST',
         data: {},
         // timeout: 500,     
         success: function (data) {
           // console.log("success");
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj[0].cliente);
            document.getElementById("cliente").innerHTML=obj[0].cliente;

         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
            // $('p').append('Error: ' + errorMessage);
         }
      });
};

function orden() {
   $.ajax(
      {
         url: 'controller/menu_controller.php?request=orden',
         type: 'POST',
         data: {},
         // timeout: 500,     
         success: function (data) {
            const obj = JSON.parse(data);
            document.getElementById("orden").innerHTML=obj[0].orden;

         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
            // $('p').append('Error: ' + errorMessage);
         }
      });
};

function recibos() {
   $.ajax(
      {
         url: 'controller/menu_controller.php?request=recibos',
         type: 'POST',
         data: {},
         // timeout: 500,     
         success: function (data) {
            const obj = JSON.parse(data);
            document.getElementById("recibos").innerHTML=obj[0].recibos;

         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
            // $('p').append('Error: ' + errorMessage);
         }
      });
};

function telefonos() {
   $.ajax(
      {
         url: 'controller/menu_controller.php?request=telefonos',
         type: 'POST',
         data: {},
         // timeout: 500,     
         success: function (data) {
            const obj = JSON.parse(data);
            document.getElementById("telefonos").innerHTML=obj[0].telefonos;

         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
            // $('p').append('Error: ' + errorMessage);
         }
      });
};

