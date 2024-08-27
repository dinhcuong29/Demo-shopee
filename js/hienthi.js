
var x = true;
    function hienthi(){
        event.preventDefault();
        if(x){
            document.getElementById("password").type="text";
            x = false;
        }
        else{
            document.getElementById("password").type="password";
            x=true;
        }
    }
    

    function hienthi2(){
        event.preventDefault();
        if(x){
            document.getElementById("password2").type="text";
            x = false;
        }
        else{
            document.getElementById("password2").type="password";
            x=true;
        }
    }