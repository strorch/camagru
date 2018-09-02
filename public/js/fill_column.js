'use strict';

function create_post(user, photo) {
    var par_div = document.createElement("div");
    par_div.className = "block_post";

    var name = document.createElement("p");
    var br = document.createElement("br");
    var pict = document.createElement("img");

    name.innerHTML = user;
    pict.src = "data:image/jpeg;base64," + photo;
    pict.height = 100;
    pict.width = 140;
    par_div.appendChild(name);
    par_div.appendChild(pict);
    par_div.appendChild(br);

    return par_div;
}

fetch('/posts')
    .then(function(response) {
        return response.json()
    })
    .then(function (input) {
        var parent = document.getElementById("pictures");

        input.forEach(function (item, i, arr) {
            var post = create_post(item["USER"], item["PICT"]);
            parent.appendChild(post);
        });

    });
