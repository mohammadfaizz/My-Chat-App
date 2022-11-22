const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");


form.onsubmit = (e)=>{
    e.preventDefault();  //preventing form from submission
}




sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();

    xhr.open("POST","php/insert-chat.php",true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; //once message inserted into database leave it blank
                scrollToBottom();
        }

    }

}


    // we have to send the form data through ajax to php 

    let formData = new FormData(form); //creating new formData Object

    xhr.send(formData); //sending the form data to php
}


chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}


setInterval(()=>{

    //AJAX For users
    let xhr = new XMLHttpRequest();

    xhr.open("POST","php/get-chat.php",true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){//scroll if there is no active class
                    scrollToBottom();
                }
             }
        }
    }

    let formData = new FormData(form); //creating new formData Object

    xhr.send(formData); //sending the form data to php


}, 500);  //this function will run frequesntly after 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}