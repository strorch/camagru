const sendCommentInit = () => {
    let commentButtons = Array.from(document.getElementsByClassName('send-comment'));
    commentButtons.forEach(el => {
        el.onclick = event => {
            let post_id = event.target.id;
            let comment = document.querySelector(`input[id='${post_id}']`).value;
            let _csrf = document.querySelector("meta[name='csrf-token']").content;
            let propObj = {
                method: 'POST',
                credentials: 'include',
                body: JSON.stringify({
                    'post_id': post_id,
                    'comment': comment,
                    _csrf: _csrf
                })
            };
            fetch('/sendComment', propObj)
                .then(e => {
                    return e.json();
                })
                .then(e => {
                    if (e.res === 'error') {
                        return ;
                    }

                    document.querySelector(`div.comments-block[id="${post_id}"]`).innerHTML = e.comments;
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
            let target = event.target;
            let post_id = event.target.id;
            let _csrf = document.querySelector("meta[name='csrf-token']").content;
            let propObj = {
                method: 'POST',
                credentials: 'include',
                body: JSON.stringify({
                    'post_id': post_id,
                    _csrf: _csrf
                })
            };
            fetch('/sendLike', propObj)
                .then(e => {
                    return e.json();
                })
                .then(e => {
                    if (e.res === 'error') {
                        return;
                    }
                    if (e.is_like) {
                        target.className = "send-like fa fa-2x fa-heart";
                    } else {
                        target.className = "send-like fa fa-2x fa-heart-o";
                    }
                    document.querySelector(`div[id='${post_id}'][class*='count-likes']`).innerHTML = e.likes;
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
