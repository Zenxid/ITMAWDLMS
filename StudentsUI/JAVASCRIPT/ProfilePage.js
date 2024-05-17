var content1 = document.getElementById("content1");
var content2 = document.getElementById("content2");
var content3 = document.getElementById("content3");
var btn1 = document.getElementById("bookButton");
var btn2 = document.getElementById("ps4Button");
var btn3 = document.getElementById("boardButton");
var linespan = document.getElementById("linespan");

function openBook() {
    content1.style.display = "grid";
    content2.style.display = "none";
    content3.style.display = "none";
    linespan.style.left = "0"
    linespan.style.width = "141px";
}

function openPS4() {
    content1.style.display = "none";
    content2.style.display = "grid";
    content3.style.display = "none";
    linespan.style.left = "155px"
    linespan.style.width = "141px";
}

function openBoard() {
    content1.style.display = "none";
    content2.style.display = "none";
    content3.style.display = "grid";
    linespan.style.left = "300px";
    linespan.style.width = "220px";
}