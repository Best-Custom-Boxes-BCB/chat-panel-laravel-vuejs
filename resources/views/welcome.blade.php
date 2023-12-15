<h1>
    Welcome Page
</h1>


<audio id="myAudio">
    <source src="{{ asset('admin-asset/sound/horse.mp3') }}" type="audio/mpeg">
</audio>
<button onclick="playSound()">Play Sound</button>

<script>
      playSound();
    function playSound() {
        var audio = document.getElementById("myAudio");
        audio.play();
}
  </script>
