const pswdField = document.querySelector(".form input[type = 'password']");
const showHide = document.querySelector(".form .field i");
showHide.addEventListener('click',()=>{
    if(pswdField.type == "password"){
        pswdField.type = "text";
        showHide.classList.add("active");
    }else{
        pswdField.type = "password";
        showHide.classList.remove("active");
    }
})
