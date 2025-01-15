document.getElementById('pekerjaan').addEventListener('change', function() {
                    var selectedValue = this.value;
                    var additionalInputDiv = document.getElementById('additionalInput');
                    var additionalInputDiv2 = document.getElementById('additionalInput2');

                    // Show the input field if "Pekerjaan Lainnya" or "PNS" is selected, otherwise hide it
                    if (selectedValue === 'Pekerjaan_lainnya') {
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

                document.getElementById('keperluan').addEventListener('change', function() {
                    var selectedValue = this.value;
                    var statusInputDiv = document.getElementById('keperluanInput');

                    // Show the input field if "Lainnya" is selected, otherwise hide it
                    if (selectedValue === 'Lainnya') {
                        statusInputDiv.style.display = 'block';
                    } else {
                        statusInputDiv.style.display = 'none';
                    }
                });