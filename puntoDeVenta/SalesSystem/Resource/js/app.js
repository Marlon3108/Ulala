var user = new User();
var imageUser = (evt)=>{
    user.archivo(evt, "imageUser");
}

var client = new Client();
var imageClient = (evt)=>{
    client.archivo(evt, "imageClient");
}

var principal = new Principal();
$().ready(()=>{
    let URLactual = window.location.pathname;
    principal.linkPrincipal(URLactual);

    $('#Input_Payment').keyup((e) =>{
        var key = e.which || e.keyCode || e.charCode;
        if (key == 8){
            let section = parseInt(localStorage.getItem("section"));
            switch (section){
                case 1:
                    client.Payments(e, null);
                break
            }
        }
        return true;
    });
});
