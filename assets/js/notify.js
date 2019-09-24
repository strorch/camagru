const notifyUser = (e, text) => {
    const getWindow = (color) => {
        const popup = `<div id="card-panel" class="card-panel"><span class="${color}-text text-darken-2">${text}</span></div>`;
        Array.from(document.getElementsByTagName('main'))[0].innerHTML += popup;
        setTimeout(e => {
            document.getElementById('card-panel').remove();
        }, 2000);
    };
    if (e.res === 'error') {
        getWindow('red');
        return;
    }
    getWindow('blue');
};
