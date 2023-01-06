var acc = document.querySelectorAll(".head");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].querySelector('.show').addEventListener("click", function() {
        head = this;
        for (let index = 0; index < 2; index++) { head = head.parentNode; }
        head.classList.toggle("active");
        var panel = head.nextElementSibling;
        if (panel.style.display === "block") {
        panel.style.display = "none";
        } else {
        panel.style.display = "block";
        }
    });
}