document.addEventListener("DOMContentLoaded", () => {

    const filterSelect = document.getElementById("filterSelect");
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("tableBody");
    const toggleButton = document.getElementById("toggleTable");

    /* ============================
       POPUP DELETE + DETAIL
    ============================= */
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btn-danger");
        if (!btn) return;

        e.preventDefault();
        const id = btn.dataset.id;
        const url = btn.getAttribute("href");
        showPopup(id, url);
    });

    function showPopup(id, url) {
        const root = document.getElementById("popup-root");
        root.innerHTML = PopupDel(id);

        document.querySelector(".btn-ok").addEventListener("click", () => {
            window.location.href = url;
        });

        document.querySelector(".btn-cancel").addEventListener("click", () => {
            root.innerHTML = "";
        });
    }

    function PopupDel(id) {
        return `
        <section class="popup delete">
            <div class="popup-container">
                <i class='bx bx-trash'></i>
                <div class="text">
                    <h1>Hapus Data?</h1>
                    <p>Yakin ingin menghapus data jurnal ini?</p>
                    <div class="container-btn">
                        <button class="btn-ok">Hapus</button>
                        <button class="btn-cancel">Batal</button>
                    </div>
                </div>
            </div>
        </section>`;
    }


    document.querySelectorAll(".btn-detail").forEach(btnDetail => {
        btnDetail.addEventListener("click", function () {
            let id = this.dataset.id;
            fetch("jurnal_detail.php?id=" + id)
                .then(res => res.text())
                .then(data => {
                    document.querySelector("#popup-detail .popup .popup-container-detail").innerHTML = data;
                    document.getElementById("popup-detail").classList.add('show');
                });
        });
    });


    /* ============================
           TABLE TOGGLE
    ============================= */
    function setupTableToggle(expandedDefault = false) {
        const rows = document.querySelectorAll('.table tbody tr');
        let expanded = expandedDefault;
        const today = new Date().toISOString().split("T")[0];
        let hiddenRows = [];

        rows.forEach(row => {
            const tglCell = row.querySelector('.col-tgl-mengajar');
            if (!tglCell) return;

            const rowDate = tglCell.textContent.trim();

            if (rowDate != today) {
                hiddenRows.push(row);
            }
        });

        if (hiddenRows.length === 0) {
            toggleButton.style.display = "none";
            return;
        }

        hiddenRows.forEach(row => {
            row.style.display = expanded ? "table-row" : "none";
        });

        toggleButton.style.display = "flex";
        toggleButton.innerHTML = expanded
            ? `<p>Sembunyikan</p><i class='bx bxs-chevrons-up'></i>`
            : `<p>Tampilkan Semua</p><i class='bx bxs-chevrons-down'></i>`;

        toggleButton.onclick = () => {
            expanded = !expanded;

            hiddenRows.forEach(row => {
                row.style.display = expanded ? "table-row" : "none";
            });

            toggleButton.innerHTML = expanded
                ? `<p>Sembunyikan</p><i class='bx bxs-chevrons-up'></i>`
                : `<p>Tampilkan Semua</p><i class='bx bxs-chevrons-down'></i>`;
        };
    }

    window.addEventListener("load", () => {
        setupTableToggle();
    });


    /* ============================
           FILTER HANDLER
    ============================= */
    filterSelect.addEventListener("change", () => {
        const filter = filterSelect.value;

        // ✅ reset search saat filter berubah
        searchInput.value = "";

        fetch(`jurnal_filter.php?filter=${encodeURIComponent(filter)}`)
            .then(res => res.text())
            .then(data => {
                tableBody.innerHTML = data;

                if (filter === "all" || filter === "semua") {
                    setupTableToggle(true);   // ✅ toggle expanded by default
                } else {
                    toggleButton.style.display = "none";
                }
            });
    });


    /* ============================
           SEARCH HANDLER
    ============================= */
    searchInput.addEventListener("keyup", () => {
    const value = searchInput.value.toLowerCase();
    const rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(value)
            ? ""
            : "none";
    });
});

});


function closePopup() {
    document.getElementById("popup-detail").classList.remove('show');
}
