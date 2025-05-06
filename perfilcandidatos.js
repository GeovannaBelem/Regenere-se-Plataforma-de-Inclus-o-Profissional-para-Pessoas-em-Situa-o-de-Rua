var inputFile = document.getElementById('arquivo');
var inputcolor =  document.getElementById('form_group1');
inputFile.addEventListener('change', function () {
    if (inputFile.files.length > 0) {
        // Se algum arquivo foi selecionado
        inputcolor.style.backgroundColor = 'green';
    } else {
        // Caso contrário, mantenha a cor de fundo padrão
        inputcolor.style.backgroundColor = '';
    }
});

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
