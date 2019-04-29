  

$(document).ready(function() {

       //add siteoption
       $("#addModal form").on('submit', function(e){
        if (!e.isDefaultPrevented())
        {
          var self = $(this);
          var data = convert(self.serialize());
          $.ajax({
            url: self.closest('form').attr('action'),
            type: "POST",
            data: self.serialize(),
            beforeSend: function(){
                var values = Object.values(data);
                for (i = 0; i < values.length; i++) {
                    if (values[i] == "")
                        return false;
                }
            },
            success: function(res){
              $('.addForm')[0].reset();
                $('#addModal').modal('hide');
              swal({
                title: "Created successfully",
                type: "success",
                closeOnConfirm: false,
                confirmButtonText: "OK !",
                confirmButtonColor: "#ec6c62",
                allowOutsideClick: true
              });
              oTable.draw();
            },
            error: function(){
              // $('#addModal').modal('hide');
              swal({
                title: "Error ocurred, check form",
                type: "error",
                closeOnConfirm: false,
                confirmButtonText: "OK !",
                confirmButtonColor: "#ff0000",
                allowOutsideClick: true
              });
            }
          });
          e.preventDefault();
        }
      });

      //Update
      $("#editModal form").validator().on('submit', function(e){
       if (!e.isDefaultPrevented())
       {
         var self = $(this);
           var data = convert(self.serialize());
         $.ajax({
           url: self.closest('form').attr('action') + "/" +  self.attr("data-id"),
           type: "POST",
           data: "_method=PUT&" + self.serialize(),
             beforeSend: function(){
                 var values = Object.values(data);
                 for (i = 0; i < values.length; i++) {
                     if (values[i] == "")
                         return false;
                 }
             },
           success: function(res){
             $('#editModal').modal('hide');
             swal({
              title: "Updated successfully",
              type: "success",
              closeOnConfirm: false,
              confirmButtonText: "OK !",
              confirmButtonColor: "#ec6c62",
              allowOutsideClick: true
            });
             oTable.draw();
           },
           error: function(){
             // $('#editModal').modal('hide');
             swal({
              title: "Error updating data, check form",
              type: "error",
              closeOnConfirm: false,
              confirmButtonText: "OK !",
              confirmButtonColor: "#ff0000",
              allowOutsideClick: true
            });
           }
         });
         e.preventDefault();
       }
     });


    function convert(str){
        str = str.replace(/\(|\)/g,'');
        var arr = str.split('&');
        var obj = {};
        for (var i = 0; i < arr.length; i++) {
            var singleArr = arr[i].trim().split('=');
            var name = singleArr[0];
            var value = singleArr[1];
            if (obj[name] == undefined) {
                obj[name] = value;
            }
        }
        return obj;
    }
    });