user();
function user() {
   $.ajax(
      {
         url: 'controller/menubar_controller.php?request=img',
         type: 'POST',
         data: {},
         // timeout: 500,     
         success: function (data) {
           // console.log("success");
            console.log(data);
            const obj = JSON.parse(data);
            console.log(obj);
            //document.getElementById("imagen_usuario").setAttribute("src", 'img/' + window.location.hostname);

         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log("error");
            // $('p').append('Error: ' + errorMessage);
         }
      });
};

