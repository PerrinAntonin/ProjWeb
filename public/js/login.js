// Get the button that opens the modal
//var form = document.getElementById("form-connect");

// Get the <span> element that closes the modal
//var btnclose = document.getElementById("closeLogin");


//btnclose.onclick = function() {
  //  if (!error){
    //    $('#loginModal').modal('hide');
    //}
//};

$('.openLogin').click(function(){
    $.ajax({
        url:'/login',
        type:'POST',
        datatType:'json',
        data:{},
        async:true,
        success:function(data){
            $error = data.error;
            $('#inputUsername').val(data.last_username);

            console.log(data);
        }
    })
});

