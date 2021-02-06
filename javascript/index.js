var slideIndex = 0;
showSlides();

function myFunction() 
{
    var x = document.getElementById("myMenu");
    if (x.className === "menu") 
    {
        x.className += " responsive";
    } 
    else 
    {
    	x.className = "menu";
    }
}

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) 
    {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1;}  
    slides[slideIndex-1].style.display = "block"; 
    setTimeout(showSlides, 3500); // Change image every 2 seconds
}