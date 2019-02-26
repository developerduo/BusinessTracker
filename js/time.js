

    var time = new Date();
    var time2 = time.getHours();
    var greeting;

    if(time2 < 12){
        greeting = 'Goedemorgen';
    } else if(time2 < 17){
        greeting = 'Goedemiddag';
    } else if(time2 < 24){
        greeting = 'Goedeavond';
    }

    document.getElementById("output").innerHTML = greeting;

