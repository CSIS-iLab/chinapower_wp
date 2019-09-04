/**
 * Video on Hover
 * Detects video elements and plays/pauses them on mouseover/mouseout respectively. Used for the Info is Beauty landing page.
 * Source: https://codepen.io/jfrancisayres/pen/bwpqQP
 */

window.onload = function() {
  //executes this code after the DOM loads
  //--- this is the selector element. Feel free to change this if you don't want all video objects targeted.
  const vids = document.getElementsByTagName(`video`);

  //--- Now we loop over all of the selected elements and add event listeners
  for (let i = 0; i < vids.length; i++) {
    vids[i].addEventListener(`mouseover`, function(e) {
      vids[i].play();
    });
    vids[i].addEventListener(`mouseout`, function(e) {
      vids[i].pause();
    });
  }
};
