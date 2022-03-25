get_cliente();
const marca = document.getElementById("marca");
const modelo = document.getElementById("modelo");
const serie = document.getElementById("serie");
const contrasena = document.getElementById("contrasena");
const color = document.getElementById("color");
const cliente = document.getElementById("cliente");
const memoria = document.getElementById("memoria");
const sim = document.getElementById("sim");

$("#btn_submit").click(function () {
   insert();
});

function get_cliente() {
   $.ajax(
      {
         url: 'controller/telefono_controller.php?request=cliente',
         type: 'POST',
         data: {},
         success: function (data) {
            //console.log(data);
            const obj = JSON.parse(data);
            console.log(obj);
            ///console.log(obj.length);
            var clientes = [];
            for (var i = 0; i < obj.length; i++) {
               clientes.push('<option value="',
                  obj[i].id, '">',
                  "-Nombre: ", obj[i].nombre, ' -Apellido: ', obj[i].apellido,
                  " -Cedula : ", obj[i].numero_cedula, '</option>');
            }
            $("#cliente").html(clientes.join(''));
         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
         }
      });
}

function insert() {
   $.ajax(
      {
         url: 'controller/telefono_controller.php?request=insert',
         type: 'POST',
         data: {
            marca: marca.value, modelo: modelo.value, serie: serie.value, contrasena: contrasena.value,
            color: color.value, cliente: cliente.value, memoria: memoria.checked, sim: sim.checked
         },
         // timeout: 500,     
         success: function (data) {
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj);
            if (obj != "New record created successfully") {
               for (let index = 0; index < obj.length; index++) {
                  if (obj[index] != null) {
                     toastr.error(obj[index]);
                  }
               }
            }
         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
            // $('p').append('Error: ' + errorMessage);
         }
      });
};
