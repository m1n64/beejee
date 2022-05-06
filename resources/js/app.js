import {callback} from "./functions";

require("./loads");
import toastr from "toastr";

document.addEventListener("DOMContentLoaded", (evt)=>{
    document.querySelector("#sort").onchange = ()=>{
        document.querySelector("form#changeSort").submit();
    }

    document.querySelector("#addTask").addEventListener("submit", ()=>{
        toastr.success('', 'Task was added!', {timeOut: 5000})
    });

    let loginButton = document.querySelector("#loginButton");

    if (loginButton !== null) {
        loginButton.addEventListener("click", () => {
            let login = document.querySelector("#login").value;
            let password = document.querySelector("#password").value;

            let fd = new FormData();

            fd.append("login", login);
            fd.append("password", password);

            axios.post("/login/auth", fd)
                .then((response)=>{
                    if (response.data.status) return location.reload();

                    toastr.error("", response.data.message, {timeOut: 5000})
                })
        });
    }

    let exitButton = document.querySelector("#exitButton");

    if (exitButton !== null) {
        exitButton.addEventListener("click", ()=>{
            axios.get("/login/logout")
                .then((response)=>{
                    if (response.data.status) return location.reload();
                })
        })
    }

    [].forEach.call(document.querySelectorAll(".changeStatusTask"), (elem)=>{
        elem.addEventListener("change", (event)=>{
            let id = event.target.getAttribute("data-id");
            let status = event.target.checked ? 1 : 0;

            let fd = new FormData();

            fd.append("is_done", status);

            axios.post("/main/updateStatus?id="+id, fd)
                .then((response)=>{
                    callback(response);
                })
        })
    });

    [].forEach.call(document.querySelectorAll(".saveTextTask"), (elem)=>{
        elem.addEventListener("click", (event)=>{
            let id = event.target.getAttribute("data-id");
            let text = document.querySelector(".taskText-"+id).value;

            let fd = new FormData();

            fd.append("text", text);

            axios.post("/main/updateTask?id="+id, fd)
                .then((response)=>{
                    callback(response);
                })
        })
    })

})