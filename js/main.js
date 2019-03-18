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
    window.scrollTo(0,0);
    console.log('top');
}
function Tomid() {
    window.scrollTo(0,660);
}
function Tobottom() {
    window.scrollTo(0,1500);
}

open = false;


function Usersettings() {


    if(open === false) {
        open = true;
        document.getElementById('username').style.height = '500px';
        document.getElementById('username').style.border = '1px solid black';
        document.getElementById('dropdown').style.transform = 'rotate(-90deg)';
    }else {
        open = false;
        document.getElementById('username').style.height = '50px';
        document.getElementById('username').style.border = 'none';
        document.getElementById('dropdown').style.transform = 'rotate(90deg)';
    }


}


