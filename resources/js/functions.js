import toastr from "toastr";

function callback(response) {
    if (!response.data.status) return toastr.error("", response.data.message, {timeOut: 5000});
    toastr.success('', response.data.message, {timeOut: 5000})
}

export {callback};