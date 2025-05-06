var subsenha = false;
var podecad = false;
/* verificar se a senha esta com os padrões */
function mostrarSenha() {
    let senha = document.getElementById('senha');
    let buttons = document.getElementById('b-senha');
    let senhatwo = document.getElementById('senha2');
    let buttonss = document.getElementById('b2-senha');

    if (senha.type === 'password') {
        senha.setAttribute('type', 'text')
        buttons.classList.replace('bi-eye', 'bi-eye-slash')
    } else {
        senha.setAttribute('type', 'password')
        buttons.classList.replace('bi-eye-slash', 'bi-eye')
    }
    const senhaValue = senhatwo.value.trim();
    if (senhaValue != '') {
        if (senhatwo.type === 'password') {
            senhatwo.setAttribute('type', 'text')
            buttonss.classList.replace('bi-eye', 'bi-eye-slash')
        } else {
            senhatwo.setAttribute('type', 'password')
            buttonss.classList.replace('bi-eye-slash', 'bi-eye')
        }
    }
}

function checkSenha() {
    let crct = document.getElementById('crct')
    let ltR = document.getElementById('ltR')
    let ltr = document.getElementById('ltr')
    let num = document.getElementById('num')
    let esp = document.getElementById('esp')
    let senha = document.getElementById('senha')
    

    if (senha.value.match(/[0-9]/)) {
        num.style.color = 'green'

    } else {
        num.style.color = '#888787'
    }

    if (senha.value.match(/[A-Z]/)) {
        ltR.style.color = 'green'
    } else {
        ltR.style.color = '#888787'
    }

    if (senha.value.match(/[a-z]/)) {
        ltr.style.color = 'green'
    } else {
        ltr.style.color = '#888787'
    }

    if (senha.value.match(/[!\@\#\$\%\^\&\*\(\)\_\-\+\=\?\>\<\.\,]/)) {
        esp.style.color = 'green'
    } else {
        esp.style.color = '#888787'
    }

    if (senha.value.length < 6) {
        crct.style.color = '#888787'
    } else {
        crct.style.color = 'green'
    }
    if ((crct.style.color == 'green') && (esp.style.color == 'green') && (ltr.style.color == 'green')&& (ltR.style.color == 'green')&& (num.style.color == 'green')) {
      subsenha = true
    } else {
      subsenha = false
    }
    checarr();
}
function checarr() {

  let senha = document.getElementById('senha').value
  let senha2 = document.getElementById('senha2').value
  let aviso = document.getElementById('avisoo')
  let botao = document.getElementById('btn_cnt')
  if (subsenha) {

    if (senha == senha2) {

      podecad = true;

      botao.disabled = false;
      
    } else {
      podecad = false;
      botao.disabled = true;
    }
  }else{
    botao.disabled = true;
  }

  
  if (senha == senha2) {
    aviso.innerHTML = "     "
  }else{

    aviso.innerHTML = "As senhas devem ser compativeis"
  
  }

}

const cep = document.querySelector("#cep")
//blur - ao tirar o foco do input, aciona a função
cep.addEventListener("blur", (e) => {
//Cep - armazena o valor digitado no input
    let Cep = document.querySelector("#cep").value;
    let search = cep.value.replace("-", "")
    fetch(`https://viacep.com.br/ws/${search}/json/`).then((response) => {
        response.json().then(data => {
            console.log(data);
            document.getElementById("bairro").value = data.bairro;
            document.getElementById("estado").value = data.uf;
            document.getElementById("cidade").value = data.localidade;
            document.getElementById("rua").value = data.logradouro;
        })
    })
});

// Obtém a referência para o elemento de input de imagem
const inputElement = document.querySelector('.picture__input');

// Obtém a referência para o elemento de imagem atual
const imgPhoto = document.getElementById('imgPhoto');

// Adiciona um evento de escuta para quando uma imagem for selecionada
inputElement.addEventListener('change', handleImagePreview);

// Função para lidar com a visualização da imagem
function handleImagePreview(event) {
  const file = event.target.files[0]; // Obtém o arquivo de imagem

  // Verifica se um arquivo foi selecionado
  if (file) {
    // Cria um objeto FileReader
    const reader = new FileReader();

    // Define a função de callback para quando a leitura estiver completa
    reader.onload = function(e) {
      // Define o caminho da imagem como a URL de dados lida
      imgPhoto.src = e.target.result;
    };

    // Lê o conteúdo do arquivo como uma URL de dados
    reader.readAsDataURL(file);
  }
}


/*configurações dos slides */
const slidesContainer = document.getElementById("slides-container");
const slide = document.querySelector(".slide");
const prevButton = document.getElementById("slide-arrow-prev");
const nextButton = document.getElementById("slide-arrow-next");
let click = 0
const circulo2 = document.getElementById("cir2");
const linha1 = document.getElementById("l1");
const circulo3 = document.getElementById("cir3");
const linha2 = document.getElementById("l2");
const circulo4 = document.getElementById("cir4");
const linha3 = document.getElementById("l3");
const linha = document.getElementById("linha_r")

/*controla os cliques*/
nextButton.addEventListener("click", () => {
  const slideWidth = slide.clientWidth;
  slidesContainer.scrollLeft += slideWidth;
  if (click < 3) {
    click = click + 1
  }

/* configurações da barra de controle do slide*/
  switch (click) {
    case 1:
      circulo2.style.backgroundColor = '#9D60FF'
      linha1.style.backgroundColor = '#9D60FF'
      linha.style.width = '50%'
      break


    case 2:
      circulo3.style.backgroundColor = '#9D60FF'
      linha2.style.backgroundColor = '#9D60FF'
      linha.style.width = '75%'
      break
    case 3:
      circulo4.style.backgroundColor = '#9D60FF'
      linha3.style.backgroundColor = '#9D60FF'
      linha.style.width = '100%'
      break
  }



});

prevButton.addEventListener("click", () => {
  const slideWidth = slide.clientWidth;
  slidesContainer.scrollLeft -= slideWidth;
  if(click>=1){
    click = click - 1
  }

/* configurações da dos circulos de passo-a-passo do slide*/

  switch (click) {
    case 0:
      circulo2.style.backgroundColor = '#7BFFAC'
      linha1.style.backgroundColor = '#7BFFAC'
      linha.style.width = '25%'
      break
    case 1:
      circulo3.style.backgroundColor = '#7BFFAC'
      linha2.style.backgroundColor = '#7BFFAC'
      linha.style.width = '50%'
      break

    case 2:
      circulo4.style.backgroundColor = '#7BFFAC'
      linha3.style.backgroundColor = '#7BFFAC'
      linha.style.width = '75%'
      break

  }

  const input = document.getElementsByName(cnpj);


input.addEventListener('keypress', () => {
    let inputLength = input.value.length

    if (inputLength == 2 || inputLength == 7) {
        input.value += '.'
    }else if (inputLength == 11) {
        input.value += '/'
    }else if (inputLength == 16) {
        input.value += '-'}
})


const tel = document.getElementById("ad_tel");


tel.addEventListener('keypress', () => {
    let inputLength2 = tel.value.length

    if (inputLength2 == 0) {
        tel.value += '('
    }else if (inputLength2 == 3) {
        tel.value += ')'
    }else if (inputLength2 == 9) {
        tel.value += '-'}
})



const cep2 = document.getElementById("cep");


cep2.addEventListener('keypress', () => {
    let inputLength3 = cep2.value.length

    if (inputLength3 == 5) {
        cep2.value += '-'
    }
})
});

var inputFile = document.getElementById('arquivo1');

var inputFile1 = document.getElementById('form_group1');
inputFile.addEventListener('change', function () {
    if (inputFile.files.length > 0) {
        // Se algum arquivo foi selecionado
        inputFile1.style.backgroundColor = "green";
    } else {
        // Caso contrário, mantenha a cor de fundo padrão
        inputFile1.style.backgroundColor = '';
    }
});



function continuarPag2() {
 
  document.getElementById("pagina1").innerHTML += "";

  document.getElementById("pagina1").style.display = "none";

  document.getElementById("pagina2").style.display = "flex";

  document.getElementById("pagina3").style.display = "none";

  document.querySelector("#caixa-questionario").style.height = "67%";

  document.getElementById("tagT").innerHTML = "ENDEREÇO";

  
}


function continuarPag3() {
 
  document.getElementById("pagina2").innerHTML += "";

  document.getElementById("pagina2").style.display = "none";

  document.getElementById("pagina3").style.display = "flex";

  document.getElementById("tagT").innerHTML = "CRIAR PERFIL";

}

function continuarPag3ong() {
 
  document.getElementById("pagina1").innerHTML += "";

  document.getElementById("pagina1").style.display = "none";

  document.getElementById("pagina2").style.display = "none";

  document.getElementById("pagina3").style.display = "flex";

  document.querySelector("#caixa-questionario").style.height = "79%";

}

function continuarPag4() {
 
  document.getElementById("pagina3").innerHTML += "";

  document.getElementById("pagina3").style.display = "none";

  document.getElementById("pagina4").style.display = "flex";

  document.getElementById("tagT").innerHTML = "ADMINISTRADOR";

  document.querySelector("#caixa-questionario").style.height = "77%";

}


