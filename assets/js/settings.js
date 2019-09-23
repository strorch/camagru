const notifyUser = (e) => {
    if (e.res === 'error') {
        console.log('error');
        return;
    }
    //TODO: implement function
    console.log('success');
};

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
                notifyUser(e);
            })
            .catch(e => {
                console.log(e);
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
                notifyUser(e);
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
