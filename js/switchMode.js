const btnMode = document.querySelector(".btn-mode");
const imgContainer = document.querySelector(".img-container");
const textParagraph = document.querySelector(".text p");
const body = document.body;

// 🔹 Fungsi update UI sesuai mode
function setMode(mode) {
  if (mode === "light") {
    body.classList.add("light");
    btnMode.classList.remove("reverse");
    imgContainer.innerHTML = `<img src="assets/sun-icon.png" alt="" id="img-mode">`;
    textParagraph.textContent = "light";
    imgContainer.style.justifyContent = "flex-end";
  } else {
    body.classList.remove("light");
    imgContainer.innerHTML = `<img src="assets/moon-icon.png" alt="" id="img-mode">`;
    textParagraph.textContent = "dark";
    btnMode.classList.add("reverse");
    imgContainer.style.justifyContent = "flex-start";
  }
  localStorage.setItem("theme", mode);
}

// 🔹 Cek localStorage saat load
const savedTheme = localStorage.getItem("theme") || "dark";
setMode(savedTheme);

// 🔹 Event tombol
btnMode.addEventListener("click", () => {
  btnMode.classList.add("active");

  setTimeout(() => {
    // toggle
    if (btnMode.classList.contains("reverse")) {
      imgContainer.style.justifyContent = "flex-start";
    } else {
      imgContainer.style.justifyContent = "flex-end";
    }

    btnMode.classList.remove("active");

      if (body.classList.contains("light")) {
        setMode("dark");
      } else {
        setMode("light");
      }

  }, 300);
});