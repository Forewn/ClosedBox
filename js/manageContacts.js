function enviarID(ID){
    request = new XMLHttpRequest();
    request.open('POST', './php/company.php');
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.onload = function(){
    var respuesta = request.responseText;
    console.log(respuesta);
    openSuccess();
    };
    request.send("otherID="+ID);
}

function openWarning(ID){
    swal({
        title: '¿Está seguro de querer eliminar?',
        text: "Esta acción es irreversible",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "rgba(255, 0, 0, 0.76)"
    },
    function(isconfirm){
        if(isconfirm){
            enviarID(ID);
        }
    })
}

function openSuccess(){
    swal({
        title: 'Chat Eliminado Exitosamente!',
        type: "success"
    },
    function(isconfirm){
        if(isconfirm){;
            window.location.href = './php/deletechats.php';
        }
    });
}

function logoutModal(){
    swal({
        title: 'Realmente desea cerrar sesion?',
        type: 'error',
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "rgba(255, 0, 0, 0.76)"
    },
    function(isconfirm){
        if(isconfirm){
            window.location.href = "./php/logout.php";
        }
    });
}