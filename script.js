const pekerjaanAnda = document.getElementById("pekerjaanAnda");
const asal_instansi = document.getElementById("asal_instansi");

pekerjaanAnda.addEventListener("change", function () {
            if (this.value === "PNS") {
                asal_instansi.classList.remove("hidden");

            } else {
                asal_instansi.classList.add("hidden");
            }
        });