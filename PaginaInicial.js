function trocar_ft(btnValue) {
    var button = document.getElementById('btn_' + btnValue);
    if (btnValue == 1) {
        document.getElementById('ft_circ').setAttribute('src', 'IMG/ft_celular1.png');
        document.getElementById('btn_2').style.backgroundColor = "#D8D0E5";
        document.getElementById('btn_2').style.color = "#561FAD";
        document.getElementById('btn_3').style.backgroundColor = "#D8D0E5";
        document.getElementById('btn_3').style.color = "#561FAD";
        document.getElementById('btn_1').style.backgroundColor = "#561FAD";
        document.getElementById('btn_1').style.color = "white";

    } else if (btnValue == 2) {
        document.getElementById('ft_circ').setAttribute('src', 'IMG/ft_celular2.png');
        document.getElementById('btn_1').style.backgroundColor = "#D8D0E5";
        document.getElementById('btn_1').style.color = "#561FAD";
        document.getElementById('btn_3').style.backgroundColor = "#D8D0E5";
        document.getElementById('btn_3').style.color = "#561FAD";
        document.getElementById('btn_2').style.backgroundColor = "#561FAD";
        document.getElementById('btn_2').style.color = "white";
    } else if (btnValue == 3) {
        document.getElementById('ft_circ').setAttribute('src', 'IMG/ft_celular3.png');
        button.style.color = "white";
        button.style.backgroundColor = "#561FAD";
        document.getElementById('btn_1').style.backgroundColor = "#D8D0E5";
        document.getElementById('btn_1').style.color = "#561FAD";
        document.getElementById('btn_2').style.backgroundColor = "#D8D0E5";
        document.getElementById('btn_2').style.color = "#561FAD";
        document.getElementById('btn_3').style.backgroundColor = "#561FAD";
        document.getElementById('btn_3').style.color = "white";
    }
}
