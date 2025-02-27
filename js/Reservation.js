function Recherche(ip) {
    let val = ip.value;
    var x = new XMLHttpRequest();
    x.open("GET", "../Controller/C_Reservations.php?info=" + val, true);
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
}
setTimeout(function () {
    document.getElementById('message').style.display = 'none';
}, 2000);

function ChangeMarque() {
    let marque = document.getElementById("marque").value

    let dtd = document.getElementById("DateDebut").value
    let dtf = document.getElementById("DateFin").value
    if (marque != "choisir" && dtd != "" && dtf != "") {
        var request = new XMLHttpRequest();
        request.open('POST', '../Controller/C_Reservations.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.onload = function () {
            if (this.status == 200) {
                document.getElementById("select_voiture").innerHTML = this.responseText;
            }
        };
        request.send(`marque=${marque}&dt1=${dtd}&dt2=${dtf}`);
    } else {
        document.getElementById("select_voiture").innerHTML = "<option value='choisir'>choisir Voiture</option>";

    }
}

function ChangeType() {
    let type = document.getElementById("Type").value

    let dtd = document.getElementById("DateDebut").value
    let dtf = document.getElementById("DateFin").value


    document.getElementById("select_voiture").innerHTML = "<option value='choisir'>choisir Voiture</option>";
    if (type != "choisir" && dtd != "" && dtf != "") {
        var request = new XMLHttpRequest();
        request.open('POST', '../Controller/C_Reservations.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.onload = function () {
            if (this.status == 200) {
                document.getElementById("marque").innerHTML = this.responseText;
            }
        };
        request.send(`type=${type}&dt1=${dtd}&dt2=${dtf}`);
    } else {
        document.getElementById("marque").innerHTML = "<option value='choisir'>choisir Voiture</option>";

    }
}


function UpdateDateFin() {


    let datefinupdate = document.getElementById("datefinupdate").value
    let matupdate = document.getElementById("matriculeupdate").value
    let objetDtd = new Date(document.getElementById("datedebutupdate").value)

    let Id = document.getElementById("ID").value

    function UpdateNbJour(datedis) {
        let objetDtf = new Date(datedis)
        var difference_ms = objetDtf.getTime() - objetDtd.getTime();
        var jours = Math.floor(difference_ms / (1000 * 60 * 60 * 24));
        if (datefinupdate != "") {
            if (jours > 0) {
                document.getElementById("nbjourupdate").value = jours;
            } else {
                dtd.setDate(dtd.getDate() + 1)
                datefinupdate = dtd.toISOString().slice(0, 10);
                document.getElementById("nbjourupdate").value = "1";
            }
        }
    }
    var request = new XMLHttpRequest();
    request.open('POST', '../Controller/C_Reservations.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onload = function () {
        if (this.status == 200) {
            document.getElementById("datefinupdate").value = this.responseText;
            UpdateNbJour(this.responseText)

        }
    };
    request.send(`datefinupdate=${datefinupdate}&matupdate=${matupdate}&Id=${Id}`);


}


function ChangeDates() {
    let date1 = document.getElementById("DateDebut").value;
    let date2 = document.getElementById("DateFin").value;
    let dtd1 = new Date(document.getElementById("DateDebut").value)
    let dtf = new Date(document.getElementById("DateFin").value)

    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0');
    const day = now.getDate().toString().padStart(2, '0');

    if (dtd1 < now) {
        document.getElementById("DateDebut").value = `${year}-${month}-${day}`;
    }

    let dtd = new Date(document.getElementById("DateDebut").value)

    document.getElementById("select_voiture").innerHTML = "<option value='choisir'>choisir Voiture</option>";
    document.getElementById("marque").innerHTML = "<option value='choisir'>choisir Marque</option>";

    if (dtd != "" && dtf != "") {
        var request = new XMLHttpRequest();
        request.open('POST', '../Controller/C_Reservations.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.onload = function () {
            if (this.status == 200) {
                document.getElementById("Type").innerHTML = this.responseText;
            }
        };
        request.send(`dt1=${date1}&dt2=${date2}`);
    } else {
        document.getElementById("Type").innerHTML = "<option value='choisir'>choisir Type</option>";
    }
    var difference_ms = dtf.getTime() - dtd.getTime();
    var jours = Math.floor(difference_ms / (1000 * 60 * 60 * 24));
    if (document.getElementById("DateDebut").value != "" && document.getElementById("DateFin").value != "") {
        if (jours > 0) {
            document.getElementById("nbj").value = jours;
        } else {
            dtd.setDate(dtd.getDate() + 1)
            document.getElementById("DateFin").value = dtd.toISOString().slice(0, 10);
            document.getElementById("nbj").value = "1";
        }
    } else {
        document.getElementById("nbj").value = "0";
    }


}

function ChangePrix() {

    let prix = document.getElementById("prix").value;
    let nbj = document.getElementById("nbj").value;

    if (prix != "" && prix >= 0) {
        document.getElementById("total").value = parseInt(nbj) * parseFloat(prix);

    } else {
        document.getElementById("total").value = "0";
    }


}


function UpdatePrix() {
    let prix = document.getElementById("updateprix").value;
    let nbj = document.getElementById("nbjourupdate").value;
    if (prix != "" && prix >= 0) {
        document.getElementById("totalupdate").value = parseInt(nbj) * parseFloat(prix);
    } else {
        document.getElementById("totalupdate").value = "0";
    }
}
