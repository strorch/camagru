const tabsClickAction = (event) => {
    let tabcontent = document.getElementsByClassName("tabcontent");
    for (let item of tabcontent) {
        item.style.display = "none";
    }

    let tablinks = document.getElementsByClassName("tablinks");
    for (let item of tablinks) {
        item.className = item.className.replace(" active", "");
    }
    document.getElementById(event.target.dataset.target).style.display = "block";
    this.className += " active";
};

window.onload = function () {
    document.getElementById('button-login').onclick = tabsClickAction;
    document.getElementById('button-register').onclick = tabsClickAction;
    document.getElementById('button-forget-password').onclick = tabsClickAction;
    document.getElementById('button-login').click();
};
