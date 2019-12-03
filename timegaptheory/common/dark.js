

if(JSON.parse(localStorage.getItem("DarkMode")) == true){
    Darkon();
}else{
    Darkoff();
} 

function toggleDark(){
    if(JSON.parse(localStorage.getItem("DarkMode")) == true){
        localStorage.setItem("DarkMode", false);
        Darkoff();
    }else{
        localStorage.setItem("DarkMode", true);
        Darkon();
    }
}

function Darkon(){
    document.getElementById('dark').disabled=false;
    document.getElementById('light').disabled=true;
    var all = document.getElementsByClassName('navbar-item');
    for (var i = 0; i < all.length; i++) {
        all[i].style = 'filter: invert(100%);';
    }
    document.getElementById('darkb').innerText = "Dark mode on";
}

function Darkoff(){
    document.getElementById('dark').disabled=true;
    document.getElementById('light').disabled=false;
    var all = document.getElementsByClassName('navbar-item');
    for (var i = 0; i < all.length; i++) {
        all[i].style = 'filter: invert(0%);';
    }
    document.getElementById('darkb').innerText = "Dark mode off"
}