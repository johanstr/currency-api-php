let url = 'http://school.localhost/school/2021/klas3/api/les03/api/index.php';
let select_valuta_option = document.querySelector('#selectcurrency');
let info_span = document.querySelector('#currency-info');
let showinfo_button = document.querySelector('#showinfo');
let valuta = null;
let opt = null;

window.onload = function() {
    loadValuta();
    showinfo_button.addEventListener('click', showInfo);
}

async function loadValuta() {
    await fetch(url)
            .then(response => response.json())
            .then(data => {
                valuta = data;
                showValuta();
            })
            .catch(error => console.error(error));
}

function showValuta() {
    let option_tag = '';

    for(let i = 0; i < valuta.length; i++) {
        option_tag = `<option value='${valuta[i].abbr}'>${valuta[i].abbr} - ${valuta[i].name}</option>`;
        select_valuta_option.innerHTML += option_tag;
    }
}

function showInfo(e) {
    console.log(valuta[select_valuta_option.selectedIndex]);
    info_span.innerHTML = `&euro; 1.00 = ${valuta[select_valuta_option.selectedIndex].value} ${valuta[select_valuta_option.selectedIndex].abbr}`;
}