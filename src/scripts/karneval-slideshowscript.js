var slideIndex = 1;
showSlides(slideIndex);

var slideIndexMain = 1;
showSlidesMain(slideIndexMain);

var slideIndexModal = 1;
// showSlidesModul(slideIndexModal);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

function plusSlidesMain(n) {
  showSlidesMain(slideIndexMain += n)
}

function plusSlidesModal(n) {
  showSlidesModal(slideIndexModal += n)
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function currentSlideMain(n) {
  showSlidesMain(slideIndexMain = n)
}

function currentSlideModal(n) {
  showSlidesModal(slideIndexModal = n)
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlide");
  if (n > slides.length) {
    slideIndex = 1
  }
  if (n < 1) {
    slideIndex = slides.length
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndex - 1].style.display = "block";
}

function showSlidesMain(n) {
  var i;
  var slides = document.getElementsByClassName("mySlideMain");
  if (n > slides.length) {
    slideIndexMain = 1
  }
  if (n < 1) {
    slideIndexMain = slides.length
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndexMain - 1].style.display = "block";
}

// function showSlidesModal(n) {
//   var i;
//   var slides = document.getElementsByClassName("mySlideModal");
//   if (n > slides.length) {slideIndexModal = 1} 
//   if (n < 1) {slideIndexModal = slides.length}
//   for (i = 0; i < slides.length; i++) {
//       slides[i].style.display = "none"; 
//   }
//   slides[slideIndexModal-1].style.display = "block"; 
// }