/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var $ = function (id) {
    return document.getElementById(id);
};
var byclass = function (classname) {
    return document.getElementsByClassName(classname);
};
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))) {
        return false;
    }
    return true;
}
var enableFields = function(){
    var f = byclass("e");
    for (var i=0;i<f.length;i++){
        f[i].disabled = false;
    }
}

function validatePassword() {
    var password = document.getElementById("password");
    var re_password = document.getElementById("re-password");

    if (password.value != re_password.value) {
        re_password.setCustomValidity("Passwords Don't Match");
        re_password.style.background = "#ffcccc";
        password.style.background = "#ffcccc";
    }else if(password.value == "" && re_password.value==""){
        password.style.border = "1px solid #999999";
        password.style.background = "white";
        re_password.style.border = "1px solid #999999";
        re_password.style.background = "white";
    }
    else {
        re_password.setCustomValidity('');
        re_password.style.background = "lightgreen";
        re_password.style.border = "0px";
        password.style.background = "lightgreen";
        password.style.border = "0px";
        
    }
}



var bcover = function (evt) {
    //var element = $(id);
    var element = evt.currentTarget;
    element.style.background = "#333";
    element.firstChild.style.color = "#fff";
};
var bcout = function (evt) {
    var element = evt.currentTarget;
    element.style.background = "#eee";
    element.firstChild.style.color = "#666";
};

var bcclick = function(evt){
    var element = evt.currentTarget;
    element.style.background = "#eee";
    element.firstChild.style.color = "#666";
}

var showDiv = function(evt){
    alert("hello");
    var element = evt.currentTarget;
    if(element.id == "history"){
        document.getElementById("history").style.display="block";
    }
}


window.onload = function () {
    var arr = byclass("c");
    for (var i = 0; i < arr.length; i++) {
        arr[i].addEventListener("mouseover", bcover, false);
        arr[i].addEventListener("mouseout", bcout, false);
        arr[i].addEventListener("mouseout", bcclick, false);
    }
    $("password").addEventListener("change",validatePassword,false);    
    $("re-password").addEventListener("keyup",validatePassword, false);
    $("h").addEventListener("click",showDiv,false);
//    $("edit").addEventListener("click",enableFields(),false);
    //$("li1").addEventListener("mouseout",backgroundChange,false);
    //$("li1").addEventListener("mouseover",test,false);
    //$("li1").onclick = backgroundChange($("li1"), "#333", "#fff");
    //$("li1").onmouseout = backgroundChange( $("li1"),"#eee","#333");
};
