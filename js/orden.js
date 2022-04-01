get_cliente();
const numero = document.getElementById("numero");
const diagnostico = document.getElementById("diagnostico");
const cliente = document.getElementById("cliente");
const estado = document.getElementById("estado");
const detalle = document.getElementById("detalle");
const valor = document.getElementById("valor");
var table = document.getElementById('table');

$("#btn_add").click(function () {
   //insert();
   insert_table();
});

$("#btn_submit").click(function () {
   get_table();
   insert();
   /*if (detalle_array.length != 0) {
      insert();
   }else{
      toastr.error("Ingrese detalle");
   }*/
});

function insert_table() {
   var repeated = false;
   for (var r = 0, n = table.rows.length; r < n; r++) {
      for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
         if (r != 0) {
            if (c == 0) {
               if (table.rows[r].cells[c].innerHTML == detalle.value) {
                  repeated = true;
               }
            }
         }
      }
   }

   if (repeated == false) {
      if (detalle.value != "" || valor.value != "") {
         $('.table tbody').append('<tr><td>' + detalle.value + '</td><td>' + valor.value + '</td></tr>');
      } else {
         toastr.error("Ingrese detalle y valor");
      }
   } else {
      toastr.error("Detalle repetido");
   }

   detalle.value = "";
   valor.value = "";
}

var detalle_array = [];
var valor_array = [];
function get_table() {
   var d = 0;
   var e = 0;
   for (var r = 0, n = table.rows.length; r < n; r++) {
      for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
         if (r != 0) {
            //alert(c);
            // alert(table.rows[r].cells[c].innerHTML);
            if (c == 0) {
               detalle_array[d] = table.rows[r].cells[c].innerHTML;
               d = d + 1;
            }
            if (c == 1) {
               valor_array[e] = table.rows[r].cells[c].innerHTML;
               e = e + 1;
            }
         }
      }
   }
   console.log(detalle_array);
   console.log(valor_array);
}

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
         url: 'controller/orden_controller.php?request=insert',
         type: 'POST',
         data: {
            numero: numero.value, diagnostico: diagnostico.value, cliente: cliente.value, estado: estado.checked,
            detalle: detalle_array, valor: valor_array
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
            } else {
               toastr.success(obj);
               //location.reload();
               clean_fields();
            }
         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
            // $('p').append('Error: ' + errorMessage);
         }
      });
};

function clean_fields() {
   numero.value = "";
   diagnostico.value = "";
   cliente.value = "";
   detalle.value = "";
   valor.value = "";
   $("#tbody").empty();
   detalle_array = [];
   valor_array = [];
}