const sendCommentInit = () => {
    let commentButtons = Array.of(document.getElementsByClassName('send-comment'));
    commentButtons.forEach(el => {
        el.onclick = event => {
            let post_id = event.target.id;
            let propObj = {
                method: 'POST',
                credentials: 'include',
                body: JSON.stringify({
                    'post_id': post_id
                })
            };
            fetch('/sandLike', propObj)
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
    let likeButtons = Array.of(document.getElementsByClassName('send-like'));
    likeButtons.forEach(el => {
        el.onclick = event => {
            let post_id = event.target.id;
            let comment = document.querySelector(`input[id=${post_id}]`).text;
            let propObj = {
                method: 'POST',
                credentials: 'include',
                body: JSON.stringify({
                    'post_id': post_id,
                    'comment': comment
                })
            };
            fetch('/sandComment', propObj)
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
