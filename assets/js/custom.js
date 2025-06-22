$(document).ready(function() {
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

    $('#selling').hide();
    $('#leasing').show();
    
});
$('#pricestatus').change(function(){
         let cval = $(this).val();
            if((cval=='leasing'))
            {
                $('#selling').hide();
                $('#leasing').show();
            }
            else if ((cval=='selling'))
            {
                $('#leasing').hide();
                $('#selling').show();
                
            }
        });
$('#edit_pricestatus').change(function(){
         let cval = $(this).val();
            if((cval=='leasing'))
            {
                $('#edit_selling').hide();
                $('#edit_leasing').show();
            }
            else if ((cval=='selling'))
            {
                $('#edit_leasing').hide();
                $('#edit_selling').show();
                
            }
        });

if($('.select2').length > 0) {
        $('.select2').select2();
    }
if($('.select3').length > 0) {
        $('.select3').select2();
    }
if($('.select4').length > 0) {
        $('.select4').select2();
    }
if($('.select2-clear').length > 0) {
        $('.select2-clear').each(function() {
            let ph = $(this).data("placeholder");
            $(this).select2({
                placeholder: ph,
                allowClear: true
            });
        })
    }
if($('.select3-clear').length > 0) {
        $('.select3-clear').each(function() {
            let ph = $(this).data("placeholder");
            $(this).select2({
                placeholder: ph,
                allowClear: true
            });
        })
    }
if($('.select4-clear').length > 0) {
        $('.select4-clear').each(function() {
            let ph = $(this).data("placeholder");
            $(this).select2({
                placeholder: ph,
                allowClear: true
            });
        })
    }
    if($('.select2-ajax').length > 0) {
        $('.select2-ajax').each(function() {
            let ph = $(this).data("placeholder");
            let url = $(this).data("url");
            $(this).select2({
                placeholder: ph,
                allowClear: true,
                ajax: {
                    url: url,
                    dataType: 'json'
                }
            });
        });
    }


function pkgcloneform(arg)
{
        arg.preventDefault();
         var cloneCount = 1;   
         var clone=$( ".package:last-child" ).clone().appendTo("#vpkg" );
          clone.find("input[name='duration[]']").val("");
          clone.find("input[name='rentalprice[]']").val("");
          clone.find("input[name='vstatus[]']").val("");    
}
function removerpkg(event)
{
    var target = $(event.target);
    var cl=$(".package").length;
    if(cl==1)
    {
    alert("You can not remove");
    }
    else{
    target.parent().parent().parent().remove();
    }
}

// Business
$(".edit-business").on("click", function() {
        
        let id = $(this).data("id");
             
        $.ajax({                
                url : base_url+"dashboard/showbusinessdata/"+id,
                type: "GET",
                dataType: "JSON",
                success : function(e)
                {
                    CKEDITOR.instances.business_description.setData(e.description);
                  $('[name="id"]').val(e.id);
                  $('[name="edit_title"]').val(e.title);
                  $('#modal-edit-business').modal('show');   
                  $('#photo-preview').show();    
                  if(e.photo)
                    {
                        $('#label-photo').text('Change Photo'); // label photo upload
                        $('#photo-preview div').html('<img src="'+base_url+'upload/files/'+e.photo+'" class="img-responsive">'); // show photo
                        $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+e.photo+'"/> Remove photo when saving'); // remove photo

                    }
                    else
                    {
                        $('#label-photo').text('Upload Photo'); // label photo upload
                        $('#photo-preview div').text('(No photo)');
                    }             
                }
        });
        
    });


// Fuel Type
$(".edit-fueltype").on("click", function() {
    let id = $(this).data("id");
   
        $.ajax({                
            url : base_url+"dashboard/showfueltype/"+id,
            type: "GET",
            dataType: "JSON",
            success : function(e)
            {
              $('[name="id"]').val(e.id);
              $('[name="fueltype"]').val(e.fuel_type);
              $('#modal-edit-fuelform').modal('show');   
             
            }
        });
  });  


