function mostrar_linha1() {/*EMPRESA */
    document.querySelector('#ret1_linha').style.display = 'block';
    document.querySelector('#ret2_linha').style.display = 'none';
    document.querySelector('#GI').style.display = 'block';
    document.querySelector('#FE').style.display = 'block';
    document.querySelector('#CD').style.display = 'none';
    document.querySelector('#filtros').style.justifyContent = "space-between";
    document.querySelector('.perfiscandidatos').style.display = 'flex';
    document.querySelector('.perfisongs').style.display = 'none';
}

function mostrar_linha2() {/*ONG */
    document.querySelector('#ret2_linha').style.display = 'block';
    document.querySelector('#ret1_linha').style.display = 'none';
    document.querySelector('#GI').style.display = 'none';
    document.querySelector('#FE').style.display = 'none';
    document.querySelector('#CD').style.display = 'block';
    document.querySelector('#filtros').style.justifyContent = "flex-start";
    document.querySelector('.perfiscandidatos').style.display = 'none';
    document.querySelector('.perfisongs').style.display = 'flex';
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

function mostrar_linha11() {/*EMPRESA */
    document.querySelector('#ret1_linha').style.display = 'block';
    document.querySelector('#ret2_linha').style.display = 'none';
    document.querySelector('.perfiscandidatos').style.display = 'flex';
    document.querySelector('.perfisongs').style.display = 'none';
}

function mostrar_linha22() {/*ONG */
    document.querySelector('#ret2_linha').style.display = 'block';
    document.querySelector('#ret1_linha').style.display = 'none';
    document.querySelector('.perfiscandidatos').style.display = 'none';
    document.querySelector('.perfisongs').style.display = 'flex';
}


var search = document.getElementById('txtBusca');

search.addEventListener("keydown", function(event){
    if(event.key === "Enter"){
        searchData();
    }
});
function searchData(){
    window.location = 'PrincipalEmpresa.php?search=' + search.value;
}

function filtrar(){
    document.querySelector('#filtrar').style.display = 'flex';
    document.querySelector('#filtros_mobile').style.display = 'flex';
}

function fechar(){
    document.querySelector('#filtrar').style.display = 'none';
}