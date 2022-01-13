jQuery(document).ready(function($){
  var ajaxurl = 'https://'+window.location.host+'/1411/devtest/wp-admin/admin-ajax.php';
  $('form.ajax').on('submit', function(e){
     e.preventDefault();
     var that = $(this),
     url = that.attr('action'),
     type = that.attr('method');
     var name = $('.name').val();
     var email = $('.email').val();
     var message = $('.message').val();
     $.ajax({
        url: ajaxurl,
        type:"POST",
        dataType:'type',
        data: {
           action:'set_form',
           name:name,
           email:email,
           message:message,
      },   success: function(response){
          $(".success_msg").css("display","block");
       }, error: function(data){
           $(".error_msg").css("display","block");      }
     });
  $('.ajax')[0].reset();
    });
  });
  

  