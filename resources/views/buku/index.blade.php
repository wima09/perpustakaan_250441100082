@extends('layouts.app')
@section('title', 'Daftar Buku')
@section('content')
    <div class="space-y-6">

        <!-- Judul Halaman -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">
                Data Buku
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Daftar koleksi buku yang tersedia di perpustakaan.
            </p>
        </div>

        <!-- Form Tambah dan Edit Buku -->
        @can('kelola data buku')
            <div class="bg-white border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-5">
                    Tambah Buku
                </h2>

                <form id="form-buku" class="space-y-4">
                    <input type="hidden" id="buku_id">

                    <div>
                        <label for="kategori_id"
                            class="block text-sm font-medium text-gray-700 mb-1">
                            Kategori
                        </label>
                        <select id="kategori_id" name="kategori_id" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih kategori</option>
                            <option value="1">Novel</option>
                            <option value="2">Sejarah</option>
                            <option value="3">Pengembangan Diri</option>
                        </select>
                    </div>

                    <div>
                        <label for="judul"
                            class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Buku
                        </label>
                        <input type="text" id="judul" name="judul" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="penulis"
                            class="block text-sm font-medium text-gray-700 mb-1">
                            Penulis
                        </label>
                        <input type="text" id="penulis" name="penulis" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="tahun_terbit"
                            class="block text-sm font-medium text-gray-700 mb-1">
                            Tahun Terbit
                        </label>
                        <input type="number" id="tahun_terbit"
                            name="tahun_terbit" required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex gap-2 pt-2">
                        <button type="submit" id="tombol-simpan"
                            class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                            Tambah Buku
                        </button>

                        <button type="button" id="tombol-batal" hidden
                            class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        @endcan

        <!-- Pesan -->
        <p id="pesan" role="status" class="text-sm text-gray-600">
            Memuat data buku...
        </p>

        <!-- Tabel Data Buku -->
        <div class="bg-white border border-gray-200 overflow-x-auto">
            <div class="p-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    Daftar Koleksi Buku
                </h2>
            </div>

            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Kategori</th>
                        <th class="px-5 py-3 font-semibold">Judul</th>
                        <th class="px-5 py-3 font-semibold">Penulis</th>
                        <th class="px-5 py-3 font-semibold">Tahun Terbit</th>

                        @if(auth()->user()->can('kelola data buku') || auth()->user()->hasRole('Siswa'))
                            <th class="px-5 py-3 font-semibold">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody id="tabel-buku" class="divide-y divide-gray-200 text-gray-700">
                    <tr>
                        <td colspan="5" class="px-5 py-6 text-center text-sm text-gray-500">
                            Memuat data buku...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        const bolehKelola = @json(auth()->user()->can('kelola data buku'));
        const siswa = @json(auth()->user()->hasRole('Siswa'));
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const headerKeamanan = {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        };
        async function tampilkanBuku() {
            const tabel = document.getElementById('tabel-buku');
            const pesan = document.getElementById('pesan');

            try {
                const response = await fetch('/api/buku', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal mengambil data buku. Status: ' + response.status);
                }

                let hasil = {};

                try {
                    hasil = await response.json();
                } catch {
                    throw new Error('Server mengirim respons yang tidak valid.');
                }
                const buku = hasil.data;

                tabel.innerHTML = '';

                if (!buku || buku.length === 0) {
                    tabel.innerHTML = `<tr><td colspan="${bolehKelola ? 5 : 4}">Belum ada data buku.</td></tr>`;
                    pesan.textContent = '';
                    return;
                }

                buku.forEach(item => {
                    const baris = document.createElement('tr');

                    const kategori = document.createElement('td');
                    kategori.textContent = item.kategori ?? '-';
                    kategori.className = 'px-5 py-4 text-sm text-gray-600';

                    const judul = document.createElement('td');
                    judul.textContent = item.judul ?? '-';
                    judul.className = 'px-5 py-4 text-sm font-medium text-gray-800';

                    const penulis = document.createElement('td');
                    penulis.textContent = item.penulis ?? '-';
                    penulis.className = 'px-5 py-4 text-sm text-gray-600';

                    const tahun = document.createElement('td');
                    tahun.textContent = item.tahun_terbit ?? '-';
                    tahun.className = 'px-5 py-4 text-sm text-gray-600';

                    const aksi = document.createElement('td');
                    if (bolehKelola) {
                        
                    const tombolUbah = document.createElement('button');
                    tombolUbah.textContent = 'Ubah';
                    tombolUbah.type = 'button';
                    tombolUbah.className = 'px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 mr-2';

                    tombolUbah.addEventListener('click', async function () {
                        try {
                            const response = await fetch('/api/buku/' + item.id, {
                                headers: {
                                    'Accept': 'application/json'
                                },
                                credentials: 'same-origin'
                            });

                            if (!response.ok) {
                                throw new Error('Gagal mengambil detail buku.');
                            }

                            let hasil = {};

                            try {
                                hasil = await response.json();
                            } catch {
                                throw new Error('Server mengirim respons yang tidak valid.');
                            }
                            const buku = hasil.data ?? hasil;

                            document.getElementById('buku_id').value = buku.id;
                            document.getElementById('kategori_id').value =
                                buku.kategori_id ?? buku.kategori?.id ?? '';
                            document.getElementById('judul').value = buku.judul ?? '';
                            document.getElementById('penulis').value = buku.penulis ?? '';
                            document.getElementById('tahun_terbit').value =
                                buku.tahun_terbit ?? '';

                            document.getElementById('tombol-simpan').textContent = 'Simpan Perubahan';
                            document.getElementById('tombol-batal').hidden = false;

                            document.getElementById('form-buku').scrollIntoView({
                                behavior: 'smooth'
                            });
                        } catch (error) {
                            document.getElementById('pesan').textContent = error.message;
                        }
                    });

                    aksi.appendChild(tombolUbah);

                    const tombolHapus = document.createElement('button');
                    tombolHapus.textContent = 'Hapus';
                    tombolHapus.type = 'button';
                    tombolHapus.className = 'px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700';

                    tombolHapus.addEventListener('click', async function () {
                        const konfirmasi = confirm(
                            'Apakah kamu yakin ingin menghapus buku "' + item.judul + '"?'
                        );

                        if (!konfirmasi) {
                            return;
                        }

                        const pesan = document.getElementById('pesan');

                        try {
                            const response = await fetch('/api/buku/' + item.id, {
                                method: 'DELETE',
                                headers: headerKeamanan,
                                credentials: 'same-origin'
                            });

                            
                        let hasil = {};

                        try {
                            hasil = await response.json();
                        } catch {

                        }

                        if (!response.ok) {
                            throw new Error(
                                hasil.message || 'Buku gagal dihapus. Status: ' + response.status
                            );
                        }

                        await tampilkanBuku();

                        pesan.textContent = hasil.message || 'Buku berhasil dihapus.';

                        } catch (error) {
                            pesan.textContent = error.message ||
                                'Terjadi kesalahan jaringan saat menghapus buku.';
                        }
                    });

                    aksi.appendChild(tombolHapus);}

                    if (siswa) {
                        const tombolAjukan = document.createElement('button');
                        tombolAjukan.textContent = 'Ajukan Peminjaman';
                        tombolAjukan.type = 'button';
                        tombolAjukan.className = 'px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700';

                        tombolAjukan.addEventListener('click', function () {
                            const konfirmasi = confirm(
                                'Ajukan peminjaman buku "' + item.judul + '"?'
                            );

                            if (!konfirmasi) {
                                return;
                            }

                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = '/peminjaman';

                            const token = document.createElement('input');
                            token.type = 'hidden';
                            token.name = '_token';
                            token.value = csrfToken;

                            const bukuId = document.createElement('input');
                            bukuId.type = 'hidden';
                            bukuId.name = 'buku_id';
                            bukuId.value = item.id;

                            form.append(token, bukuId);
                            document.body.appendChild(form);
                            form.submit();
                        });

                        aksi.appendChild(tombolAjukan);
                    }
                
                    baris.append(kategori, judul, penulis, tahun);

                    if (bolehKelola || siswa) {
                        baris.appendChild(aksi);
                    }

                    tabel.appendChild(baris);
                });

                pesan.textContent = '';
            } catch (error) {
                tabel.innerHTML = `<tr><td colspan="${bolehKelola ? 5 : 4}">Data buku gagal dimuat.</td></tr>`;
                pesan.textContent = error.message;
            }
        }

        
        const formBuku = document.getElementById('form-buku');
        if (formBuku) {


        formBuku.addEventListener('submit', async function (event) {
            event.preventDefault();

            const pesan = document.getElementById('pesan');
            const bukuId = document.getElementById('buku_id').value;
            const sedangEdit = bukuId !== '';

            const dataBuku = {
                kategori_id: document.getElementById('kategori_id').value,
                judul: document.getElementById('judul').value.trim(),
                penulis: document.getElementById('penulis').value.trim(),
                tahun_terbit: Number(document.getElementById('tahun_terbit').value)
            };

            try {
                const response = await fetch(
                    sedangEdit ? '/api/buku/' + bukuId : '/api/buku',
                    {
                        method: sedangEdit ? 'PUT' : 'POST',
                        headers: headerKeamanan,
                        credentials: 'same-origin',
                        body: JSON.stringify(dataBuku)
                    }
                );

                
                let hasil = {};

                try {
                    hasil = await response.json();
                } catch {
                    throw new Error('Server mengirim respons yang tidak valid.');
                }

                if (!response.ok) {
                    const pesanError = hasil.message ||
                        (hasil.errors
                            ? Object.values(hasil.errors).flat().join(' ')
                            : 'Buku gagal disimpan.');

                    throw new Error(pesanError);
                }


                formBuku.reset();
                document.getElementById('buku_id').value = '';
                document.getElementById('tombol-simpan').textContent = 'Tambah Buku';
                document.getElementById('tombol-batal').hidden = true;

                await tampilkanBuku();

                pesan.textContent = hasil.message ||
                    (sedangEdit
                        ? 'Buku berhasil diperbarui.'
                        : 'Buku berhasil ditambahkan.');
            } catch (error) {
                pesan.textContent = error.message ||
                    'Terjadi kesalahan jaringan saat menyimpan buku.';
            }
        });


        document.getElementById('tombol-batal').addEventListener('click', function () {
            formBuku.reset();
            document.getElementById('buku_id').value = '';
            document.getElementById('tombol-simpan').textContent = 'Tambah Buku';
            this.hidden = true;
            document.getElementById('pesan').textContent = '';
        });
    }

        tampilkanBuku();
    </script>
@endsection
