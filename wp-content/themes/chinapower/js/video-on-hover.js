/**
 * Video on Hover
 * Detects video elements and plays/pauses them on mouseover/mouseout respectively. Used for the Info is Beauty landing page.
 * Source: https://codepen.io/jfrancisayres/pen/bwpqQP
 */

window.onload = function() {
  const videoContainers = document.querySelectorAll(".video-preview");
  const videos = [];

  for (let i = 0; i < videoContainers.length; i++) {
    videos[i] = videoContainers[i].getElementsByTagName("video")[0];

    videoContainers[i].addEventListener(`mouseover`, function(e) {
      videos[i].play();
    });
    videoContainers[i].addEventListener(`mouseout`, function(e) {
      videos[i].pause();
    });
  }
};
