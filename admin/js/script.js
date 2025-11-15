document.addEventListener("DOMContentLoaded", () => {
    const btnClosePopup = document.querySelectorAll(".close-popup");

btnClosePopup.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();

        // popup terdekat dari tombol yang ditekan
        const popup = btn.closest(".popup");
        if (popup) {
            popup.style.display = "none";
        }
    });
});
});