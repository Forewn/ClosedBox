function askServer(){
    var chat_ID = document.querySelector('.mensajes').id;
    var askRequest = new XMLHttpRequest();
    const chat = document.querySelector('.mensajes');
    askRequest.open('POST', 'php/getmessages.php');
    askRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    askRequest.onload = function(){
        var respuesta = askRequest.responseText;
        chat.insertAdjacentHTML('beforeend', respuesta);
        window.scrollTo(0, document.body.scrollHeight);
        console.log(respuesta);
    };
    askRequest.send("chat_id=" + chat_ID + "&other=" + window.other);
    
}

document.addEventListener('DOMContentLoaded', function(){
    window.scrollTo(0, document.body.scrollHeight);
    setInterval(askServer, 500);
    document.getElementById('button').addEventListener('click', function(event){
        var chat_ID = document.querySelector('.mensajes').id;
        event.preventDefault();
        const input = document.getElementById('text-area');
        if(input.value != ""){
            var request = new XMLHttpRequest();
            const chat = document.querySelector('.mensajes');
            var mensaje = encodeURIComponent(input.value);
            request.open('POST', 'php/new_message.php');
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.onload = function(){
                var respuesta = request.responseText;
                chat.insertAdjacentHTML('beforeend', respuesta);
            };
            request.send("mensaje=" + mensaje + "&chat_id=" + chat_ID);

            input.value = "";
        }
        
    });
});
