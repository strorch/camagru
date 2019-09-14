const enableNavigator = () => {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                //video.src = window.URL.createObjectURL(stream);
                video.srcObject = stream;
                video.play();
            });
    }
    else if(navigator.getUserMedia) { // Standard
        navigator.getUserMedia({ video: true }, function(stream) {
            video.src = stream;
            video.play();
        }, errBack);
    } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
        navigator.webkitGetUserMedia({ video: true }, function(stream){
            video.src = window.webkitURL.createObjectURL(stream);
            video.play();
        }, errBack);
    } else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
        navigator.mozGetUserMedia({ video: true }, function(stream){
            video.srcObject = stream;
            video.play();
        }, errBack);
    }
};

const getStickers = () => {
    let propObj = {
        method: 'GET',
        headers: {
            method: 'GET',
            credentials: 'include',
        }
    };
    fetch('/getStickers', propObj)
        .then(e => {
            return e.text();
        })
        .then(e => {
            let container = document.getElementById('sticker-container');
            container.innerHTML = e;
        })
        .then(e => {
            stickerSelect();
        })
        .catch(e => {
            console.log(e);
        });
};

const stickerSelect = (event) => {
    let stickerDivs = Array.from(document.getElementsByClassName('sticker-div'));
    stickerDivs.map((el) => {
        el.onclick = (ev) => {
            let tmpSticker = document.getElementById('selected-sticker');
            // debugger
            if (tmpSticker !== null && tmpSticker !== undefined) {
                tmpSticker.remove();
            }
            let domImage = ev.currentTarget.children[0];

            let selectedSticker = document.createElement('img');
            selectedSticker.id = 'selected-sticker';
            selectedSticker.src = domImage.src;
            selectedSticker.dataset.id = ev.currentTarget.dataset.id;

            let canvasContainer = document.getElementById('canvas-container');
            canvasContainer.appendChild(selectedSticker);
            // let img = new Image();
            // img.onload = () => {
            //     context.drawImage(img,0,0);
            // };
            // img.src = domImage.src;
        };
    });
};

const snapInit = () => {
    const snapClick = () => {
        let sticker = document.getElementById('selected-sticker');
        const stikerAttributes = {
            "id" : sticker.dataset.id,
            "position": {
                "x": sticker.x,
                "y": sticker.y,
            }
        };
        let canvas = document.getElementById('canvas');
        let image = canvas.toDataURL("image/png");
        const imageObject = {
            userImg: image,
            stickerAttrs: stikerAttributes
        };
        let propObj = {
            method: 'POST',
            credentials: 'include',
            body: JSON.stringify(imageObject)
        };
        fetch('/savePhoto', propObj)
            .then(e => {
                return e.json();
            })
            .then(e => {
                //TODO: file saved message
            })
            .catch(e => {
                console.log(e);
            });
    };

    let snap = document.getElementById('snap');
    snap.onclick = snapClick;
};

window.onload = (event) => {
    let makePhoto = document.getElementById('make-photo');
    let loadPicture = document.getElementById('load-picture');

    makePhoto.onclick = () => {
        let photoContainer = document.querySelector('.make-photo-container');
        photoContainer.innerHTML = '\n' +
            '<video id="video" width="640" height="480" autoplay></video>\n' +
            '<button id="snap">Snap Photo</button>\n' +
            '<div id="canvas-container"><canvas id="canvas" width="640" height="480"></canvas></div>\n';
        enableNavigator();
        let canvas = document.getElementById('canvas');
        let context = canvas.getContext('2d');
        let video = document.getElementById('video');
        document.getElementById("snap").addEventListener("click", () => {
            context.drawImage(video, 0, 0, 640, 480);
        });
        getStickers();
        snapInit();
    };

    loadPicture.onclick = () => {
        let body = document.querySelector('.make-photo-container');
        body.innerHTML =
            '<input id="file-input" type="file" value="Load file">' +
            '<div id="canvas-container"><canvas id="canvas" width="640" height="480"></canvas></div>' +
            '<button id="snap">Snap Photo</button>';
        let canvas = document.getElementById('canvas');
        let context = canvas.getContext('2d');
        document.getElementById('file-input').onchange = (ev) => {
            let file = ev.target.files[0];
            let fr = new FileReader();
            fr.onload = () => {
                let img = new Image();
                img.onload = () => {
                    canvas.width = img.width;
                    canvas.height = img.height;
                    context.drawImage(img,0,0);
                };
                img.src = fr.result;
                // canvas.toDataURL("image/png");  // get the data URL
            };
            fr.readAsDataURL(file);
        };
        getStickers();
        snapInit();
    };
};
