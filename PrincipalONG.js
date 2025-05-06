function mostrar_linha1(){/*Disponiveis */
    document.querySelector('#ret1_linha').style.display = 'block';
    document.querySelector('#ret2_linha').style.display = 'none';
    document.querySelector('#GI').style.display = 'block';
    document.querySelector('#FE').style.display = 'block';
    document.querySelector('.perfiscandidatos').style.display = 'flex';
    document.querySelector('.perfiscontratado').style.display = 'none';
}

function mostrar_linha2(){/*Contratado */
    document.querySelector('#ret2_linha').style.display = 'block';
    document.querySelector('#ret1_linha').style.display = 'none';
    document.querySelector('#GI').style.display = 'none';
    document.querySelector('#FE').style.display = 'none';
    document.querySelector('.perfiscandidatos').style.display = 'none';
    document.querySelector('.perfiscontratado').style.display = 'flex';
}

function hamburguer(){
    var mobileMenu = document.getElementById('hamburguer1');

    if(mobileMenu.style.display == 'flex'){
        mobileMenu.style.display = 'none';
    }else{
        mobileMenu.style.display = 'flex';
    }
}

function hamburguer2(){

    var mobileMenu2 = document.getElementById('hamburguer2');

    if(mobileMenu2.style.display == 'flex'){
        mobileMenu2.style.display = 'none';
    }else{
        mobileMenu2.style.display = 'flex';
    }
}