if (localStorage.getItem("SnowMode") === null) {
    localStorage.setItem("SnowMode", false);

  }

if(JSON.parse(localStorage.getItem("SnowMode")) == true){
    snowon();
}else{
    localStorage.setItem("SnowMode", true);
    snowoff();
} 

function togglesnow(){
    if(JSON.parse(localStorage.getItem("SnowMode")) == true){
        localStorage.setItem("SnowMode", false);
        snowoff();
    }else{
        localStorage.setItem("SnowMode", true);
        snowon();
    }
}

function snowon(){
    var all = document.body.getElementsByTagName("*");
    var css = document.createElement("style");
    css.innerHTML = "* { color: --alpha: 0.3; opacity:0.3;} *:hover { color: --alpha: 0.3; opacity:1;}";
    css.type = "text/css";
    document.body.appendChild(css);
    localStorage.setItem("SnowMode", true);
    document.getElementById('snow').innerText = "Snow on"
}

function snowoff(){
    var all = document.body.getElementsByTagName("*");
    var css = document.createElement("style");
    css.innerHTML = "* { color: --alpha: 1; opacity:1;} *:hover { color: --alpha: 1; opacity:1;}";
    css.type = "text/css";
    document.body.appendChild(css);
    localStorage.setItem("SnowMode", false);
    document.getElementById('snow').innerText = "Snow off"
}