const changeRoutine = (value, action) => {
    const btn = document.getElementById(value + '-button');
    btn.onclick = (e) => {
        const input = document.getElementById(value + '-input');

        let propObj = {
            method: 'POST',
            credentials: 'include',
            body: JSON.stringify({
                'newValue': input.value
            })
        };
        fetch(action, propObj)
            .then(e => {
                return e.json();
            })
            .then(e => {
                //TODO: like push animation
            })
            .catch(e => {
                console.log(e);
            });
    }
};

const emailNotification = () => {
    let check = document.getElementById('notifications-click');
    check.onclick = (e) => {
        let checked = e.target.checked;

        let propObj = {
            method: 'POST',
            credentials: 'include',
            body: JSON.stringify({
                'checked': checked
            })
        };
        fetch('/enableNotifications', propObj)
            .then(e => {
                return e.json();
            })
            .then(e => {
                //TODO: like push animation
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