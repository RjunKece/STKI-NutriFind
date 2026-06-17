# DOKUMENTASI SISTEM & SKPL
*(Spesifikasi Kebutuhan Perangkat Lunak)*

**Sistem Temu Kembali Informasi (STKI) Menu Makanan Bergizi**  
**Program Makan Bergizi Gratis (MBG)**

---

## 1. PENDAHULUAN

### 1.1 Tujuan Sistem
STKI MBG adalah sebuah mesin pencari (*search engine*) cerdas yang dibangun khusus untuk mencari dokumen/artikel tentang menu makanan bergizi untuk program MBG. Sistem ini bertujuan mengimplementasikan algoritma *Information Retrieval* (IR) dasar menggunakan metode **Vector Space Model (VSM)** dengan pembobotan **TF-IDF** dan pengukuran jarak/relevansi menggunakan **Cosine Similarity**.

### 1.2 Pengguna Sasaran (Aktor)
- **Pengguna Umum:** Dapat mencari makanan bergizi dengan memasukkan *query* (kata kunci) berupa bahasa natural (misal: "makanan tinggi protein untuk anak sekolah").
- **Admin/Peneliti (Tim Mahasiswa):** Dapat melihat statistik pencarian dan melakukan pengujian performa algoritma (Evaluasi) menggunakan metrik *Precision@K* dan *MAP*.

---

## 2. ARSITEKTUR & TEKNOLOGI

Sistem dibangun menggunakan **Clean Architecture** berbasis framework **Laravel 12 (PHP)** dengan pola desain **MVC (Model-View-Controller)**.

- **Frontend (View):** Blade Template + Tailwind CSS v4.
- **Backend (Controller & Service):** PHP 8.2+. Logika pencarian dipisahkan dari Controller ke dalam folder `app/Services/` agar rapi dan mudah di-maintain.
- **Database (Model):** MySQL (menyimpan dataset makanan, riwayat pencarian, dan query evaluasi).

**Struktur Direktori Utama (Logika IR):**
```text
app/Services/
 ├── PreprocessingService.php    -> Mengolah teks mentah
 ├── TfidfService.php            -> Menghitung bobot kata
 ├── CosineSimilarityService.php -> Menghitung skor kemiripan
 └── SearchService.php           -> Menyatukan semua proses (Orkestrator)
```

---

## 3. ALUR KERJA SISTEM (IR PIPELINE)

Pencarian dalam STKI MBG tidak menggunakan perintah `LIKE` pada database atau *library instant* seperti Elasticsearch. Pencarian dilakukan melalui tahapan matematis murni sebagai berikut:

### TAHAP 1: Input Query
Pengguna memasukkan kata kunci. Contoh: `"Tinggi Protein!"`

### TAHAP 2: Text Preprocessing
Baik query maupun dokumen (dataset) harus melewati tahap ini agar seragam:
1. **Case Folding:** Mengubah semua huruf menjadi kecil (`"Tinggi Protein!"` ➔ `"tinggi protein!"`)
2. **Tokenization:** Membuang tanda baca dan memecah kalimat menjadi array kata (`["tinggi", "protein"]`)
3. **Stopword Removal:** Membuang kata hubung/kata tidak penting seperti *dan, di, ke, yang*.
4. **Stemming (Sastrawi):** Mengembalikan kata berimbuhan ke kata dasar (misal: *memasak* ➔ *masak*).

### TAHAP 3: TF-IDF (Term Frequency - Inverse Document Frequency)
Sistem mengubah kumpulan teks (dokumen dan query) menjadi **vektor angka (matriks)**.
- **TF (Term Frequency):** Seberapa sering sebuah kata (term) muncul dalam satu dokumen. Semakin sering, semakin penting.
- **DF (Document Frequency):** Berapa banyak dokumen yang mengandung kata tersebut.
- **IDF (Inverse Document Frequency):** Logika kebalikan. Jika sebuah kata muncul di *semua* dokumen (misal kata "makanan"), maka kata itu dianggap *kurang unik/kurang penting*. Bobotnya dikecilkan.
- **TF-IDF:** Perkalian antara TF dan IDF. Menghasilkan skor bobot untuk setiap kata di setiap dokumen.

