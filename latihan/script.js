//Fungsi untuk menampilkan konten sesuai menu
        function showContent(id) {
            var contents = document.querySelectorAll('.content');
            contents.forEach(content => content.classList.remove('active'));

            var menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('active'));

            document.getElementById(id).classList.add('active');
            event.target.classList.add('active');
        }

        // Fungsi untuk membuka modal tambah atau edit
        function openModal(type, noPlat) {
            if (type === 'add') {
                document.getElementById('modalTitle').textContent = "Tambah Data Kendaraan";
                document.getElementById('modalForm').reset();
                document.getElementById('modalNoPlat').value = '';
            } else if (type === 'edit' && noPlat) {
                document.getElementById('modalTitle').textContent = "Edit Data Kendaraan";
                fetch(`getMobil.php?no_plat=${noPlat}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modalNoPlat').value = data.no_plat;
                        document.getElementById('modalNama').value = data.nama;
                        document.getElementById('modalTipeKendaraan').value = data.tipe_kendaraan;
                        document.getElementById('modalStatus').value = data.status;
                        document.getElementById('modalHargaSewa').value = data.harga_sewa;
                    });
            }
            document.getElementById('modal').style.display = 'flex';
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        // Fungsi untuk mengirim data form (tambah/edit)
        document.getElementById('modalForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            var url = document.getElementById('modalNoPlat').value ? 'updateMobil.php' : 'addKendaraan.php';

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                alert(result);
                closeModal();
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
        function openValidationModal(idSewa, idKendaraan) {
            document.getElementById('validationIdSewa').value = idSewa;
            document.getElementById('validationIdKendaraan').value = idKendaraan;
            document.getElementById('validationModal').style.display = 'block';
        }

        function closeValidationModal() {
            document.getElementById('validationModal').style.display = 'none';
        }

        document.getElementById('validationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const idSewa = document.getElementById('validationIdSewa').value;
            const idKendaraan = document.getElementById('validationIdKendaraan').value;
            const tglKembali = document.getElementById('validationTglKembali').value;
            const denda = document.getElementById('validationDenda').value;
            const kondisi = document.getElementById('validationKondisi').value;

            fetch('proses_validasi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id_sewa=${idSewa}&id_kendaraan=${idKendaraan}&tgl_kembali=${tglKembali}&denda=${denda}&kondisi=${kondisi}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                closeValidationModal();
                location.reload();
            });
        });  