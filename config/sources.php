<?php

/**
 * Konfigurasi Terpusat — Sumber Data & Referensi
 * 
 * File ini menjadi single source of truth untuk seluruh referensi
 * yang ditampilkan di information section, data sources section, dan footer.
 * 
 * Cara menambah sumber baru:
 * - Tambahkan entry baru di array 'sources' dengan format yang sama
 * - Sumber akan otomatis muncul di semua section yang merender referensi
 * 
 * Kategori yang tersedia:
 * - dataset    : Sumber data utama
 * - library    : Library/framework yang digunakan
 * - research   : Paper/jurnal ilmiah
 * - reference  : Referensi teknis dan dokumentasi
 * - tool       : Tool/API pendukung
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Data Sources & References
    |--------------------------------------------------------------------------
    */
    'sources' => [
        [
            'name'        => 'Dataset Menu Makanan Bergizi — Program MBG',
            'description' => 'Dataset utama berisi koleksi menu makanan bergizi yang dikurasi untuk Program Makan Bergizi Gratis (MBG) Indonesia. Mencakup informasi nutrisi, kategori, dan deskripsi lengkap setiap menu.',
            'url'         => null,
            'category'    => 'dataset',
            'status'      => 'active',
            'updated_at'  => '2025-06-01',
        ],
        [
            'name'        => 'Scikit-Learn: TfidfVectorizer Documentation',
            'description' => 'Dokumentasi resmi scikit-learn untuk implementasi TF-IDF Vectorizer. Menjadi referensi utama dalam menerapkan pembobotan term frequency–inverse document frequency pada sistem ini.',
            'url'         => 'https://scikit-learn.org/stable/modules/generated/sklearn.feature_extraction.text.TfidfVectorizer.html',
            'category'    => 'library',
            'status'      => 'active',
            'updated_at'  => '2025-05-15',
        ],
        [
            'name'        => 'Manning, Raghavan & Schütze — Introduction to Information Retrieval',
            'description' => 'Buku referensi standar bidang Information Retrieval dari Stanford University. Mencakup teori TF-IDF, Vector Space Model, Cosine Similarity, dan evaluasi sistem IR.',
            'url'         => 'https://nlp.stanford.edu/IR-book/information-retrieval-book.html',
            'category'    => 'research',
            'status'      => 'active',
            'updated_at'  => '2008-07-01',
        ],
        [
            'name'        => 'Sastrawi — Stemmer Bahasa Indonesia',
            'description' => 'Library stemming untuk Bahasa Indonesia berbasis algoritma Nazief-Adriani. Digunakan dalam tahap preprocessing untuk mengubah kata berimbuhan menjadi kata dasar.',
            'url'         => 'https://github.com/sastrawi/sastrawi',
            'category'    => 'library',
            'status'      => 'active',
            'updated_at'  => '2024-01-10',
        ],
        [
            'name'        => 'Laravel Framework Documentation',
            'description' => 'Dokumentasi resmi Laravel Framework yang menjadi fondasi arsitektur aplikasi web ini, termasuk routing, Eloquent ORM, Blade templating, dan Artisan CLI.',
            'url'         => 'https://laravel.com/docs',
            'category'    => 'reference',
            'status'      => 'active',
            'updated_at'  => '2025-06-01',
        ],
        [
            'name'        => 'Salton, Wong & Yang — A Vector Space Model for Automatic Indexing',
            'description' => 'Paper seminal yang memperkenalkan Vector Space Model (VSM) sebagai pendekatan matematis dalam information retrieval. Menjadi dasar teori Cosine Similarity yang digunakan sistem ini.',
            'url'         => 'https://doi.org/10.1145/361219.361220',
            'category'    => 'research',
            'status'      => 'active',
            'updated_at'  => '1975-11-01',
        ],
        [
            'name'        => 'Tala, F.Z. — A Study of Stemming Effects on Information Retrieval in Bahasa Indonesia',
            'description' => 'Penelitian yang menganalisis dampak stemming terhadap kinerja information retrieval dalam Bahasa Indonesia. Menjadi landasan pemilihan metode preprocessing teks.',
            'url'         => null,
            'category'    => 'research',
            'status'      => 'active',
            'updated_at'  => '2003-01-01',
        ],
        [
            'name'        => 'Program Makan Bergizi Gratis — Pemerintah RI',
            'description' => 'Program nasional penyediaan makanan bergizi gratis untuk anak sekolah dan ibu hamil/menyusui, diselenggarakan oleh Badan Gizi Nasional Republik Indonesia.',
            'url'         => 'https://www.badangizi.go.id',
            'category'    => 'reference',
            'status'      => 'active',
            'updated_at'  => '2025-06-01',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Teknologi yang Digunakan (Powered By)
    |--------------------------------------------------------------------------
    */
    'technologies' => [
        [
            'name'        => 'TF-IDF Retrieval Engine',
            'description' => 'Term Frequency–Inverse Document Frequency untuk pembobotan kata.',
        ],
        [
            'name'        => 'Cosine Similarity Ranking',
            'description' => 'Pengukuran kemiripan vektor untuk perankingan hasil pencarian.',
        ],
        [
            'name'        => 'Sastrawi Stemmer',
            'description' => 'Stemming Bahasa Indonesia berbasis algoritma Nazief-Adriani.',
        ],
        [
            'name'        => 'Information Retrieval System',
            'description' => 'Sistem temu kembali informasi berbasis Vector Space Model.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Kategori Label
    |--------------------------------------------------------------------------
    */
    'category_labels' => [
        'dataset'   => 'Dataset',
        'library'   => 'Library',
        'research'  => 'Penelitian',
        'reference' => 'Referensi',
        'tool'      => 'Tool',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pipeline Stages
    |--------------------------------------------------------------------------
    */
    'pipeline' => [
        [
            'step'        => 1,
            'title'       => 'Dataset',
            'description' => 'Koleksi dokumen makanan bergizi dimuat ke dalam sistem dari database. Setiap dokumen berisi judul, deskripsi, kategori, dan informasi nutrisi.',
        ],
        [
            'step'        => 2,
            'title'       => 'Preprocessing',
            'description' => 'Teks diubah ke huruf kecil (case folding), dipecah menjadi token (tokenization), dibersihkan dari stopword, dan di-stem menggunakan Sastrawi.',
        ],
        [
            'step'        => 3,
            'title'       => 'Indexing',
            'description' => 'Setiap term dihitung frekuensinya (TF) dan bobot inversnya (IDF). Hasilnya disimpan sebagai matriks TF-IDF dalam file pickle untuk akses cepat.',
        ],
        [
            'step'        => 4,
            'title'       => 'Retrieval',
            'description' => 'Query pengguna diproses dengan pipeline yang sama, lalu diubah menjadi vektor TF-IDF untuk dibandingkan dengan seluruh vektor dokumen.',
        ],
        [
            'step'        => 5,
            'title'       => 'Ranking',
            'description' => 'Cosine Similarity menghitung sudut antara vektor query dan setiap vektor dokumen. Dokumen diurutkan berdasarkan skor kemiripan tertinggi.',
        ],
        [
            'step'        => 6,
            'title'       => 'Result',
            'description' => 'Dokumen paling relevan ditampilkan lengkap dengan skor kemiripan, highlight kata kunci, dan informasi detail yang dapat dieksplorasi pengguna.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Panduan Penggunaan
    |--------------------------------------------------------------------------
    */
    'usage_steps' => [
        [
            'number' => '01',
            'title'  => 'Masukkan Kata Kunci',
            'description' => 'Ketik topik atau kata kunci makanan bergizi yang ingin Anda cari pada kotak pencarian. Gunakan kata kunci spesifik untuk hasil yang lebih presisi.',
        ],
        [
            'number' => '02',
            'title'  => 'Pilih Filter Kategori',
            'description' => 'Gunakan filter kategori yang tersedia untuk mempersempit hasil pencarian berdasarkan jenis menu seperti tinggi protein, rendah gula, atau vegetarian.',
        ],
        [
            'number' => '03',
            'title'  => 'Jalankan Pencarian',
            'description' => 'Klik tombol "Cari" untuk memproses query Anda. Sistem akan mencocokkan kata kunci dengan seluruh dokumen menggunakan algoritma TF-IDF dan Cosine Similarity.',
        ],
        [
            'number' => '04',
            'title'  => 'Analisis Hasil',
            'description' => 'Telusuri hasil pencarian yang diurutkan berdasarkan skor relevansi. Klik dokumen untuk melihat informasi nutrisi lengkap dan detail menu makanan.',
        ],
    ],

];