// Car Body Type
$(".edit-bodytype").on("click", function() {
    let id = $(this).data("id");

        $.ajax({                
            url : base_url+"dashboard/showbodytype/"+id,
            type: "GET",
            dataType: "JSON",
            success : function(e)
            {
              $('[name="id"]').val(e.id);
              $('[name="bodytype"]').val(e.body_type);
              $('#modal-edit-bodyform').modal('show');   
             
            }
        });
  }); 


// Brands
$(".edit-brands").on("click", function() {
    
    let id = $(this).data("id");
    $('#upload_editform')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
         
    $.ajax({                
            url : base_url+"dashboard/showbrandsdata/"+id,
            type: "GET",
            dataType: "JSON",
            success : function(e)
            {
              $('[name="id"]').val(e.id);
              $('[name="brandname"]').val(e.brand_name);
              $('#modal-edit-brands').modal('show');   
              $('#photo-preview').show();    
              if(e.brand_photo)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img src="'+base_url+'upload/files/'+e.brand_photo+'" class="img-responsive">'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+e.brand_photo+'"/> Remove photo when saving'); // remove photo

                }
                else
                {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
                }             
            }
    });
    
});

// how it works 
$(".edit-howitworks").on("click", function() {
    
    let id = $(this).data("id");         
    $.ajax({                
            url : base_url+"dashboard/showhowitworksdata/"+id,
            type: "GET",
            dataType: "JSON",
            success : function(e)
            {
                CKEDITOR.instances.edit_description.setData(e.description);
              $('[name="id"]').val(e.id);
              $('[name="edit_step"]').val(e.step);
              $('[name="edit_title"]').val(e.title);
              // $('[name="description"]').val();
              
              $('#modal-edit-howworks').modal('show');   
              $('#photo-preview').show();    
              if(e.photo)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img src="'+base_url+'upload/files/'+e.photo+'" class="img-responsive formimg">'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+e.photo+'"/> Remove photo when saving'); // remove photo

                }
                else
                {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
                }             
            }
    });
    
});

// FAQ
    $(".edit-faq").on("click", function() {
        let id = $(this).data("id");

            $.ajax({                
                url : base_url+"dashboard/showfaqdata/"+id,
                type: "GET",
                dataType: "JSON",
                success : function(e)
                {
                     CKEDITOR.instances.faq_description.setData(e.description);
                  $('[name="id"]').val(e.id);
                  $('[name="maintitle"]').val(e.main_title);
                  $('[name="subtitle"]').val(e.sub_title);

                  $('#modal-edit-faq').modal('show');   
                 
                }
            });
      }); 


// Features
    $(".edit-feature").on("click", function() {
        let id = $(this).data("id");

            $.ajax({                
                url : base_url+"dashboard/showfeaturedata/"+id,
                type: "GET",
                dataType: "JSON",
                success : function(e)
                {
                  $('[name="id"]').val(e.id);
                  $('[name="name"]').val(e.name);

                  $('#modal-edit-feature').modal('show');   
                 
                }
            });
      }); 

// Services
    $(".edit-services").on("click", function() {
        let id = $(this).data("id");

            $.ajax({                
                url : base_url+"dashboard/showservicesdata/"+id,
                type: "GET",
                dataType: "JSON",
                success : function(e)
                {
                  $('[name="id"]').val(e.id);
                  $('[name="name"]').val(e.name);

                  $('#modal-edit-service').modal('show');   
                 
                }
            });
      }); 

// Brands
$(".edit-brands").on("click", function() {
    
    let id = $(this).data("id");
    $('#upload_editform')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
         
    $.ajax({                
            url : base_url+"dashboard/showbrandsdata/"+id,
            type: "GET",
            dataType: "JSON",
            success : function(e)
            {
              $('[name="id"]').val(e.id);
              $('[name="brandname"]').val(e.brand_name);
              $('#modal-edit-brands').modal('show');   
              $('#photo-preview').show();    
              if(e.brand_photo)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img src="'+base_url+'upload/files/'+e.brand_photo+'" class="img-responsive">'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+e.brand_photo+'"/> Remove photo when saving'); // remove photo

                }
                else
                {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
                }             
            }
    });
    
});


