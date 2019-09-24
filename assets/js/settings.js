const changeRoutine = (value, action) => {
    const btn = document.getElementById(value + '-button');
    btn.onclick = (e) => {
        const input = document.getElementById(value + '-input');
        let _csrf = document.querySelector("meta[name='csrf-token']").content;

        let propObj = {
            method: 'POST',
            credentials: 'include',
            body: JSON.stringify({
                'newValue': input.value,
                '_csrf': _csrf
            })
        };
        fetch(action, propObj)
            .then(e => {
                return e.json();
            })
            .then(e => {
                if (e.res === 'error') {
                    const popup = `<div id="card-panel" class="card-panel"><span class="red-text text-darken-2">Wrong input</span></div>`;
                    Array.from(document.getElementsByTagName('main'))[0].innerHTML += popup;
                    setTimeout(e => {
                        document.getElementById('card-panel').remove();
                    }, 2000);
                } else {
                    const popup = `<div id="card-panel" class="card-panel"><span class="blue-text text-darken-2">Param successfully changed</span></div>`;
                    Array.from(document.getElementsByTagName('main'))[0].innerHTML += popup;
                    setTimeout(e => {
                        document.getElementById('card-panel').remove();
                    }, 2000);
                }
                changeRoutine('username', '/changeUsername');
                changeRoutine('email', '/changeEmail');
                changeRoutine('password', '/changePassword');
            })
            .catch(e => {
                notifyUser(e, 'Error, try later');
            });
    }
};

const emailNotification = () => {
    let check = document.getElementById('notifications-click');
    let _csrf = document.querySelector("meta[name='csrf-token']").content;
    check.onclick = (e) => {
        let checked = e.target.checked;

        let propObj = {
            method: 'POST',
            credentials: 'include',
            body: JSON.stringify({
                'checked': checked,
                '_csrf': _csrf
            })
        };
        fetch('/enableNotifications', propObj)
            .then(e => {
                return e.json();
            })
            .then(e => {
            })
            .catch(e => {
                console.log(e);
            });
    };
};

window.onload = () => {
    changeRoutine('username', '/changeUsername');
    changeRoutine('email', '/changeEmail');
    changeRoutine('password', '/changePassword');
    emailNotification();
};
