$('.form-control').on('keyup',function(){
    $(this).removeClass('is-invalid');
});

$('#verpass').on('click',function(){
    password.type =  password.type  == "password" ? "text" : "password";
    this.className =  this.className  == "far fa-eye" ? "far fa-eye-slash" : "far fa-eye";
});