// Vehicles
let pkey = 0;
        $(document).on("click", "#add-vehicles", function() {
        let options = [];
        let options2 = [];
        let options3 = [];
        let options4 = [];

        let duration_list=[];
        $.each(duration_list, function(key, status) {
        var option3 = "<option data-raw=" + key + "' value='" + status + "'>" + "</option>";
            options3.push(option3);
        });
        

        var option = "<option value='1'>" + "1 Month" + "</option>"+"<option value='2'>" + "3 Month" + "</option>"+"<option value='3'>" + "6 Month" + "</option>"+"<option value='4'>" + "12 Month" + "</option>"+"<option value='5'>" + "24 Month" + "</option>"+"<option value='6'>" + "48 Month" + "</option>";
            options.push(option);

        var option2 = "<option value='false'>" + "..." + "</option>"+"<option value='true'>" + "Best Saver" + "</option>";
        options2.push(option2);

        let select = $("<select data-row-id='"+pkey+"' class='form-control' name='vehiclesitem["+pkey+"][duration]'>" + options.join("") + "</select>");

        let select2 = $("<select data-row-id='"+pkey+"' class='form-control' name='vehiclesitem["+pkey+"][vstatus]'>" + options2.join("") + "</select>");
        $id="<input type='hidden' name='vehiclesitem["+pkey+"][pkgid]' value=''>";
        $price = "<input type='text' class='form-control price' name='vehiclesitem["+pkey+"][rentalprice]' />" ;
        

        let tpl = "<tr id='vehicle_row_"+pkey+"' data-id="+pkey+">";
        tpl += "<td></td>";
        tpl += "<td>" + $price + $id +"</td>";
        tpl += "<td></td>";
        tpl += '<td><a type="button" data-row="['+pkey+']" class="delete-vehicles-item btn btn-danger btn-xs color-white"><i class="fa fa-trash"></i></a></td>';
        tpl += "</tr>";
        let tplElem = $(tpl);
        tplElem.find("td:nth-child(1)").html(select);
        tplElem.find("td:nth-child(3)").html(select2);
        

        $("#modal-edit-vehicles #vehicles-edit-table tbody").append(tplElem);
       
        pkey++;
    });
/*end*/


/*delete new row*/
$(document).on("click", ".delete-vehicles-item", function() {
        let row = $(this).data('row');
        $("#vehicle_row_" + row).remove();
    })


