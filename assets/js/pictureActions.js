const sendCommentInit = () => {
    let commentButtons = Array.from(document.getElementsByClassName('send-comment'));
    commentButtons.forEach(el => {
        el.onclick = event => {
            let post_id = event.target.id;
            let comment = document.querySelector(`input[id='${post_id}']`).value;
            let propObj = {
                method: 'POST',
                credentials: 'include',
                body: JSON.stringify({
                    'post_id': post_id,
                    'comment': comment
                })
            };
            debugger
            fetch('/sendComment', propObj)
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
    });
};

const sendLikeInit = () => {
    let likeButtons = Array.from(document.getElementsByClassName('send-like'));
    likeButtons.map(el => {
        el.onclick = event => {
            let post_id = event.target.id;
            let propObj = {
                method: 'POST',
                credentials: 'include',
                body: JSON.stringify({
                    'post_id': post_id
                })
            };
            fetch('/sendLike', propObj)
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
    });
};

window.onload = () => {
    sendCommentInit();
    sendLikeInit();
};
