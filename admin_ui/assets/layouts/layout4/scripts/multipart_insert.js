$(document).ready(function()
{
    //  $("#submitForm").on('click', function(e){
    //   $('#addModal').modal('hide');
    // });

///////////////////////////insert///////////////////////////////////////
    var options = {
        success:       afterSuccess,  // post-submit callback
        error:         error,  // post-submit callback
        beforeSubmit: validateInputs
    };
    $('.addForm').ajaxForm(options);

    function validateInputs(data)
    {
        console.log(data);
        for (i = 0; i < data.length; i++) {
            if(data[i].value == "")
                return false;
        }
    }

    function error()
    {
        swal({
            title: "Error ocurred, check form",
            type: "error",
            closeOnConfirm: false,
            confirmButtonText: "Ok!",
            confirmButtonColor: "#ff0000",
            allowOutsideClick: true
        });

    }

    function afterSuccess(res)
    {
        $('#addModal').modal('hide');
        swal({
            title: "Created successfully",
            type: "success",
            closeOnConfirm: false,
            confirmButtonText: "Ok!",
            confirmButtonColor: "#ec6c62",
            allowOutsideClick: true
        });
        $('.addForm')[0].reset();
        oTable.draw();
    }

    ///////////////////////////////////Update//////////////////////////////////////
    var options_update = {
        success:       afterSuccess_update,  // post-submit callback
        error:         error_update,  // post-submit callback
        beforeSubmit: validateInputsUpdate
    };
    $('.editForm').ajaxForm(options_update);

    function validateInputsUpdate(data)
    {
        console.log(data);
        for (i = 0; i < data.length; i++) {
            if(data[i].name != "icon")
                if(data[i].name != "image")
                    if(data[i].name != "logo_ar")
                        if(data[i].name != "logo_en")
                            if(data[i].value == "")
                                return false;
        }
    }

    function error_update()
    {
        swal({
            title: "Error updating data, check form",
            type: "error",
            closeOnConfirm: false,
            confirmButtonText: "Ok!",
            confirmButtonColor: "#ff0000",
            allowOutsideClick: true
        });
        // $('#editModal').modal('hide');
    }

    function afterSuccess_update(res)
    {
        swal({
            title: "Updated successfully",
            type: "success",
            closeOnConfirm: false,
            confirmButtonText: "Ok!",
            confirmButtonColor: "#ec6c62",
            allowOutsideClick: true
        });
        $('.editForm')[0].reset();
        $('#editModal').modal('hide');
        oTable.draw();
    }

});