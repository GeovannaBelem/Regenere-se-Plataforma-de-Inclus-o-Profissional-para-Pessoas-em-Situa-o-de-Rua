function mostrar_linha1() {/*EMPRESA*/
    document.querySelector('#ret1_linha').style.visibility = 'visible';
    document.querySelector('#ret2_linha').style.visibility = 'hidden';
    document.querySelector('#empresa').style.display = 'block';
    document.querySelector('#dadosGerais').style.display = 'none';
    document.querySelector('#geral2').style.display = 'block';
}

function mostrar_linha2() {/*DADOS GERAIS*/
    document.querySelector('#ret1_linha').style.visibility = 'hidden';
    document.querySelector('#ret2_linha').style.visibility = 'visible';
    document.querySelector('#empresa').style.display = 'none';
    document.querySelector('#dadosGerais').style.display = 'block';
    document.querySelector('#geral2').style.display = 'flex';
}

function editar() {/*EDITAR PERFIL*/
    document.querySelector('#geral2').style.display = 'none';
    document.querySelector('#Editar').style.display = 'block';
    document.querySelector('btn_filtro').style.justifyContent  = 'flex-start';
}

document.write('<a href="' + document.referrer + '">←</a>');