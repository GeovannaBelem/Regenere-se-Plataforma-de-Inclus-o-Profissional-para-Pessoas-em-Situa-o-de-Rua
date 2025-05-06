
var sec = 30;
var min = 2;


const formatTime = (value) => {
  return value < 10 ? '0' + value : value;
}

const Timer = () => {
  this.loop = setInterval(() => {
    sec--;
    if (sec === 0) {
      min--;
      sec = 60;
    }
    document.querySelector('.timer').innerText = formatTime(min) + ':' + formatTime(sec);
  }, 1000);
}

function codigo() {
  var email = document.querySelector('#email').value;
  
  if ((email === "")||(veri == "verdadeiro")) {
    window.location.reload();
    return false; 
  } else {

    document.querySelector('.caixona').style.display = 'none';
    document.querySelector('.caixona2').style.display = 'flex';
    document.querySelector('#titulo').innerHTML = "Insira o código";
    document.querySelector('#emaill').innerHTML = email;
    Timer();
    return false; 
  }
}