### TAHAP 4: Cosine Similarity
Setelah query dan dokumen berubah menjadi deretan angka (vektor), sistem mengukur sudut di antara vektor query dan vektor dokumen.
- Nilai Cosine berkisar antara **0** (tidak relevan sama sekali) hingga **1** (sangat relevan / identik).
- Rumusnya adalah perkalian titik (*dot product*) dari kedua vektor dibagi dengan perkalian panjang (*magnitude*) kedua vektor.

### TAHAP 5: Ranking
Dokumen dengan skor Cosine Similarity tertinggi (mendekati 1) akan ditempatkan di urutan paling atas (*Rank 1*), disusul skor di bawahnya, dan seterusnya.

---

## 4. PENJELASAN DATASET

- **Jumlah:** 109 dokumen (berupa menu makanan).
- **Format:** Terdiri dari Judul Makanan, Kategori, Kalori, dan Deskripsi lengkap (Bahan, manfaat gizi, protein). Rata-rata memuat 50 - 150 kata per dokumen.
- **Kategori:** Tinggi Protein, Rendah Gula, Murah Bergizi, Vegetarian, Anak Sekolah, Tinggi Serat.

---

## 5. MODUL EVALUASI SISTEM

Untuk membuktikan bahwa mesin pencari kita bekerja dengan baik secara akademik, kita membuat modul Evaluasi menggunakan *Ground Truth* (Kunci Jawaban).

1. **Ground Truth:** Kita menyiapkan 15 skenario pencarian uji coba. Di setiap pencarian, kita sudah menentukan (secara manual/pakar) ID dokumen mana saja yang *seharusnya* muncul (relevan).
2. **Precision@K:** Metrik untuk mengukur: *"Dari K (misal 10) dokumen teratas yang dikembalikan sistem, berapa persentase dokumen yang benar-benar relevan?"*
   *Contoh:* Jika K=10, dan ada 8 dokumen relevan di dalamnya, maka Precision@10 = 0.8 (80%).
3. **MAP (Mean Average Precision):** Mengukur ketepatan urutan ranking secara keseluruhan dari seluruh query pengujian. Semakin dokumen relevan berada di urutan atas, nilai MAP semakin mendekati 1.

---

## 6. FITUR TAMBAHAN (BONUS)

Sebagai nilai tambah dalam proyek STKI ini, sistem juga memiliki:
1. **Keyword Highlighting:** Kata dalam hasil pencarian yang cocok dengan query akan di-stabilo (diberi warna *background* kuning).
2. **Spelling Correction Sederhana:** Menggunakan algoritma *Levenshtein Distance*. Jika pengguna salah ketik dan sistem mendeteksi hasil pencarian kosong, sistem akan menyarankan kata yang paling mirip berdasarkan *history* pencarian orang lain.
3. **Search Analytics:** Merekam semua query yang dicari untuk menampilkan statistik "Pencarian Terpopuler".

---

## 7. TIPS PRESENTASI KELOMPOK

Saat mempresentasikan sistem ini di depan dosen, tekankan poin-poin berikut:
1. **Pengerjaan Manual:** *"Kami tidak menggunakan klausa SQL LIKE atau Elasticsearch. Sistem kami membangun indeks (TF-IDF) dan menghitung sudut vektor (Cosine Similarity) murni menggunakan kode PHP secara native."*
2. **Preprocessing yang Lengkap:** Tunjukkan tabel *debug preprocessing* di halaman hasil pencarian, yang membuktikan teks benar-benar di-tokenize dan di-stem (menggunakan Sastrawi).
3. **Fokus ke Evaluasi:** *"Sistem kami tidak hanya bisa mencari, tapi kami juga dapat membuktikan akurasinya secara kuantitatif melalui modul Evaluasi (MAP dan Precision)."*

---
*Dibuat untuk melengkapi Ujian Akhir Semester STKI.*
