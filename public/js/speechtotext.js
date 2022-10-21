var url = $('meta[name="base_url"]').attr('content');

//Como por ahora no se me ocurre una mejor solucion creare botones de inicio para cada text area. Espero poder remplazarlo pronto.

const startBtnMtv = document.getElementById('startmotivo'); //Motivo
const stopBtnMtv = document.getElementById('stopmotivo');

const startBtnCc = document.getElementById('startcuadro'); //Cuadro clinico
const stopBtnCc = document.getElementById('stopcuadro');

const startBtnRs = document.getElementById('startres'); //Resultados
const stopBtnRs = document.getElementById('stopres');

const startBtnDiag = document.getElementById('startdiag'); //Diagnostico
const stopBtnDiag = document.getElementById('stopdiag');

const startBtnPron = document.getElementById('startpron'); //Pronostico
const stopBtnPron = document.getElementById('stoppron');

const startBtnIt = document.getElementById('startindica'); //Indicacion T.
const stopBtnIt = document.getElementById('stopindica');


var textparameter = ""; 

/* Hay algunos problemas con este codigo: como saber cual es su boton correspondiente de stop
var startBtns = document.querySelectorAll('.startrec');
var stopBtns = document.querySelectorAll('.stoprec');
var textparameter = ""; 

console.log(startBtns);

if(startBtns.length > 0){
    startBtns.forEach(element => {
        element.addEventListener('click', (e)=>{    
            textparameter = e.currentTarget.value;
            navigator.mediaDevices.getUserMedia({ audio: true, video: false })
                .then(handleSuccesstwo);
            //text2.innerText = "Se esta grabando en este momento...";
            startBtn.classList.add('hiddenli');
            stopBtn.classList.remove('hiddenli');  
        });
    });
    console.log("Inside IF");
}else{
    alert("No buttons? OMG!");
}
*/

//Jquery


//  -MOTIVO
startBtnMtv.addEventListener('click', function() {
    textparameter = "motivo";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(handleSuccessMtv);
    startBtnMtv.style.display = "none"; 
    stopBtnMtv.style.display = "block"; 
});

const handleSuccessMtv = function(stream) {
    const options = {mimeType: 'audio/webm'};
    const recordedChunks = [];
    const mediaRecorder = new MediaRecorder(stream, options);

    mediaRecorder.addEventListener('dataavailable', function(e) {
        if (e.data.size > 0) recordedChunks.push(e.data);
    });

    mediaRecorder.addEventListener('stop', function() {
        var audio = new Blob(recordedChunks);
        stream.getTracks().forEach( track => track.stop() );
        transcriptSpeech(audio, textparameter);
    });

    stopBtnMtv.addEventListener('click', function() {
        mediaRecorder.stop();
        startBtnMtv.style.display = "block"; 
        stopBtnMtv.style.display = "none"; 
    });

    mediaRecorder.start();
};
// -MOTIVO

//  -CUADRO CLINICO
startBtnCc.addEventListener('click', function() {
    textparameter = "cuadro";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(handleSuccessCc);
    startBtnCc.style.display = "none"; 
    stopBtnCc.style.display = "block"; 
});

const handleSuccessCc = function(stream) {
    const options = {mimeType: 'audio/webm'};
    const recordedChunks = [];
    const mediaRecorder = new MediaRecorder(stream, options);

    mediaRecorder.addEventListener('dataavailable', function(e) {
        if (e.data.size > 0) recordedChunks.push(e.data);
    });

    mediaRecorder.addEventListener('stop', function() {
        var audio = new Blob(recordedChunks);
        stream.getTracks().forEach( track => track.stop() );
        transcriptSpeech(audio, textparameter);
    });

    stopBtnCc.addEventListener('click', function() {
        mediaRecorder.stop();
        startBtnCc.style.display = "block"; 
        stopBtnCc.style.display = "none"; 
    });

    mediaRecorder.start();
};
// -CUADROCLINICO

//  -RESULTADOS
startBtnRs.addEventListener('click', function() {
    textparameter = "resultados";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccessRs);
    startBtnRs.style.display = "none"; 
    stopBtnRs.style.display = "block"; 
});

