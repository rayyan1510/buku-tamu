document.getElementById('pekerjaanAnda').addEventListener('change', function() {
    var selectedValue = this.value; // Nilai yang dipilih
    var detailPekerjaan = document.getElementById('detailPekerjaan'); // Elemen detail pekerjaan
    var detailPekerjaanSpesifik = document.getElementById('detailPekerjaanSpesifik');

    // Show the input field if "Pekerjaan Lainnya" or "PNS" is selected, otherwise hide it
    if (selectedValue === 'Lainnya') {
        detailPekerjaan.style.display = 'block';
        detailPekerjaanSpesifik.style.display = 'none';
    } else if (selectedValue === 'PNS') {
        detailPekerjaanSpesifik.style.display = 'block';
        detailPekerjaan.style.display = 'none';
    } else {
        detailPekerjaan.style.display = 'none';
        detailPekerjaanSpesifik.style.display = 'none';
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