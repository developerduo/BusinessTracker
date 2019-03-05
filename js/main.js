function OnScroll() {
    
    document.getElementById("scroll").style.backgroundColor = "rgba(255,255,255,1)";
    document.getElementById("color1").style.color = "rgba(0,0,0,1)";
    document.getElementById("color2").style.color = "rgba(0,0,0,1)";
    document.getElementById("color3").style.color = "rgba(0,0,0,1)";
    document.getElementById("loginbtn").style.color = "rgba(0,0,0,1)";
    document.getElementById("loginbtn").style.backgroundColor = "rgba(255,255,255,1)"
    
    if(window.scrollY == 0) {
        
        document.getElementById("scroll").style.backgroundColor = "rgba(255,255,255,0)";
        document.getElementById("loginbtn").style.color = "rgba(255,255,255,1)"
        document.getElementById("color1").style.color = "rgba(255,255,255,1)";
        document.getElementById("color2").style.color = "rgba(255,255,255,1)";
        document.getElementById("color3").style.color = "rgba(255,255,255,1)";
        document.getElementById("loginbtn").style.backgroundColor = "rgba(0,0,0,0)"
    }
} 

function Totop() {
    var elmnt = document.getElementById("top");
    elmnt.scrollIntoView();
}
function Tomid() {
    var elmnt = document.getElementById("midden");
    elmnt.scrollIntoView();
}
function Tobottom() {
    var elmnt = document.getElementById("bottom");
    elmnt.scrollIntoView();
}
function cookieCheck() {
    setTimeout(function() {
    document.getElementById('cookieCheck').style.display = 'block';
    }, 3000);
}
function closeCookie() {
    document.getElementById('cookieCheck').style.display = 'none';
}
openAccount = false;
function accountMenu() {
    if(openAccount == false) {
        document.getElementById('userMenu').style.height = '100px';
        document.getElementById('arrowUp').style.display = 'initial';
        document.getElementById('arrowDown').style.display = 'none';
        openAccount = true;
    } else{
        document.getElementById('userMenu').style.height = '0px';
        document.getElementById('arrowDown').style.display = 'initial';
        console.log('dicht');
        document.getElementById('arrowUp').style.display = 'none';
        openAccount = false;
    }

}