/*edit Vehicles*/    
   let key = 0;      
    $(".edit-vehicles2").on("click", function() {
        
        $("#modal-edit-vehicles").modal("show");

        let _id = $(this).data("id");
        data="id="+_id;
        $("#vehicles-edit-table tbody").html("");
        $.ajax({
                type: "POST",
                url : base_url+"dashboard/showvehiclesdata",
                data : data,
                success : function(e)
                {                  
                  let json_response = JSON.parse(e);
                  
                  $.each(json_response, function(i, data) {
                        CKEDITOR.instances.edit_description.setData(data.descrip);
                      $('input[name="id"]').val(data.id);
                      $('input[name="modelname"]').val(data.model_name);
                      $('select[name="brandname"]').val(data.brand_name).trigger('change');
                      $('input[name="vehicleno"]').val(data.vehicle_no);
                      $('input[name="tnc"]').val(data.tnc);
                      $('input[name="price"]').val(data.rental_price);
                      $('input[name="selling_pricee"]').val(data.selling_price);
                      $('[name="category"]').val(data.category).trigger('change');
                      $('[name="pricestatus"]').val(data.price_status).trigger('change');
                      $('input[name="consumption"]').val(data.consumption);
                      $('[name="color"]').val(data.color).attr('selected', true);
                      $('input[name="cardesign"]').val(data.car_design);
                      $('input[name="year"]').val(data.year);
                      $('select[name="fueltype"]').val(data.fuel_type).trigger('change');
                      $('select[name="bodytype"]').val(data.body_type).trigger('change');
                      $('input[name="engine"]').val(data.engine_type);
                      $('input[name="door"]').val(data.door);
                      $('input[name="seat"]').val(data.seat_qty);
                      $('input[name="transmission"]').val(data.transmission); 
                      $('[name="purchase_date"]').datepicker('update',data.purchase_date); 
                      $('[name="registeration_date"]').datepicker('update',data.registration_date); 
                    $('select.xx').each(function() {    
                                $(this).find("option").each(function() {     
                                      var str = data.features;
                                      var substr = str.split(',');
                                      for (var i = 0; i < substr.length; i++)
                                      {                      
                                                         
                                        if (substr[i] == $(this).val()) {
                                             
                                          $('.xx').select2();

                                        }                     
                                      }
                                      $("#modal-edit-vehicles [name='feature[]'").val(substr);   
                                    })
                                });

                                $('select.cc').each(function() {    
                                $(this).find("option").each(function() {     
                                      var colr = data.color;
                                      var substr = colr.split(',');
                                      for (var i = 0; i < substr.length; i++)
                                      {                      
                                                         
                                        if (substr[i] == $(this).val()) {
                                             
                                          $('.cc').select2();

                                        }                     
                                      }
                                      $("#modal-edit-vehicles [name='color[]'").val(substr);   
                                    })
                                });

                         
                      $('#photo-preview').show();    
                      if(data.photo)
                        {
                            $('#label-photo').text('Change Cover Photo'); // label photo upload
                            $('#photo-preview div').html('<img src="'+base_url+'/upload/files/'+data.photo+'" class="img-responsive vehiclephoto">'); // show photo
                            $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.photo+'"/> Remove photo when saving'); // remove photo

                        }
                        else
                        {
                            $('#label-photo').text('Upload Cover Photo'); // label photo upload
                            $('#photo-preview div').text('(No photo)');
                        }


                    let options = [];
                    let options2 = []; 
                                       

                    /*show duration list and display value*/
                    var option = "<option value='" + data.duraid +"'>" + data.dura+ "</option>";
                    options.push(option);

                    if(data.beststatus=="false"){
                        var option2 = "<option value='" + data.beststatus +"'>" + "..."+ "</option>"+"<option value='true'>" + "Best Saver" + "</option>";
                            
                    }
                    if(data.beststatus=="true"){
                        var option2 = "<option value='" + data.beststatus +"'>" + "Best Saver"+ "</option>"+"<option value='false'>" + "..." + "</option>";                         
                    }
                    options2.push(option2);
                   
                   var cid=data.id;
                    
                    $.ajax({
                            type: "post",
                            url : base_url+"dashboard/getdurationlist/",
                            data: 'cid=' + cid,
                            success: function (carpkg) {
                                let _data = JSON.parse(carpkg);

                                let durationlist=" ";
                                $.each(_data, function(i, _dt) {
                                    durationlist += "<option value='" + _dt.duration_id +"'>" + _dt.duration+ "</option>";                        
                                    
                                });
                                options.push(durationlist); 

                                let select = $("<select data-row-id='"+key+"' class='form-control' name='vehiclesitem["+key+"][duration]'>" + options.join("") + "</select>");
                                let select2 = $("<select data-row-id='"+key+"' class='form-control' name='vehiclesitem["+key+"][vstatus]'>" + options2.join("") + "</select>");

                                $price = "<input type='text' class='form-control price' name='vehiclesitem["+key+"][rentalprice]' value='" + data.pkgprice + "' /><input type='hidden' name='vehiclesitem["+key+"][pkgid]' value='" + data.pkgid + "'>"

                                let tpl = "<tr id='product_row_"+key+"' data-id="+key+">";
                                tpl += '<td></td>';
                                tpl += "<td>" + $price + "</td>";
                                tpl += "<td></td>";
                                tpl += '<td><a type="button" data-row="['+key+']" class="btn btn-danger btn-xs color-white"><i class="fa fa-trash"></i></a></td>';
                                tpl += "</tr>";
                                let tplElem = $(tpl);
                                tplElem.find("td:nth-child(1)").html(select);
                                tplElem.find("td:nth-child(3)").html(select2);

                                $("#modal-edit-vehicles #vehicles-edit-table tbody").append(tplElem);
                                
                                key++;
                            }/*end success*/
                        });                    
                });
                $('#modal-edit-vehicles').modal('show');
                    
                }/*end success*/
        });
        
    });

