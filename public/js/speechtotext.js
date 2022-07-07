var url = $('meta[name="base_url"]').attr('content');

//Como por ahora no se me ocurre una mejor solucion creare botones de inicio para cada text area. Espero poder remplazarlo pronto.
const startBtnMtv = document.getElementById('startrecmotivo'); //Motivo
const stopBtnMtv = document.getElementById('stoprecmotivo');

const startBtnCc = document.getElementById('startreccuadro'); //Cuadro clinico
const stopBtnCc = document.getElementById('stopreccuadro');

const startBtnRs = document.getElementById('startrecres'); //Resultados
const stopBtnRs = document.getElementById('stoprecres');

const startBtnDiag = document.getElementById('startrecdiag'); //Diagnostico
const stopBtnDiag = document.getElementById('stoprecdiag');

const startBtnPron = document.getElementById('startrecpron'); //Pronostico
const stopBtnPron = document.getElementById('stoprecpron');

const startBtnIt = document.getElementById('startrecindica'); //Indicacion T.
const stopBtnIt = document.getElementById('stoprecindica');

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

//  -MOTIVO
startBtnMtv.addEventListener('click', function() {
    textparameter = "motivo";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccessMtv);
    startBtnMtv.classList.add('hiddenli');
    stopBtnMtv.classList.remove('hiddenli');
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
        startBtnMtv.classList.remove('hiddenli');
        stopBtnMtv.classList.add('hiddenli');
    });

    mediaRecorder.start();
};
// -MOTIVO

//  -CUADRO CLINICO
startBtnCc.addEventListener('click', function() {
    textparameter = "cuadro";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccessCc);
    startBtnCc.classList.add('hiddenli');
    stopBtnCc.classList.remove('hiddenli');
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
        startBtnCc.classList.remove('hiddenli');
        stopBtnCc.classList.add('hiddenli');
    });

    mediaRecorder.start();
};
// -CUADROCLINICO

//  -RESULTADOS
startBtnRs.addEventListener('click', function() {
    textparameter = "resultados";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccessRs);
    startBtnRs.classList.add('hiddenli');
    stopBtnRs.classList.remove('hiddenli');
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
        startBtnRs.classList.remove('hiddenli');
        stopBtnRs.classList.add('hiddenli');
    });

    mediaRecorder.start();
};
// -RESULTADOS

//  -DIAGNOSTICO
startBtnDiag.addEventListener('click', function() {
    textparameter = "diagnostico";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccessDiag);
    startBtnDiag.classList.add('hiddenli');
    stopBtnDiag.classList.remove('hiddenli');
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
        startBtnDiag.classList.remove('hiddenli');
        stopBtnDiag.classList.add('hiddenli');
    });

    mediaRecorder.start();
};
// -DIAGNOSTICO

//  -PRONOSTICO
startBtnPron.addEventListener('click', function() {
    textparameter = "pronostico";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccessPron);
    startBtnPron.classList.add('hiddenli');
    stopBtnPron.classList.remove('hiddenli');
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
        startBtnPron.classList.remove('hiddenli');
        stopBtnPron.classList.add('hiddenli');
    });

    mediaRecorder.start();
};
// -PRONOSTICO

//  -INDICACION
startBtnIt.addEventListener('click', function() {
    textparameter = "indicacion";
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccessIt);
    startBtnIt.classList.add('hiddenli');
    stopBtnIt.classList.remove('hiddenli');
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
        startBtnIt.classList.remove('hiddenli');
        stopBtnIt.classList.add('hiddenli');
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