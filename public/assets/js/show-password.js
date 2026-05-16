"use strict";

let createpassword = (type, ele) => {
    const input = document.getElementById(type);
    input.type = input.type === "password" ? "text" : "password";

    const icon = ele.childNodes[0].classList;
    const stringIcon = icon.toString();

    if (stringIcon.includes("ri-eye-line")) {
        ele.childNodes[0].classList.remove("ri-eye-line");
        ele.childNodes[0].classList.add("ri-eye-off-line");
    } else {
        ele.childNodes[0].classList.add("ri-eye-line");
        ele.childNodes[0].classList.remove("ri-eye-off-line");
    }
};