const handleSuccessRs = function(stream) {
    const options = {mimeType: 'audio/webm'};
    const recordedChunks = [];
    const mediaRecorder = new MediaRecorder(stream, options);

    mediaRecorder.addEventListener('dataavailable', function(e) {
        if (e.data.size > 0) recordedChunks.push(e.data);
    });

    mediaRecorder.addEventListener('stop', function() {
        var audio = new Blob(recordedChunks);
        stream.getTracks().forEach( track => track.stop() );
        transcriptSpeech(audio, textparameter);
    });

    stopBtnRs.addEventListener('click', function() {
        mediaRecorder.stop();
        startBtnRs.style.display = "block"; 
        stopBtnRs.style.display = "none"; 
    });

    mediaRecorder.start();
};
// -RESULTADOS

//  -DIAGNOSTICO
startBtnDiag.addEventListener('click', function() {
    textparameter = "diagnostico";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false }).then(handleSuccessDiag);
    startBtnDiag.style.display = "none"; 
    stopBtnDiag.style.display = "block"; 
});

const handleSuccessDiag = function(stream) {
    const options = {mimeType: 'audio/webm'};
    const recordedChunks = [];
    const mediaRecorder = new MediaRecorder(stream, options);

    mediaRecorder.addEventListener('dataavailable', function(e) {
        if (e.data.size > 0) recordedChunks.push(e.data);
    });

    mediaRecorder.addEventListener('stop', function() {
        var audio = new Blob(recordedChunks);
        stream.getTracks().forEach( track => track.stop() );
        transcriptSpeech(audio, textparameter);
    });

    stopBtnDiag.addEventListener('click', function() {
        mediaRecorder.stop();
        startBtnDiag.style.display = "block"; 
        stopBtnDiag.style.display = "none"; 
    });

    mediaRecorder.start();
};
// -DIAGNOSTICO

//  -PRONOSTICO
startBtnPron.addEventListener('click', function() {
    textparameter = "pronostico";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccessPron);
    startBtnPron.style.display = "none"; 
    stopBtnPron.style.display = "block"; 
});

const handleSuccessPron = function(stream) {
    const options = {mimeType: 'audio/webm'};
    const recordedChunks = [];
    const mediaRecorder = new MediaRecorder(stream, options);

    mediaRecorder.addEventListener('dataavailable', function(e) {
        if (e.data.size > 0) recordedChunks.push(e.data);
    });

    mediaRecorder.addEventListener('stop', function() {
        var audio = new Blob(recordedChunks);
        stream.getTracks().forEach( track => track.stop() );
        transcriptSpeech(audio, textparameter);
    });

    stopBtnPron.addEventListener('click', function() {
        mediaRecorder.stop();
        startBtnPron.style.display = "block"; 
        stopBtnPron.style.display = "none"; 
    });

    mediaRecorder.start();
};
// -PRONOSTICO

//  -INDICACION
startBtnIt.addEventListener('click', function() {
    textparameter = "indicacion";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccessIt);
    startBtnIt.style.display = "none"; 
    stopBtnIt.style.display = "block"; 
});

const handleSuccessIt = function(stream) {
    const options = {mimeType: 'audio/webm'};
    const recordedChunks = [];
    const mediaRecorder = new MediaRecorder(stream, options);

    mediaRecorder.addEventListener('dataavailable', function(e) {
        if (e.data.size > 0) recordedChunks.push(e.data);
    });

    mediaRecorder.addEventListener('stop', function() {
        var audio = new Blob(recordedChunks);
        stream.getTracks().forEach( track => track.stop() );
        transcriptSpeech(audio, textparameter);
    });

    stopBtnIt.addEventListener('click', function() {
        mediaRecorder.stop();
        startBtnIt.style.display = "block"; 
        stopBtnIt.style.display = "none"; 
    });

    mediaRecorder.start();
};
// -INDICACION

//Funcion que llama el metodo de transcripcion de voz a texto
function transcriptSpeech(audio, text){
    var fd = new FormData();
    fd.append('audio', audio);
    $.ajax({
        url: url + "/transcriptspeech",
        type: "POST",
        processData: false,
        contentType: false,
        data: fd,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            var textarea = document.getElementById(text);
            textarea.value += " " + response + ".";
        },
        error: function(response){
            alert("A Ocurrido un Error!");
        },
    });
}