const pekerjaanSelect = document.getElementById('pekerjaan');
const detailPekerjaan = document.getElementById('detailPekerjaan');
const detailPekerjaanSpesifik = document.getElementById('detailPekerjaanSpesifik');

// ketika pekerjaan di pilih
pekerjaanSelect.addEventListener('change', () => {
    // ambil nilainya kemudian simpan kedalam variable selectedValue
    const selectedValue = pekerjaanSelect.value;

    if (selectedValue === 'PNS') {
        // jika nilainya berupa pns
        detailPekerjaan.style.display = 'block';
        detailPekerjaanSpesifik.style.display = 'none';

    } else if (selectedValue === 'Lainnya') {
        // jika nilainnya Lainnya
        detailPekerjaan.style.display = 'none';
        detailPekerjaanSpesifik.style.display = 'block';

    } else {
        // Jika tidak ada yg dipilih
        detailPekerjaan.style.display = 'none';
        detailPekerjaanSpesifik.style.display = 'none';
    }
});

// Event listener untuk pilihan keperluan
document.getElementById('keperluan').addEventListener('change', function() {
    const selectedValue = this.value; // Nilai yang dipilih
    const keperluanInput = document.getElementById('keperluanInput'); // Elemen detail keperluan

    // Tampilkan input untuk detail keperluan jika pilihan adalah 'Lainnya'
    if (selectedValue === 'Lainnya') {
        keperluanInput.style.display = 'block';
    } else {
        keperluanInput.style.display = 'none';
    }
});