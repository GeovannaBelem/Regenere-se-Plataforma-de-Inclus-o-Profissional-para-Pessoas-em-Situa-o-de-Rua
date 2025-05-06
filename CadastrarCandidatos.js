document.getElementById("vid").onchange = function() {
    var file = this.files[0];
    var blobURL = URL.createObjectURL(file);
 }

 function hamburguer() {

    var mobileMenu = document.getElementById('hamburguer1');

    if (mobileMenu.style.display == 'flex') {
        mobileMenu.style.display = 'none';
    } else {
        mobileMenu.style.display = 'flex';
    }
}

function hamburguer2() {

    var mobileMenu2 = document.getElementById('hamburguer2');

    if (mobileMenu2.style.display == 'flex') {
        mobileMenu2.style.display = 'none';
    } else {
        mobileMenu2.style.display = 'flex';
    }
}