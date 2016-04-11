  var mediaRecorder;
  var mediaConstraints = {
    audio: true
  };
  var hours = 0, minutes = 0, seconds = 0; 
    
  function record(){
    navigator.getUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
  };

  function onMediaSuccess(stream) {
      mediaRecorder = new MediaStreamRecorder(stream);
      mediaRecorder.mimeType = 'audio/ogg';
      mediaRecorder.audioChannels = 2;
      mediaRecorder.bufferSize = 1024;
      mediaRecorder.ondataavailable = function (blob) {
          var blobURL = URL.createObjectURL(blob);
          console.log(blobURL);
          $("#play_song").attr("src",blobURL);
          $("#play_song")[0].play();
      };
      mediaRecorder.start(8000);
      setTimeout(function(){
        mediaRecorder.stop();
      },8000);
  }

  function onMediaError(e) {
     // console.error('media error', e);
  }

  function add()
  {
      seconds++;
      if (seconds >= 60) {
          seconds = 0;
          minutes++;
          if (minutes >= 60) {
              minutes = 0;
              hours++;
          }
      }

      var current_time = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
      $(".call_timer").html((hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds));
  }

  
$(document).ready(function(){
    /* Call Timer for Video Call Start */
    var timer;
    $("body").on("click","#record",function(){
          $(this).attr("disabled",true);
          $('#record').text('Recording..');
          timer = setInterval(function(){ add(); },1000);
          setTimeout(function(){
             clearInterval(timer);
             hours = 0, minutes = 0, seconds = 0; 
             $('#record').text('Playing..');
             setTimeout(function(){$("#play_record").hide(); $("#record").attr("disabled",false);
              $('#record').text('Record');
              },8000);
          },8000);
          record();
          $("#start_record").show();
    });

});