/*end*/


$(".edit-galleryImage").on("click", function() {
   
    let id = $(this).data("id");

    $('#galleryImage_editform')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
         
    $.ajax({                
            url : base_url+"dashboard/showgalleryImage/"+id,
            type: "GET",
            dataType: "JSON",
            success : function(e)
            {
              $('[name="id"]').val(e.id);
              $('[name="vid"]').val(e.vehicle_id);
              $('#modal-edit-galleryImage').modal('show');   
              $('#photo-preview').show();    
              if(e.photos)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img src="'+base_url+'upload/files/'+e.photos+'" class="img-responsive">'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+e.photos+'"/> Remove photo when saving'); // remove photo

                }
                else
                {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
                }             
            }
    });
    
});

$(".edit-coverImage").on("click", function() {
   
    let id = $(this).data("id");
    
    $('#coverImage_editform')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
         
    $.ajax({                
            url : base_url+"dashboard/showvehiclesphotodata/"+id,
            type: "GET",
            dataType: "JSON",
            success : function(e)
            {
              $('[name="id"]').val(e.id);
             
              $('#modal-edit-CoverImage').modal('show');   
              $('#photo-preview').show();    
              if(e.photo)
                {
                    $('#label-photo').text('Change Photo'); // label photo upload
                    $('#photo-preview div').html('<img src="'+base_url+'upload/files/'+e.photo+'" class="img-responsive">'); // show photo
                    $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+e.photo+'"/> Remove photo when saving'); // remove photo

                }
                else
                {
                    $('#label-photo').text('Upload Photo'); // label photo upload
                    $('#photo-preview div').text('(No photo)');
                }             
            }
    });
    
});
$(".dealer_approve").on("click", function() {
   
    let id = $(this).data("id");
    $('[name="id"]').val(id);  
    $('#modal-dealerapprove').modal('show');
        
});
$(".vehicle_approve").on("click", function() {
   
    let id = $(this).data("id");
    $('[name="id"]').val(id);  
    $('#modal-vehicleapprove').modal('show');        
});
$(".vehicle_cancel").on("click", function() {
   
    let id = $(this).data("id");
    $('[name="id"]').val(id);  
    $('#modal-vehiclecancel').modal('show');        
});
$(".booking_approve").on("click", function() {
   
    let id = $(this).data("id");  
    $.ajax({                
            url : base_url+"dashboard/showuserbooking/"+id,
            type: "GET",
            dataType: "JSON",
            success : function(e)
            {
              $('[name="bid"]').val(e.id);   
              $('[name="vid"]').val(e.vehicle_id);             
              $('[name="approvestatus"]').val(e.check_status).trigger('change');
              $('#modal-approvestatus').modal('show');
                          
            }
    });    
});

$('#bookingapprovestatus').on('click',function() {
        var formData = new FormData($('#update_approve')[0]);
        $.ajax({
                    url : base_url+"dashboard/update_bookingapprove",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success : function (data) {
                        if(data.status) //if success close modal and reload ajax table
                            {
                               
                                $('#modal-approvestatus').modal('hide');
                                location.reload(true);
                            }
                       
                    }

               });
});



/*Booking Payment Status*/
$(".booking_status").on("click", function() {
   
    let id = $(this).data("id");    
   
    $.ajax({                
            url : base_url+"dashboard/showuserbooking/"+id,
            type: "GET",
            dataType: "JSON",
            success : function(e)
            {
              $('[name="bid"]').val(e.id);
              $('[name="vid"]').val(e.vehicle_id);
              $('[name="userid"]').val(e.user_id);
              $('[name="deliverydate"]').val(e.delivery_date);
              $('[name="totalamt"]').val(e.total_amt);
              $('#modal-paymentstatus').modal('show');
                          
            }
    });    
});



