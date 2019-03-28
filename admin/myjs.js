var grid="";
//jQuery(document).ready(function(){
        var grid = jQuery('#user_grid').DataTable({
        "scrollX": true,
        "paging" : true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        "pagingType": "numbers",
        "processing": true,
        "serverSide": true,
        'serverMethod': 'post',
        "ajax" : {
            url : "admin/response.php",
        },
        
    });


function btnDel(user_id){
        
     swal({   title: "User will be deleted permanently!",   
    text: "Are you sure to proceed?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Remove user!",   
    cancelButtonText: "I am not sure!",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        //var $data="";
        jQuery.ajax({
                type: "POST",
                url : "delete.php",
                data: {user_id:user_id},
                success: function(res){
                       
                       // console.log(res);

                        grid.ajax.reload(null,false);

                      var $data = jQuery.parseJSON(res);
                      console.log($data);
                      if($data.code==200)
                      {
                        swal("Error!",$data.thread,"error");
                      }
                      else{
           swal("Account Removed!", "Your account is removed permanently!", "success");              
                      }

          

                }
        });

        // swal("Account Removed!", "Your account is removed permanently!", "success");

    } 
    else {     
            swal("Warning", "Account is not removed!", "error");   
        } });

}

//});


