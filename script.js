// const pekerjaanAnda = document.getElementById("pekerjaanAnda");
// const asal_instansi = document.getElementById("asal_instansi");

// pekerjaanAnda.addEventListener("change", function () {
//             if (this.value === "PNS") {
//                 asal_instansi.classList.remove("hidden");

//             } else {
//                 asal_instansi.classList.add("hidden");
//             }
//         });

document.getElementById('pekerjaan').addEventListener('change', function() {
    var selectedValue = this.value;
    var additionalInputDiv = document.getElementById('additionalInput');
    var additionalInputDiv2 = document.getElementById('additionalInput2');

    // Show the input field if "Lainnya" is selected, otherwise hide it
    if (selectedValue === 'Lainnya') {
        additionalInputDiv.style.display = 'block';
        additionalInputDiv2.style.display = 'none';
    } else if (selectedValue === 'PNS') {
        additionalInputDiv2.style.display = 'block';
        additionalInputDiv.style.display = 'none';
    } else {
        additionalInputDiv.style.display = 'none';
        additionalInputDiv2.style.display = 'none';
    }
});

document.getElementById('keperluan').addEventListener('change', function() 
    {
        var selectedValue = this.value;
        var statusInputDiv = document.getElementById('keperluanInput');

        // Show the input field if "Lainnya" is selected, otherwise hide it
        if (selectedValue === 'Lainnya') {
            statusInputDiv.style.display = 'block';
        } else {
            statusInputDiv.style.display = 'none';
        }
    });