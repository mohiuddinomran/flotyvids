document.addEventListener("DOMContentLoaded", function () {
    var closeBtn = document.getElementById("floatyvids-close");
    var bubble = document.getElementById("floatyvids-bubble");

    if (closeBtn && bubble) {
        closeBtn.addEventListener("click", function () {
            bubble.style.display = "none";
        });
    }
});
