'use strict';

fetch('/posts')
    .then(function(response) {
        return response.json()
    })
    .then(function (input) {

        console.log(input);
/*
        var parent = document.getElementById("pictures");

        input.forEach(function (item, i, arr) {
            var br = document.createElement("br");
            var pict = document.createElement("img");
            pict.src = "data:image/jpeg;base64," + item;
            pict.height = 100;
            pict.width = 140;
            parent.appendChild(pict);
            parent.appendChild(br);
        });*/


    });
