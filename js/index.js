let url = 'http://school.localhost/school/2021/klas3/api/les03/api/index.php';
let select_valuta_option = document.querySelector('#selectcurrency');
let select_from_currency = document.querySelector('#fromcurrency');
let select_to_currency = document.querySelector('#tocurrency');
let input_value = document.querySelector('#currency-value');
let info_span = document.querySelector('#currency-info');
let calculted_value_output = document.querySelector('#calculated-value');
let showinfo_button = document.querySelector('#showinfo');
let calc_button = document.querySelector('#calc');
let valuta = null;
let opt = null;

window.onload = function() {
    loadValuta();
    showinfo_button.addEventListener('click', showInfo);
    calc_button.addEventListener('click', calculate);
}

async function calculate() {
    let value = input_value.value;
    let from = select_from_currency.selectedOptions[0].value;
    let to = select_to_currency.selectedOptions[0].value;

    console.log(url + `?cmd=calc&from=${from}&value=${value}&to=${to}`);
    await fetch(url + "?cmd=calc&from="+from+"&value="+value+"&to="+to)
        .then( response => response.json() )
        .then(data => {
            console.log(data);
            calculted_value_output.innerHTML = `${parseFloat(data.calculated_value).toFixed(2)} ${data.to}`;
        })
        .catch(error => console.log(error));
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
        select_from_currency.innerHTML += option_tag;
        select_to_currency.innerHTML += option_tag;
    }
}

function showInfo(e) {
    console.log(valuta[select_valuta_option.selectedIndex]);
    info_span.innerHTML = `&euro; 1.00 = ${valuta[select_valuta_option.selectedIndex].value} ${valuta[select_valuta_option.selectedIndex].abbr}`;
    info_span.innerHTML += `&nbsp;&nbsp;<img class='info-img' alt='' title='' src='${valuta[select_valuta_option.selectedIndex].flag}' />`;
}