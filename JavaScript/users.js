const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button"),
usersList = document.querySelector(".users .users-list");

searchBtn.addEventListener("click",()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
});


searchBar.onkeyup = ()=>{

    //AJAX for Search Bar
    let searchTerm = searchBar.value;

    if(searchTerm != ""){
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }

    let xhr = new XMLHttpRequest();

    xhr.open("POST","php/search.php",true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
             }
        }
    }

    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(()=>{

    //AJAX For users
    let xhr = new XMLHttpRequest();

    xhr.open("GET","php/users.php",true);

    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){  //if active class not contains in search bar
                    usersList.innerHTML = data;
                }
             }
        }
    }

xhr.send();

}, 500);  //this function will run frequesntly after 500ms


