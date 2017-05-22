/*
 *   Author: Jonnathon McCoy (jmccoy11@mail.greenriver.edu)
 *   Date: 5/20/2017
 *   Filename: blogs.js
 *   Description: Javascript for blogs website
 */

/**
 * Updates the filePath input value to that of the profile pic path
 * that was uploaded.
 */
function updateFilePath() {
  var file = document.getElementById('profilePic');
  var filePath = file.value;
  
  document.getElementById('filePath').value = filePath;
}

