/*SLIDESHOW SCRIPT*/               /*==REMINDER: ADD FADE ANIMATION TO SLIDES==*/
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("Slides");
  var count = document.getElementsByClassName("slide-count");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < count.length; i++) {
    count[i].className = count[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  count[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000); 
}