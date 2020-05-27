<style type="text/css">
audio {
display : none;
}
</style>

<div>
<audio id="sample" src="http://dbmage.co.uk/game/music/Pendulum/Minds%20Eye.mp3" controls preload></audio>
<a href="javascript:play1();">Replay</a>
<script>
var audio = document.getElementById('sample');

function play1(){
    audio.currentTime = 30;
    audio.play();
    audio.end = audio.currentTime + 10;
    int = setInterval(function() {
        if (audio.currentTime > audio.end) {
            audio.pause();
            clearInterval(int);
        }
    }, 10);
}    
    
function pause(){
    audio.pause();
}
play1();
</script>
