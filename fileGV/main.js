function togMenu() {
    var nav = document.getElementById("leftMenu");
    if (nav.style.width == '250px') {
        nav.style.width = '0';
        nav.style.opacity = 0;
    } 
    else {
        nav.style.width = "250px";
        nav.style.opacity = 1;
    }
}

function closeNav() {
    document.getElementById("leftMenu").style.width = "0";
}

function togJoin() {
    var men = document.getElementById("joining");
    if (men.style.width == '100%') {
        men.style.width = '0';
        men.style.opacity = 0;
    } 
    else {
        men.style.width = "100%";
        men.style.opacity = 1;
    }
}

function closeJoin(){
    document.getElementById("joining").style.width = "0";
}

function togCreate() {
    var crea = document.getElementById("creating");
    if (crea.style.width == '100%') {
        crea.style.width = '0';
        crea.style.opacity = 0;
    } 
    else {
        crea.style.width = "100%";
        crea.style.opacity = 1;
    }
}

function closeCreate(){
    document.getElementById("creating").style.width = "0";
}

function togInsert() {
    var crea = document.getElementById("creating");
    if (crea.style.width == '100%') {
        crea.style.width = '0';
        crea.style.opacity = 0;
    } 
    else {
        crea.style.width = "100%";
        crea.style.opacity = 1;
    }
}

function closeInsert(){
    document.getElementById("creating").style.width = "0";
}