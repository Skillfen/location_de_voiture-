function Recherche(ip) {
    let val = ip.value;
    var x = new XMLHttpRequest();
    x.open("GET", "../Controller/C_Cars.php?info=" + val, true);
    x.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("infomations").innerHTML = this.responseText;
        }
    };
    x.send();
}

function get(parentTr) {
    const value_list = [];
    input_fields = document.getElementsByClassName("inputs");
    indice = 0;
    for (const value of parentTr.children) {
        value_list.push(value.textContent);
    }
    for (const input of input_fields) {
        input.value = value_list[indice];
        indice++;
    }
    input_fields[input_fields.length - 1].value =
        value_list[value_list.length - value_list.length];
    input_fields[input_fields.length - 2].value =
        value_list[value_list.length - value_list.length];
}
setTimeout(function () {
     document.getElementById('message').style.display = 'none';
}, 2000);
window.addEventListener("load", function () {
    const preloader = document.querySelector("#preloader");
    preloader.classList.add("hide");
});