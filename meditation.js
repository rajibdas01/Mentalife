let currentAudio = null; // Track the currently playing audio
const audioElements = document.querySelectorAll(".audio-control");
const popup = document.getElementById("audio-popup");

audioElements.forEach((audio, index) => {
  // Get the song title for the popup
  const songTitle = audio.parentElement.querySelector("p").textContent;

  // Listen for the play event
  audio.addEventListener("play", () => {
    // Pause and reset the current audio if a new one starts
    if (currentAudio && currentAudio !== audio) {
      currentAudio.pause();
      currentAudio.currentTime = 0;
    }
    currentAudio = audio;

    // Show the popup with the song title
    popup.textContent = `Playing: ${songTitle}`;
    popup.classList.add("show");
  });

  // Listen for the pause and ended events
  audio.addEventListener("pause", () => {
    if (currentAudio === audio) {
      currentAudio = null;
      popup.classList.remove("show"); // Hide the popup
    }
  });

  audio.addEventListener("ended", () => {
    if (currentAudio === audio) {
      currentAudio = null;
      popup.classList.remove("show"); // Hide the popup
    }
  });
});
