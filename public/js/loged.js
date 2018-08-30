
function get_login_form() {
    var parent = document.createElement("form");
    parent.method = "post";
    parent.action = "./user/login";
    parent.id = "login_form";

    var br1 = document.createElement("br");
    var br2 = document.createElement("br");

    var login = document.createElement("input");
    login.type = "text";
    login.name = "login";
    var passwd = document.createElement("input");
    passwd.type = "password";
    passwd.name = "passwd";
    var button = document.createElement("input");
    button.type = "submit";
    button.name = "submit";
    button.value = "OK";

    parent.appendChild(login);
    parent.appendChild(br1);
    parent.appendChild(passwd);
    parent.appendChild(br2);
    parent.appendChild(button);

    return parent;
}

fetch('/user/loged')
    .then(function(response) {
        return response.json()
    })
    .then(function (input) {

        // if (input["login"] !== "" && input["login"] !== null)
        // {
        //     console.log(input);
        // }
        // else
        // {
            var parent = document.getElementById("create_block");
            parent.appendChild(get_login_form());
        //}
    });