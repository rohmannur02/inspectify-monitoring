@extends('layouts.app')

@section('title', 'Standar Klasifikasi Defect Tire')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Standar Klasifikasi Defect Tire</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Defect</a></div>
                <div class="breadcrumb-item">Defect Standart</div>
            </div>
        </div>

        <div class="section-body">
            <form id="search-form" class="mb-4">
                <div class="input-group">
                    <input type="text" id="search-input" class="form-control" placeholder="Cari Area...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="search-button">Cari</button>
                    </div>
                </div>
            </form>

            <div class="searchable-content">
                <h2>Area Crown</h2>
                @component('components.card')
                @slot('title', '1. Crown Bare, Damage')
                @slot('causes', [
                ['type' => 'Bare', 'description' => 'Kondisi Aliran Compound tidak baik'],
                ['type' => 'Damage Mold', 'description' => 'Penyimpangan permukaan Tire terdapat goresan']
                ])
                @slot('criteria', [
                'headers' => ['Kedalaman', 'Luas', 'Panjang Max', 'Jumlah'],
                'rows' => [
                ['< 0,3 mm', 'Lolos, Terlepas dari Ukuran dan Jumlah' , '-' , '-' ], ['< 0,5
                    mm', 'Max 100 mm<sup>2</sup>' , 'Max 100 mm' , 'Max 3' ] ] ]) @slot('image', 'crown_bare.png' )
                    @endcomponent @component('components.card') @slot('title', '2. Pattern Bare (PB)' ) @slot('causes',
                    ['Ujung Pattern Membundar atau Seperti terkikis']) @slot('criteria', [ 'headers'=> ['Radius',
                    'Panjang / Jumlah'],
                    'rows' => [
                    ['Kurang dari 1mm', 'Tidak ada panjang dan batasan jumlah'],
                    ['1 mm – 2 mm', '<ul>
                        <li>Tipe Rib: Total panjang bare dalam 1 keliling tire kurang dari 10 cm</li>
                        <li>Tipe Blok: 3 Blok atau kurang dari 1 keliling</li>
                    </ul>'],
                    ['Lebih dari 2 mm', 'Tidak sesuai Jika ada 1 pcs pun']
                    ]
                    ])
                    @slot('image', 'pattern_bare.png')
                    @slot('additional_info', 'Sangat mungkin Berkelanjutan jika ditemukan dengan radius lebih dari 2mm,
                    hentikan dan periksa Proses Produksi')
                    @endcomponent
            </div>
        </div>

        <div class="section-body">
            <div class="searchable-content">
                <h2>Area Side</h2>
                @component('components.card')
                @slot('title', '1. Side Crack')
                @slot('causes', [
                ['type' => 'Crack', 'description' => 'Karet Tread tidak mengalir dengan baik sehingga lapisan karet
                retak/pecah terbuka seperti lipatan']
                ])
                @slot('criteria', [
                'headers' => ['DEFECT BERAT'],
                'rows' => [
                ['TIDAK ADA TOLERANSI'],
                ]
                ])
                @slot('image', 'side_crack.png')
                @slot('additional_info', 'Sangat mungkin Berkelanjutan jika ditemukan Segera
                hentikan dan periksa Proses Produksi')
                @endcomponent

                @component('components.card')
                @slot('title', '2. Pinch Air Trap')
                @slot('causes', ['Terdapat bagian karet ply pada permukaan inner menyusut, terpotong, atau terpisah dari
                cord atau bisa juga karena goresan yang sangat kecil (LIHAT GAMBAR)'])
                @slot('criteria', [
                'headers' => ['DEFECT BERAT'],
                'rows' => [
                ['Tidak ada Toleransi dari Ukuran maupun Jumlah'],
                ]
                ])
                @slot('image', 'pinch_air2.png')
                @slot('additional_info', 'Periksa Proses Curing dan Green Tire jika Defect di Temukan!')
                @endcomponent
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<!-- Page Specific JS File -->
<script>
    function performSearch() {
        var input = document.getElementById('search-input').value.toLowerCase();
        var sections = document.querySelectorAll('.searchable-content');
        var found = false;

        sections.forEach(function(section) {
            var text = section.innerText.toLowerCase();
            if (text.includes(input)) {
                section.style.display = 'block';
                found = true;
            } else {
                section.style.display = 'none';
            }
        });

        if (!found) {
            swal({
                title: "Tidak ditemukan",
                text: "Area yang Anda cari tidak ditemukan.",
                icon: "warning",
                button: "OK",
            });
        }
    }

    document.getElementById('search-button').addEventListener('click', performSearch);

    document.getElementById('search-input').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            performSearch();
        }
    });
</script>
@endpush