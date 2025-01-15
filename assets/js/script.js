document.getElementById('pekerjaan_tamu').addEventListener('change', function() {
    var selectedValue = this.value;
    var detailPekerjaan = document.getElementById('detailPekerjaan');

    // Show the input field if "Lainnya" is selected, otherwise hide it
    if (selectedValue === 'Lainnya') {
        detailPekerjaan.style.display = 'block';
    } else {
        detailPekerjaan.style.display = 'none';
    }
});

// Event listener untuk pilihan keperluan
document.getElementById('keperluan').addEventListener('change', function() {
    var selectedValue = this.value; // Nilai yang dipilih
    var keperluanInput = document.getElementById('keperluanInput'); // Elemen detail keperluan

    // Tampilkan input untuk detail keperluan jika pilihan adalah 'Lainnya'
    if (selectedValue === 'Lainnya') {
        keperluanInput.style.display = 'block';
    } else {
        keperluanInput.style.display = 'none';
    }
});