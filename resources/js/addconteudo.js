var counter = 2;
var counter_est = 2;
function add_act_selector(){
    let dummy = document.getElementById("father");
    let elementoo = document.querySelector("#selectpessoa1");
    let elemento = elementoo.cloneNode(true);
    elemento.id = "#selectpessoa"+counter
    elemento.childNodes = elementoo.childNodes;
    elemento.name = "pessoas["+String(counter-1)+"]";
    dummy.after(elemento);
    counter++;
}
function add_est_selector(){
    let dummy = document.getElementById("father2");
    let elementoo = document.querySelector("#selectestudio1");
    let elemento = elementoo.cloneNode(true);
    elemento.id = "#selectestudio"+counter_est;
    elemento.childNodes = elementoo.childNodes;
    elemento.name = "estudios["+String(counter_est-1)+"]";
    dummy.after(elemento);
    counter++;
}