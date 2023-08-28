const target = document.getElementById("target");
const menu = document.getElementById("menu");
const back = document.getElementById("back");
const scrolltop = document.getElementById("scrolltop");
const scrollmenu = document.getElementById("scrollmenu");
const n = 200;

window.addEventListener("scroll", function() {
    if(scrollY > n) {
    scrolltop.classList.add("look");
    scrollmenu.classList.add("look");
} else {
    scrolltop.classList.remove("look");
    scrollmenu.classList.remove("look");
}
});

scrolltop.addEventListener("click", function() {
   anime({                               //animeライブラリここから
        targets: "html, body",
        scrollTop: 0,
        dulation: 600,
        easing: 'easeOutCubic',
    });  
});

target.addEventListener("click", function() {
    menu.classList.toggle("open");
    back.classList.toggle("black");
});

back.addEventListener("click", function() {
        menu.classList.remove("open");
    back.classList.remove("black");
});

scrollmenu.addEventListener("click", () => {
        menu.classList.add("open");
    back.classList.add("black");
});