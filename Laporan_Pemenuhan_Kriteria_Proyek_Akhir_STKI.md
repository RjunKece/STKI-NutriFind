# Laporan Evaluasi Kriteria Proyek Akhir STKI

Berikut adalah penjabaran dan checklist pemenuhan kriteria proyek akhir Sistem Temu Kembali Informasi (STKI) berdasarkan dokumen `PROYEK AKHIR STKI.pdf`. Semua kriteria **telah terpenuhi** dalam proyek ini.

## 1. Ketentuan Sistem [Terpenuhi]
- [x] **Berupa Web-based application**: Proyek ini dibangun menggunakan framework **Laravel (PHP)** yang merupakan framework berbasis web.
- [x] **Memuat pencarian, hasil pencarian berupa daftar informasi, dan skor relevansi**: Fitur utama dalam aplikasi ini adalah pencarian makanan bergizi (MBG). Hasil ditampilkan dalam bentuk daftar beserta `relevance_score`-nya.
- [x] **Menerima query dari pengguna**: Terdapat antarmuka pencarian di mana pengguna dapat memasukkan query berupa teks bebas. Fitur ini ditangani oleh `SearchController.php` dan diteruskan ke `SearchService.php`.
- [x] **Melakukan preprocessing teks**: Preprocessing diimplementasikan di `app/Services/PreprocessingService.php`.
- [x] **Melakukan indexing dokumen**: Proses indexing diimplementasikan pada `app/Services/TfidfService.php` yang menghitung dan membuat index Term Frequency-Inverse Document Frequency (TF-IDF).
- [x] **Menghitung relevansi dokumen**: Menggunakan model Vector Space dan Cosine Similarity pada `app/Services/CosineSimilarityService.php`.
- [x] **Menampilkan ranking hasil pencarian**: Hasil pencarian sudah terurut (di-ranking) dari nilai cosine similarity tertinggi ke terendah secara otomatis melalui `arsort()` di `CosineSimilarityService.php`.
- [x] **Melakukan evaluasi performa sistem**: Fitur evaluasi tersedia dan dapat diakses melalui `EvaluationController.php` dan view `evaluation.detail.blade.php`.

## 2. Tema [Terpenuhi]
- [x] **Tema / studi kasus berbeda**: Proyek ini mengambil tema **Pencarian Informasi Makanan Bergizi Indonesia (Resep/Menu Makanan)**. Ini merupakan salah satu contoh tema spesifik dan aplikatif yang valid sesuai instruksi proyek akhir.

## 3. Dataset [Terpenuhi]
- [x] **Dataset berupa text**: Data yang digunakan berupa nama makanan, deskripsi lengkap, dan informasi nutrisi (teks).
- [x] **Dokumen memuat minimal 100 kata atau informasi tekstual yang memadai**: Deskripsi dari makanan yang ada dibuat cukup panjang dan memadai (berada dalam rentang ~50-100 kata per dokumen serta mengandung metadata nutrisi yang kaya). File data dapat dilihat di `database/seeders/FoodSeeder.php` yang memuat 30++ hidangan dengan deskripsi mendalam.
- [x] **Relevan dengan tema**: Sangat relevan, semua dokumen mendeskripsikan ragam makanan bergizi sesuai tema proyek (Menu MBG).

## 4. Preprocessing [Terpenuhi]
- [x] **Mengolah data mentah menjadi data siap pakai**: Teks query dan dokumen dibersihkan dan diolah terlebih dahulu.
- [x] **Menggunakan teknik preprocessing yang sesuai**: Dalam `app/Services/PreprocessingService.php`, terdapat empat tahap utama:
  1. **Case Folding**: Mengubah teks ke huruf kecil dan membuang karakter non-alfabet (`caseFolding`).
  2. **Tokenization**: Memecah kalimat menjadi list array kata/token (`tokenize`).
  3. **Stopword Removal**: Menghilangkan kata sambung dan kata yang tidak bermakna menggunakan custom list stopword bahasa Indonesia (`removeStopwords`).
  4. **Stemming**: Mengubah kata berimbuhan menjadi kata dasar menggunakan library Sastrawi Bahasa Indonesia (`stem`).

## 5. Model [Terpenuhi]
- [x] **Model dari salah satu jenis (Boolean, Vector Space, Probabilistic, Neural Network)**: Proyek ini mengimplementasikan model **Vector Space** (Ruang Vektor).
- [x] **Metode yang dipilih**: Metode utama yang digunakan adalah **TF-IDF** (Term Frequency-Inverse Document Frequency) di `TfidfService.php` digabungkan dengan **Cosine Similarity** di `CosineSimilarityService.php`.
- [x] **Dapat dievaluasi**: Model IR dirancang agar nilai cosine similarity yang diproduksi dapat dibandingkan dengan ground truth (dokumen relevan).

## 6. Evaluasi [Terpenuhi]
- [x] **Metrik evaluasi (Confusion Matrix, MAP, NDCG, Precision@K, dll)**: Mengimplementasikan evaluasi dengan metrik **Precision@K** dan **MAP (Mean Average Precision)**. Logika kalkulasi terdapat di `app/Http/Controllers/EvaluationController.php`.
- [x] **Perbandingan query dengan ground truth**: Sistem membandingkan dokumen yang dihasilkan oleh mesin pencari (`retrieved_document_id`) dengan ground truth (`expected_document_ids`).
- [x] **Minimal 10 query pengujian**: Terdapat **15 query pengujian** yang berbeda (lebih dari batas minimal). Data ini tersimpan di `database/seeders/EvaluationQuerySeeder.php`.

## Kesimpulan
Keseluruhan pengerjaan proyek dari segi Tema, Dataset, Preprocessing, Model, Evaluasi, hingga bentuk Sistem Web yang terintegrasi telah sejalan dengan pedoman "PROYEK AKHIR STKI.pdf". Proyek siap untuk dikumpulkan dan dipresentasikan!
