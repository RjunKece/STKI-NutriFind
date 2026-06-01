# STKI MBG — Sistem Temu Kembali Informasi Menu Makanan Bergizi

> Sistem web-based Information Retrieval untuk Program Makan Bergizi Gratis (MBG)

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4-38bdf8?logo=tailwindcss)

## 📌 Deskripsi

STKI MBG adalah sistem pencarian cerdas yang mengimplementasikan konsep **Information Retrieval (Temu Kembali Informasi)** secara akademik dan implementatif. Sistem ini memungkinkan pengguna mencari menu makanan bergizi menggunakan kata kunci, kemudian menampilkan hasil yang diranking berdasarkan relevansi menggunakan **TF-IDF** dan **Cosine Similarity**.

## 🎯 Fitur Utama

### 1. Search Engine (Mesin Pencarian)
- Input query pencarian natural language
- Preprocessing otomatis: Case Folding → Tokenization → Stopword Removal → Stemming
- Indexing TF-IDF manual (tanpa library search engine)
- Ranking menggunakan Cosine Similarity
- Keyword highlighting pada hasil pencarian
- Filter kategori makanan
- Spell correction sederhana (Levenshtein Distance)

### 2. Dataset Makanan
- 109 data makanan bergizi Indonesia
- 6 kategori: tinggi protein, rendah gula, murah bergizi, vegetarian, anak sekolah, tinggi serat
- Deskripsi lengkap 50-100+ kata per dokumen
- Informasi nutrisi (Kalori, Protein, Lemak, Karbohidrat, Serat)

### 3. Evaluasi IR
- Precision@K (K = 5, 10, 15, 20)
- Mean Average Precision (MAP)
- 15 query evaluasi pengujian
- Detail per-query: precision di setiap rank, dokumen relevan vs retrieved

### 4. Bonus Fitur
- ✅ Highlight keyword hasil pencarian
- ✅ Spell correction sederhana (Levenshtein)
- ✅ Filter kategori makanan
- ✅ Riwayat pencarian
- ✅ Statistik query terpopuler

## 🏗️ Arsitektur

```
app/
├── Services/
│   ├── PreprocessingService.php    # Case folding, tokenization, stopword removal, stemming
│   ├── TfidfService.php            # Term frequency, IDF, TF-IDF vector
│   ├── CosineSimilarityService.php # Cosine similarity calculation
│   └── SearchService.php           # Orchestrator: query → preprocess → index → rank
├── Http/Controllers/
│   ├── SearchController.php        # Landing page & search results
│   ├── FoodController.php          # Dataset list & detail
│   └── EvaluationController.php    # Evaluasi IR dashboard
└── Models/
    ├── Food.php
    ├── SearchLog.php
    ├── EvaluationQuery.php
    └── EvaluationResult.php
```

## 🔄 Alur Sistem

```
USER QUERY
    ↓
PREPROCESSING QUERY (case fold → tokenize → stopword → stem)
    ↓
PREPROCESSING DOKUMEN (semua 109 dokumen)
    ↓
BUILD TF-IDF INDEX (TF, DF, IDF, TF-IDF vectors)
    ↓
COSINE SIMILARITY (query vector vs document vectors)
    ↓
RANKING RELEVANSI (sort by score descending)
    ↓
RESULT PAGE (with highlighting, scores, preprocessing debug)
```

## 📦 Teknologi

| Komponen | Teknologi |
|----------|-----------|
| Backend | Laravel 12 (PHP 8.2+) |
| Database | MySQL |
| Frontend | Blade Template + Tailwind CSS v4 |
| Stemming | Sastrawi (PHP native Indonesian stemmer) |
| TF-IDF | Implementasi manual PHP |
| Cosine Similarity | Implementasi manual PHP |
| Build Tool | Vite |

## 🚀 Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js >= 18 & NPM
- MySQL

### Langkah Instalasi

```bash
# 1. Clone repository
git clone <repository-url>
cd "TKI PROJECT"

# 2. Install dependensi PHP
composer install

# 3. Install dependensi Node
npm install

# 4. Salin file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi database di .env
#    Sesuaikan dengan kredensial MySQL Anda:
#    DB_DATABASE=stki_mbg
#    DB_USERNAME=root
#    DB_PASSWORD=

# 7. Buat database MySQL
mysql -u root -e "CREATE DATABASE IF NOT EXISTS stki_mbg"

# 8. Jalankan migration & seeder
php artisan migrate --seed

# 9. Build assets (production)
npm run build

# 10. Jalankan server
php artisan serve
```

Buka browser di `http://localhost:8000`

### Development Mode

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server (hot reload)
npm run dev
```

## 📄 Halaman

| No | Halaman | URL | Deskripsi |
|----|---------|-----|-----------|
| 1 | Landing/Search | `/` | Halaman utama dengan search bar |
| 2 | Search Results | `/search?q=...` | Hasil pencarian dengan ranking |
| 3 | Food Detail | `/foods/{id}` | Detail dokumen makanan |
| 4 | Dataset List | `/foods` | Daftar seluruh dataset makanan |
| 5 | Evaluation | `/evaluation` | Dashboard evaluasi IR |

## 🧪 Pengujian

### Contoh Query Pencarian
- `tinggi protein` — Mencari makanan tinggi protein
- `murah bergizi` — Makanan ekonomis namun bergizi
- `menu anak sekolah` — Menu untuk anak sekolah
- `rendah gula` — Makanan rendah gula
- `vegetarian` — Menu vegetarian
- `tinggi serat` — Makanan tinggi serat

### Menjalankan Evaluasi
1. Buka halaman **Evaluasi** (`/evaluation`)
2. Pilih nilai K (5, 10, 15, atau 20)
3. Klik tombol **Jalankan Evaluasi**
4. Lihat hasil Precision@K dan MAP
5. Klik **Detail** pada setiap query untuk melihat breakdown per-rank

## 📊 Database

### Tabel
1. **foods** — Data makanan bergizi (109 records)
2. **search_logs** — Log pencarian pengguna
3. **evaluation_queries** — Query pengujian evaluasi (15 records)
4. **evaluation_results** — Hasil evaluasi per query

## 📝 Catatan Penting

- TF-IDF dan Cosine Similarity diimplementasikan **100% manual** tanpa library search engine
- Stemming menggunakan **Sastrawi** (library stemming Bahasa Indonesia)
- Query diperlakukan sebagai "dokumen tambahan" dalam vector space model
- Stopword list mencakup kata-kata umum Bahasa Indonesia + unit nutrisi (mg, gram, kkal)
- Sistem menampilkan detail preprocessing query (debug panel) pada halaman hasil pencarian

## 📜 Lisensi

MIT License
