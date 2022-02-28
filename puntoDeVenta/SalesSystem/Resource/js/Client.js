class Client extends Uploadpicture{
    ClearMessages(input) {
        switch (input.name) {
            case "nid":
                document.getElementById(input.name).innerHTML = "";
                break;
            case "name":
                document.getElementById(input.name).innerHTML = "";
                break;
            case "lastname":
                document.getElementById(input.name).innerHTML = "";
                break;
            case "phone":
                document.getElementById(input.name).innerHTML = "";
                break;
            case "direction":
                document.getElementById(input.name).innerHTML = "";
                break;
            case "email":
                document.getElementById(input.name).innerHTML = "";
                break;
        }
    }

    SetSection(value){
        switch (value) {
            case 1:
                document.getElementById('inlineRadio1').checked = true;
                document.getElementById('inlineRadio2').checked = false;
                document.getElementById('inlineRadio1').disabled = false;
                document.getElementById('inlineRadio2').disabled = true;
                localStorage.setItem("section", value);
                this.Restore();
                break;
            case 2:
                document.getElementById('inlineRadio2').checked = true;
                document.getElementById('inlineRadio1').checked = false;
                document.getElementById('inlineRadio2').disabled = false;
                document.getElementById('inlineRadio1').disabled = true;
                localStorage.setItem("section", value);
                this.Restore();
                break;
        }
    }

    Payments(event, input){
        var tempValue;
        var key = window.Event ? event.which : event.keyCode;
        var chark = String.fromCharCode(key);
        if (input == null) {
            tempValue = document.getElementById("Input_Payment").value;
        }else{
            tempValue = input.value + chark;
        }
        var payment1 = parseFloat(tempValue);
        let section = parseInt(localStorage.getItem("section"));
        switch (section){
            case 1:
                let monthly = parseFloat(document.getElementById("monthly").value);
                if (payment1 >= monthly){
                    if (payment1 > monthly){
                        let change = payment1 - monthly;
                        let value = "El cambio para el cliente es: " + numberDecimales(change);
                        document.getElementById("paymentMessage").innerHTML = value;
                    }
                    $('#payment').attr("disabled", false);
                }else{
                    $('#payment').attr("disabled", true);
                    document.getElementById("paymentMessage").innerHTML = "";
                }
            break;
        }
    }

    Restore() {
        $('#payment').attr("disabled", true);
        document.getElementById("Input_Payment").value = "";
        //document.getElementById("paymentMessage").innerHTML = "";
    }
}
