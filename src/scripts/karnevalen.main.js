function toggleMenu() {
    var linkContainer = document.getElementById('link-container');
    var hamburger = document.getElementById('hamburger');
    
    if (linkContainer.classList.contains('show')) {
        linkContainer.classList.remove('show');
        hamburger.classList.remove('open');
    } else {
        linkContainer.classList.add('show');
        hamburger.classList.add('open');
    }

}