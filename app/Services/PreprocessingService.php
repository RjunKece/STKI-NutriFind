<?php

namespace App\Services;

use Sastrawi\Stemmer\StemmerFactory;

/**
 * PreprocessingService
 * 
 * Service untuk melakukan preprocessing teks dalam bahasa Indonesia.
 * Tahapan preprocessing:
 * 1. Case Folding - mengubah semua huruf menjadi lowercase
 * 2. Tokenization - memecah teks menjadi token/kata
 * 3. Stopword Removal - menghapus kata-kata umum yang tidak bermakna
 * 4. Stemming - mengubah kata ke bentuk dasar menggunakan Sastrawi
 */
class PreprocessingService
{
    private $stemmer;
    private array $stopwords;

    public function __construct()
    {
        // Inisialisasi Sastrawi Stemmer untuk stemming bahasa Indonesia
        $factory = new StemmerFactory();
        $this->stemmer = $factory->createStemmer();

        // Daftar stopword bahasa Indonesia yang komprehensif
        $this->stopwords = [
            'yang', 'dan', 'di', 'dari', 'ini', 'itu', 'untuk', 'dengan',
            'pada', 'adalah', 'ke', 'dalam', 'tidak', 'akan', 'juga', 'ada',
            'atau', 'mereka', 'sudah', 'saya', 'kami', 'kita', 'bisa', 'oleh',
            'dapat', 'serta', 'bagi', 'telah', 'hanya', 'lebih', 'sangat',
            'seperti', 'agar', 'bahwa', 'karena', 'sebagai', 'jika', 'maka',
            'bila', 'namun', 'tetapi', 'lagi', 'pun', 'hingga', 'sampai',
            'secara', 'antara', 'tanpa', 'begitu', 'tentang', 'maupun',
            'masih', 'melalui', 'sebelum', 'sesudah', 'selama', 'apabila',
            'ketika', 'saat', 'yaitu', 'yakni', 'sehingga', 'terhadap',
            'sedangkan', 'lalu', 'kemudian', 'atas', 'bawah', 'kembali',
            'selain', 'saja', 'pula', 'harus', 'boleh', 'setiap', 'semua',
            'beberapa', 'banyak', 'sedikit', 'tersebut', 'belum', 'anda',
            'ia', 'dia', 'kami', 'mu', 'nya', 'si', 'se', 'per', 'para',
            'hal', 'cara', 'apa', 'siapa', 'kapan', 'dimana', 'bagaimana',
            'mengapa', 'kenapa', 'berapa', 'mana', 'suatu', 'sesuatu',
            'tiap', 'sebuah', 'seorang', 'orang', 'dua', 'tiga', 'empat',
            'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh',
            'satu', 'ser', 'the', 'a', 'an', 'of', 'to', 'in', 'is', 'it',
            'was', 'for', 'on', 'are', 'as', 'with', 'his', 'they', 'be',
            'at', 'one', 'have', 'this', 'from', 'or', 'had', 'by', 'but',
            'some', 'what', 'there', 'we', 'can', 'all', 'were', 'her',
            'would', 'about', 'been', 'if', 'will', 'no', 'she', 'do',
            'their', 'so', 'how', 'him', 'that', 'its', 'than', 'amp',
            'mg', 'gr', 'gram', 'kkal', 'kalori', 'ml', 'liter',
            'bukan', 'lain', 'menjadi', 'merupakan', 'memiliki',
            'terdiri', 'terdapat', 'paling', 'sangatlah',
        ];
    }

    /**
     * Proses lengkap preprocessing teks
     * Mengembalikan array token yang sudah diproses
     */
    public function process(string $text): array
    {
        $text = $this->caseFolding($text);
        $tokens = $this->tokenize($text);
        $tokens = $this->removeStopwords($tokens);
        $tokens = $this->stem($tokens);

        // Filter token kosong setelah semua proses
        return array_values(array_filter($tokens, fn($t) => strlen($t) > 1));
    }

    /**
     * Proses preprocessing dengan detail untuk halaman debug
     * Mengembalikan array berisi hasil tiap tahap preprocessing
     */
    public function processWithDetails(string $text): array
    {
        $original = $text;

        // Tahap 1: Case Folding
        $caseFolded = $this->caseFolding($text);

        // Tahap 2: Tokenization
        $tokens = $this->tokenize($caseFolded);

        // Tahap 3: Stopword Removal
        $afterStopword = $this->removeStopwords($tokens);

        // Tahap 4: Stemming
        $stemmed = $this->stem($afterStopword);

        // Filter token kosong
        $final = array_values(array_filter($stemmed, fn($t) => strlen($t) > 1));

        return [
            'original' => $original,
            'case_folded' => $caseFolded,
            'tokens' => $tokens,
            'tokens_count' => count($tokens),
            'after_stopword' => $afterStopword,
            'stopwords_removed' => count($tokens) - count($afterStopword),
            'stemmed' => $stemmed,
            'final_tokens' => $final,
            'final_count' => count($final),
        ];
    }

    /**
     * Tahap 1: Case Folding
     * Mengubah semua karakter menjadi lowercase dan menghapus karakter non-alfabet
     */
    public function caseFolding(string $text): string
    {
        // Ubah ke lowercase
        $text = mb_strtolower($text, 'UTF-8');

        // Hapus angka dan karakter khusus, sisakan huruf dan spasi
        $text = preg_replace('/[^a-z\s]/', ' ', $text);

        // Hapus spasi berlebihan
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }

    /**
     * Tahap 2: Tokenization
     * Memecah teks menjadi array kata/token
     */
    public function tokenize(string $text): array
    {
        return array_values(array_filter(explode(' ', $text), fn($t) => strlen($t) > 0));
    }

    /**
     * Tahap 3: Stopword Removal
     * Menghapus kata-kata umum yang tidak bermakna dari array token
     */
    public function removeStopwords(array $tokens): array
    {
        return array_values(array_filter($tokens, fn($token) => !in_array($token, $this->stopwords)));
    }

    /**
     * Tahap 4: Stemming
     * Mengubah setiap token ke bentuk dasar menggunakan Sastrawi
     */
    public function stem(array $tokens): array
    {
        return array_map(fn($token) => $this->stemmer->stem($token), $tokens);
    }

    /**
     * Mendapatkan daftar stopwords
     */
    public function getStopwords(): array
    {
        return $this->stopwords;
    }
}