/*User Role Approve*/
$(".users_approve").on("click", function() {
   
    let id = $(this).data("id");   
    $("[name=id]").val(id);
    $('#modal-userapprove').modal('show'); 
});

$('#usersapprove').on('click',function() {
        var formData = new FormData($('#update_userstatus')[0]);
        $.ajax({
                    url : base_url+"dashboard/update_userstatus",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success : function (data) {
                        if(data.status) //if success close modal and reload ajax table
                            {
                               
                                $('#modal-userapprove').modal('hide');
                                location.reload(true);
                            }
                       
                    }

               });
});

/*User role cancel*/
$(".users_cancel").on("click", function() {
   
    let id = $(this).data("id");   
    $("[name=id]").val(id);
    $('#modal-usercancel').modal('show'); 
});

$('#userscancel').on('click',function() {
        var formData = new FormData($('#cancel_userstatus')[0]);
        $.ajax({
                    url : base_url+"dashboard/cancel_userstatus",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success : function (data) {
                        if(data.status) //if success close modal and reload ajax table
                            {
                               
                                $('#modal-usercancel').modal('hide');
                                location.reload(true);
                            }
                       
                    }

               });
});


// Reset Password

$('#pwdresetform').on('click',function() {
    var email = $('#email').val();

    $.ajax({
                type: "POST",
                url : base_url+"dashboard/user_resetpassword",
                data : "email="+email,
                success : function (data) {
                    if(data) {     

                        alert("Please check your email"); 
                        $('#modal-reset-pwd').modal('hide');
                        location.reload(true);
                    }                    
                }

           });
});

$(".date_status").on("click", function() {
    let date = $(this).data("id");
$('#avidate').html(date);

        $('#modal-bookingavailable').modal('show');   
      }); 


// Vehicles Category Title
$('#categoryform').on('click',function() {
        var formData = new FormData($('#upload_category')[0]);
        
        $.ajax({
                    url : base_url+"dashboard/insert_category",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success : function (data) {
                        if(data) {                                         

                            alert("Successfully Inserted"); 
                            $('#modal-new-category').modal('hide');
                            location.reload(true);
                        }
                        
                    }

               });
});


    $(".edit-category").on("click", function() {
        let id = $(this).data("id");

            $.ajax({                
                url : base_url+"dashboard/showcategoryname/"+id,
                type: "GET",
                dataType: "JSON",
                success : function(e)
                {
                  $('[name="id"]').val(e.id);
                  $('[name="category"]').val(e.category_name);
                  

                  $('#modal-edit-category').modal('show');   
                 
                }
            });
      }); 

// Add Users
    $(".edit-users").on("click", function() {
        let id = $(this).data("id");

            $.ajax({                
                url : base_url+"dashboard/showusersdata/"+id,
                type: "GET",
                dataType: "JSON",
                success : function(e)
                {
                  $('[name="id"]').val(e.id);
                  $('[name="firstname"]').val(e.first_name);
                  $('[name="lastname"]').val(e.last_name);
                  $('[name="phone"]').val(e.phone);
                  $('[name="email"]').val(e.email);
                  $('[name="role"]').val(e.role).trigger('change');

                  $('#modal-edit-users').modal('show');   
                 
                }
            });
      }); 


/*Payment*/
$('[name="paymentmethod"]').on("change", function() {
        let payment = $(this).val();

        $(".chkfrm input, .chkfrm select").removeAttr("required");

        if(payment == "cash") {
            $(".chkfrm").hide();
        } else if(payment == "bank") {
            $(".chkfrm").hide();
            $("#mydatee").hide();
            $("#chkfrm2,#chkfrm3").show();
            $("#c#chkfrm2 select,#chkfrm3 input").attr("required", "required");
        } else {
            $(".chkfrm").hide();
            $("#mydatee").show();
            $("#chkfrm4,#chkfrm2,#chkfrm3").show();
            $("#chkfrm4 input,#chkfrm2 select,#chkfrm3 input").attr("required", "required");
        }
    });