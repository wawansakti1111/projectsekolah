// resources/js/app.js

import './bootstrap';

import Alpine from 'alpinejs';
// Import SweetAlert2
import Swal from 'sweetalert2';
import Sortable from 'sortablejs';
import * as FilePond from 'filepond';

// Import plugin-plugin FilePond
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Import CSS FilePond
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

// Daftarkan plugin-plugin
FilePond.registerPlugin(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

// Inisialisasi semua elemen dengan class 'filepond' saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    const inputElement = document.querySelector('input.filepond');
    if(inputElement) {
        FilePond.create(inputElement, {
            allowMultiple: true,
            allowReorder: true,
            acceptedFileTypes: ['image/png', 'image/jpeg', 'application/pdf', 'video/mp4', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'],
            fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                resolve(type);
            }) // <-- INI PERBAIKANNYA
        });
    }
});

window.Sortable = Sortable;
window.Alpine = Alpine;

Alpine.start();


// ▼▼▼ TAMBAHKAN KODE DI BAWAH INI ▼▼▼


// Fungsi untuk menangani klik tombol hapus
function handleDeleteButtons() {
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        // Hapus event listener lama untuk menghindari duplikasi
        button.replaceWith(button.cloneNode(true));
    });

    // Pasang event listener baru
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const formId = this.dataset.formId;
            const form = document.getElementById(`delete-form-${formId}`);

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
}

// Panggil fungsi saat halaman pertama kali dimuat
handleDeleteButtons();
