<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

/**
 * FoodSeeder
 * 
 * Seeder untuk mengisi database dengan 100+ data makanan bergizi Indonesia
 * yang menjadi dataset utama untuk sistem temu kembali informasi MBG.
 * 
 * Setiap makanan memiliki:
 * - title: nama makanan
 * - category: kategori nutrisi (tinggi protein, rendah gula, murah bergizi, vegetarian, anak sekolah, tinggi serat)
 * - description: deskripsi lengkap 50-100 kata
 * - nutrition_info: informasi nutrisi detail
 */
class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = $this->getFoodData();

        foreach ($foods as $food) {
            Food::create($food);
        }
    }

    private function getFoodData(): array
    {
        return [
            // ============================
            // KATEGORI: TINGGI PROTEIN
            // ============================
            [
                'title' => 'Nasi Tempe Telur',
                'category' => 'tinggi protein',
                'description' => 'Nasi tempe telur merupakan menu makanan bergizi tinggi protein yang sangat populer di Indonesia. Tempe yang terbuat dari kedelai difermentasi mengandung protein nabati berkualitas tinggi, sementara telur menyediakan protein hewani lengkap dengan asam amino esensial. Kombinasi nasi sebagai sumber karbohidrat kompleks dengan tempe dan telur menjadikan menu ini sangat cocok untuk program Makan Bergizi Gratis karena harganya terjangkau namun nilai gizinya tinggi. Menu ini mudah diolah dan disukai berbagai kalangan usia.',
                'nutrition_info' => 'Kalori: 450 kkal | Protein: 25g | Karbohidrat: 55g | Lemak: 12g | Serat: 4g | Kalsium: 120mg | Zat Besi: 3.5mg',
            ],
            [
                'title' => 'Ayam Panggang Bumbu Kuning',
                'category' => 'tinggi protein',
                'description' => 'Ayam panggang bumbu kuning adalah menu kaya protein hewani yang dimasak dengan bumbu kunyit, lengkuas, dan rempah-rempah tradisional Indonesia. Daging ayam merupakan sumber protein hewani berkualitas tinggi yang mudah dicerna tubuh. Bumbu kuning yang mengandung kunyit memberikan manfaat antiinflamasi tambahan. Menu ini cocok untuk anak-anak dan dewasa sebagai lauk utama dalam program MBG. Proses pemanggangan membuat kandungan lemak lebih rendah dibanding digoreng.',
                'nutrition_info' => 'Kalori: 380 kkal | Protein: 35g | Karbohidrat: 5g | Lemak: 18g | Serat: 1g | Kalsium: 30mg | Zat Besi: 2.8mg | Vitamin B12: 0.6mcg',
            ],
            [
                'title' => 'Pepes Ikan Kembung',
                'category' => 'tinggi protein',
                'description' => 'Pepes ikan kembung adalah masakan tradisional Indonesia yang dibungkus daun pisang dan dikukus. Ikan kembung kaya akan protein dan asam lemak omega-3 yang penting untuk perkembangan otak anak. Dibumbui dengan kemangi, cabai, dan bumbu rempah yang meningkatkan citarasa. Metode pepes menjaga nutrisi ikan tetap utuh karena dimasak dengan uap. Menu ini sangat cocok untuk program MBG karena ikan kembung termasuk ikan laut yang harganya terjangkau dan mudah didapat di pasar tradisional.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 30g | Karbohidrat: 3g | Lemak: 15g | Omega-3: 1.2g | Serat: 1g | Kalsium: 50mg | Zat Besi: 2mg',
            ],
            [
                'title' => 'Telur Balado',
                'category' => 'tinggi protein',
                'description' => 'Telur balado adalah menu sederhana namun bergizi tinggi yang sangat populer di seluruh Indonesia. Telur rebus yang digoreng setengah matang kemudian disiram sambal balado pedas manis dari cabai merah, bawang merah, dan tomat. Telur merupakan sumber protein hewani yang lengkap mengandung semua asam amino esensial. Menu ini sangat ekonomis dan praktis untuk disajikan dalam jumlah besar pada program Makan Bergizi Gratis. Cocok sebagai lauk pendamping nasi dengan sayuran.',
                'nutrition_info' => 'Kalori: 320 kkal | Protein: 18g | Karbohidrat: 8g | Lemak: 22g | Serat: 2g | Kalsium: 80mg | Zat Besi: 3mg | Vitamin A: 540 IU',
            ],
            [
                'title' => 'Sate Ayam Bumbu Kacang',
                'category' => 'tinggi protein',
                'description' => 'Sate ayam bumbu kacang merupakan kuliner khas Indonesia yang kaya protein ganda dari daging ayam dan bumbu kacang tanah. Daging ayam dipotong kecil dan ditusuk pada bambu kemudian dipanggang di atas bara api. Bumbu kacang yang terbuat dari kacang tanah goreng, kecap manis, dan cabai memberikan tambahan protein nabati. Menu ini disukai anak-anak dan remaja sehingga sangat cocok untuk program MBG di sekolah-sekolah.',
                'nutrition_info' => 'Kalori: 420 kkal | Protein: 32g | Karbohidrat: 15g | Lemak: 25g | Serat: 3g | Kalsium: 45mg | Zat Besi: 3mg',
            ],
            [
                'title' => 'Tahu Isi Sayuran',
                'category' => 'tinggi protein',
                'description' => 'Tahu isi sayuran adalah menu vegetarian tinggi protein yang terbuat dari tahu putih yang diisi dengan campuran wortel, tauge, dan daun bawang. Tahu merupakan sumber protein nabati dari kedelai yang sangat baik untuk pertumbuhan. Kombinasi dengan sayuran memberikan vitamin dan mineral tambahan. Menu ini mudah dibuat dalam jumlah besar dan sangat ekonomis untuk program MBG. Tahu dapat diolah dengan cara dikukus atau digoreng ringan.',
                'nutrition_info' => 'Kalori: 250 kkal | Protein: 18g | Karbohidrat: 12g | Lemak: 14g | Serat: 3g | Kalsium: 200mg | Zat Besi: 4mg | Vitamin C: 15mg',
            ],
            [
                'title' => 'Sup Ikan Nila Kuah Bening',
                'category' => 'tinggi protein',
                'description' => 'Sup ikan nila kuah bening adalah hidangan sehat kaya protein yang menggunakan ikan nila air tawar segar. Ikan nila dimasak dalam kuah bening dengan tomat, seledri, daun bawang, dan sedikit jahe untuk menghilangkan bau amis. Ikan nila mudah dibudidayakan dan harganya sangat terjangkau menjadikannya ideal untuk program MBG. Kuah bening yang hangat membantu penyerapan nutrisi dan sangat cocok disajikan sebagai menu makan siang bergizi di sekolah.',
                'nutrition_info' => 'Kalori: 220 kkal | Protein: 28g | Karbohidrat: 5g | Lemak: 8g | Serat: 1g | Kalsium: 60mg | Zat Besi: 1.5mg | Vitamin D: 3mcg',
            ],
            [
                'title' => 'Rendang Daging Sapi',
                'category' => 'tinggi protein',
                'description' => 'Rendang daging sapi merupakan masakan khas Minangkabau yang diakui UNESCO sebagai warisan budaya kuliner. Daging sapi dimasak lama dalam santan dan rempah-rempah hingga bumbu meresap sempurna. Rendang kaya protein hewani berkualitas tinggi dan zat besi heme yang mudah diserap tubuh. Meskipun memerlukan waktu memasak lama, rendang dapat disimpan beberapa hari tanpa basi. Menu premium ini cocok untuk menu spesial program MBG.',
                'nutrition_info' => 'Kalori: 480 kkal | Protein: 38g | Karbohidrat: 6g | Lemak: 32g | Serat: 2g | Kalsium: 25mg | Zat Besi: 5mg | Vitamin B12: 2.5mcg',
            ],
            [
                'title' => 'Bakso Ikan Tenggiri',
                'category' => 'tinggi protein',
                'description' => 'Bakso ikan tenggiri adalah makanan olahan ikan yang populer dan kaya protein. Daging ikan tenggiri yang dihaluskan dicampur dengan tepung tapioka dan bumbu halus kemudian dibentuk bulat dan direbus. Ikan tenggiri memiliki tekstur daging yang padat dan rasa yang gurih. Bakso ikan dapat disajikan dengan kuah kaldu, mie, atau sebagai lauk dengan nasi. Menu ini praktis untuk program MBG karena dapat diproduksi dalam jumlah besar.',
                'nutrition_info' => 'Kalori: 300 kkal | Protein: 24g | Karbohidrat: 18g | Lemak: 12g | Serat: 1g | Kalsium: 40mg | Zat Besi: 2mg | Omega-3: 0.8g',
            ],
            [
                'title' => 'Perkedel Tahu Udang',
                'category' => 'tinggi protein',
                'description' => 'Perkedel tahu udang menggabungkan protein nabati dari tahu dengan protein hewani dari udang dalam satu hidangan. Tahu yang dihaluskan dicampur dengan udang cincang halus, telur, dan bumbu aromatis kemudian dibentuk dan digoreng hingga kecokelatan. Menu ini menyediakan asam amino lengkap dari kombinasi dua sumber protein. Sangat disukai anak-anak karena teksturnya yang lembut dan rasa gurihnya. Ideal untuk menu MBG yang ekonomis dan bernutrisi.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 20g | Karbohidrat: 10g | Lemak: 16g | Serat: 2g | Kalsium: 150mg | Zat Besi: 3mg | Selenium: 25mcg',
            ],

            // ============================
            // KATEGORI: RENDAH GULA
            // ============================
            [
                'title' => 'Salad Sayuran Segar',
                'category' => 'rendah gula',
                'description' => 'Salad sayuran segar adalah menu sehat rendah gula yang terdiri dari campuran selada, mentimun, tomat, wortel parut, dan tauge segar. Dressing menggunakan perasan jeruk nipis dan sedikit minyak zaitun tanpa tambahan gula. Sayuran mentah mempertahankan kandungan vitamin dan mineral secara maksimal. Menu ini sangat cocok untuk program MBG sebagai pendamping makanan utama karena kaya serat dan rendah kalori. Dapat divariasikan dengan berbagai jenis sayuran musiman.',
                'nutrition_info' => 'Kalori: 80 kkal | Protein: 3g | Karbohidrat: 10g | Gula: 4g | Lemak: 3g | Serat: 4g | Vitamin C: 45mg | Vitamin A: 3000 IU',
            ],
            [
                'title' => 'Tumis Kangkung Bawang Putih',
                'category' => 'rendah gula',
                'description' => 'Tumis kangkung bawang putih merupakan sayuran hijau yang dimasak cepat dengan api besar bersama irisan bawang putih dan sedikit garam. Kangkung termasuk sayuran hijau gelap yang kaya zat besi, kalsium, dan vitamin A. Proses tumis yang cepat menjaga tekstur renyah dan kandungan nutrisi tetap terjaga. Menu ini sangat ekonomis dan mudah didapat di seluruh Indonesia. Kangkung tidak mengandung gula tambahan sehingga aman untuk berbagai kondisi kesehatan.',
                'nutrition_info' => 'Kalori: 90 kkal | Protein: 4g | Karbohidrat: 6g | Gula: 1g | Lemak: 5g | Serat: 3g | Kalsium: 120mg | Zat Besi: 3.5mg | Vitamin A: 4500 IU',
            ],
            [
                'title' => 'Sup Brokoli Kembang Kol',
                'category' => 'rendah gula',
                'description' => 'Sup brokoli kembang kol adalah hidangan hangat rendah gula yang menggabungkan dua jenis sayuran cruciferous yang sangat bernutrisi. Brokoli dan kembang kol direbus dalam kaldu ayam ringan dengan wortel dan seledri. Sayuran cruciferous mengandung senyawa antioksidan yang baik untuk kesehatan. Menu sup ini rendah kalori dan gula namun mengenyangkan karena tinggi serat. Sangat cocok untuk menu program MBG yang memprioritaskan kesehatan.',
                'nutrition_info' => 'Kalori: 120 kkal | Protein: 6g | Karbohidrat: 14g | Gula: 3g | Lemak: 4g | Serat: 5g | Vitamin C: 80mg | Vitamin K: 110mcg',
            ],
            [
                'title' => 'Capcay Sayuran Campur',
                'category' => 'rendah gula',
                'description' => 'Capcay sayuran campur adalah tumisan beragam sayuran segar yang dimasak dengan saus tiram ringan. Terdiri dari wortel, buncis, sawi putih, jamur kuping, jagung muda, dan bakso ikan. Menu ini menyediakan berbagai vitamin dan mineral dari aneka sayuran dalam satu hidangan. Kadar gula sangat rendah karena tidak menggunakan gula tambahan dalam pemasakannya. Capcay merupakan menu yang populer dan mudah diterima selera anak-anak maupun dewasa.',
                'nutrition_info' => 'Kalori: 150 kkal | Protein: 8g | Karbohidrat: 16g | Gula: 5g | Lemak: 6g | Serat: 4g | Vitamin A: 3500 IU | Vitamin C: 35mg',
            ],
            [
                'title' => 'Ikan Panggang Sambal Matah',
                'category' => 'rendah gula',
                'description' => 'Ikan panggang sambal matah adalah hidangan rendah gula dari Bali yang menggunakan ikan segar dipanggang sempurna dan disajikan dengan sambal matah mentah. Sambal matah terdiri dari irisan bawang merah, cabai rawit, serai, dan jeruk limau yang segar tanpa gula. Ikan panggang mempertahankan nutrisi lebih baik dibanding digoreng dan mengandung lemak yang lebih sedikit. Menu ini kaya protein dan omega-3 tanpa tambahan gula.',
                'nutrition_info' => 'Kalori: 250 kkal | Protein: 30g | Karbohidrat: 4g | Gula: 1g | Lemak: 12g | Serat: 1g | Omega-3: 1.5g | Vitamin D: 5mcg',
            ],
            [
                'title' => 'Lalapan Sayur Mentah',
                'category' => 'rendah gula',
                'description' => 'Lalapan sayur mentah adalah tradisi makan sayuran segar tanpa dimasak yang umum dalam kuliner Sunda dan Jawa. Terdiri dari kol, mentimun, kemangi, selada, dan terong bulat mentah yang disajikan dengan sambal terasi. Sayuran mentah mengandung enzim aktif dan vitamin yang tidak rusak oleh pemanasan. Menu ini sangat rendah gula dan kalori namun tinggi serat sehingga baik untuk pencernaan. Sangat ekonomis dan mudah disiapkan untuk program MBG.',
                'nutrition_info' => 'Kalori: 60 kkal | Protein: 2g | Karbohidrat: 8g | Gula: 3g | Lemak: 1g | Serat: 4g | Vitamin C: 30mg | Folat: 60mcg',
            ],
            [
                'title' => 'Pecel Sayur Tanpa Gula',
                'category' => 'rendah gula',
                'description' => 'Pecel sayur tanpa gula adalah variasi pecel yang dibuat dengan bumbu kacang tanpa tambahan gula atau kecap manis. Sayuran yang digunakan meliputi bayam, kacang panjang, tauge, dan daun singkong yang direbus. Bumbu kacang hanya menggunakan kacang tanah, cabai, bawang putih, dan garam. Menu ini tetap lezat dan mengenyangkan meskipun tanpa gula. Cocok untuk penderita diabetes atau program diet rendah gula dalam skema MBG.',
                'nutrition_info' => 'Kalori: 200 kkal | Protein: 10g | Karbohidrat: 18g | Gula: 2g | Lemak: 10g | Serat: 6g | Kalsium: 180mg | Zat Besi: 4mg',
            ],
            [
                'title' => 'Tumis Tahu Tempe Sayur',
                'category' => 'rendah gula',
                'description' => 'Tumis tahu tempe sayur merupakan kombinasi protein nabati dan sayuran yang dimasak tanpa gula tambahan. Tahu dan tempe dipotong dadu kecil lalu ditumis bersama buncis, wortel, dan cabai hijau dengan sedikit kecap asin. Menu ini menyediakan protein lengkap dari kedelai dan berbagai vitamin dari sayuran. Rendah gula dan tinggi serat menjadikannya pilihan sehat untuk menu harian program Makan Bergizi Gratis di sekolah.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 16g | Karbohidrat: 15g | Gula: 3g | Lemak: 16g | Serat: 5g | Kalsium: 250mg | Zat Besi: 4.5mg',
            ],

            // ============================
            // KATEGORI: MURAH BERGIZI
            // ============================
            [
                'title' => 'Nasi Sayur Bayam Telur',
                'category' => 'murah bergizi',
                'description' => 'Nasi sayur bayam telur adalah menu lengkap murah bergizi yang sangat populer di warung-warung makan Indonesia. Nasi putih disajikan dengan sayur bayam bening yang kaya zat besi dan telur rebus atau dadar sebagai sumber protein. Bayam merupakan sayuran murah yang tersedia sepanjang tahun dan mengandung vitamin A, C, dan mineral penting. Menu ini sangat ekonomis dengan biaya bahan baku sangat rendah namun menyediakan gizi seimbang untuk program MBG.',
                'nutrition_info' => 'Kalori: 380 kkal | Protein: 15g | Karbohidrat: 50g | Lemak: 12g | Serat: 4g | Zat Besi: 5mg | Vitamin A: 5000 IU | Kalsium: 150mg',
            ],
            [
                'title' => 'Bubur Ayam Sayuran',
                'category' => 'murah bergizi',
                'description' => 'Bubur ayam sayuran merupakan makanan hangat yang mudah dicerna dan sangat bergizi. Beras dimasak hingga lembut kemudian diberi topping suwiran ayam, kecap asin, bawang goreng, seledri, dan irisan wortel. Bubur adalah makanan ekonomis karena beras mengembang lebih banyak saat dimasak menjadi bubur. Menu ini cocok untuk anak-anak kecil yang masih dalam masa pertumbuhan dan membutuhkan makanan yang mudah dikunyah dan bergizi tinggi.',
                'nutrition_info' => 'Kalori: 320 kkal | Protein: 14g | Karbohidrat: 45g | Lemak: 8g | Serat: 2g | Zat Besi: 2mg | Vitamin B6: 0.3mg',
            ],
            [
                'title' => 'Mie Goreng Sayuran Telur',
                'category' => 'murah bergizi',
                'description' => 'Mie goreng sayuran telur adalah menu murah dan mengenyangkan yang disukai semua kalangan. Mie telur digoreng dengan sawi hijau, wortel, kol, dan telur orak-arik dengan bumbu kecap dan bawang putih. Menu ini menyediakan karbohidrat dari mie, protein dari telur, dan vitamin dari sayuran dalam satu piring. Biaya bahan baku sangat terjangkau dan proses memasaknya cepat. Ideal untuk program MBG yang melayani banyak penerima manfaat.',
                'nutrition_info' => 'Kalori: 400 kkal | Protein: 14g | Karbohidrat: 52g | Lemak: 14g | Serat: 3g | Vitamin A: 2000 IU | Vitamin C: 20mg',
            ],
            [
                'title' => 'Nasi Goreng Sederhana',
                'category' => 'murah bergizi',
                'description' => 'Nasi goreng sederhana merupakan menu andalan masyarakat Indonesia yang sangat ekonomis. Nasi sisa kemarin digoreng dengan telur, kecap manis, bawang merah, bawang putih, dan sedikit cabai. Dapat ditambahkan irisan wortel dan sawi untuk nilai gizi tambahan. Menu ini memanfaatkan nasi sisa sehingga mengurangi pemborosan makanan. Nasi goreng sangat populer dan disukai anak-anak sehingga tingkat penerimaan di program MBG sangat tinggi.',
                'nutrition_info' => 'Kalori: 420 kkal | Protein: 12g | Karbohidrat: 58g | Lemak: 14g | Serat: 2g | Vitamin B1: 0.2mg | Zat Besi: 2mg',
            ],
            [
                'title' => 'Sayur Sop Daging Ayam',
                'category' => 'murah bergizi',
                'description' => 'Sayur sop daging ayam adalah hidangan berkuah bening yang menggunakan potongan ayam kampung dengan sayuran seperti wortel, kentang, buncis, kol, dan seledri. Kuah kaldu ayam yang gurih memberikan rasa yang lezat dan menghangatkan. Menu ini menyediakan protein dari ayam, karbohidrat dari kentang, dan berbagai vitamin mineral dari sayuran. Satu ekor ayam dapat membuat banyak porsi sop sehingga sangat ekonomis untuk MBG.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 18g | Karbohidrat: 25g | Lemak: 10g | Serat: 4g | Vitamin A: 3000 IU | Vitamin C: 25mg | Kalium: 450mg',
            ],
            [
                'title' => 'Lontong Sayur Lodeh',
                'category' => 'murah bergizi',
                'description' => 'Lontong sayur lodeh merupakan menu tradisional Jawa yang sangat mengenyangkan dan bergizi. Lontong dari beras yang dikukus dalam daun pisang disajikan dengan sayur lodeh berisi labu siam, tempe, tahu, kacang panjang, dan terong dalam kuah santan kuning. Menu ini menyediakan karbohidrat kompleks, protein nabati, dan lemak sehat dari santan. Bahan-bahan yang digunakan sangat murah dan mudah didapat di pasar tradisional.',
                'nutrition_info' => 'Kalori: 400 kkal | Protein: 12g | Karbohidrat: 48g | Lemak: 16g | Serat: 5g | Kalsium: 100mg | Vitamin E: 2mg',
            ],
            [
                'title' => 'Nasi Kuning Sederhana',
                'category' => 'murah bergizi',
                'description' => 'Nasi kuning sederhana dimasak dengan kunyit, santan, serai, dan daun salam yang memberikan warna kuning cerah dan aroma harum. Disajikan dengan lauk sederhana seperti telur dadar, tempe goreng, sambal, dan irisan mentimun. Kunyit yang digunakan memiliki manfaat antiinflamasi dan antioksidan. Menu ini sangat festif dan menarik secara visual sehingga disukai anak-anak. Biaya produksinya rendah namun tampilannya istimewa.',
                'nutrition_info' => 'Kalori: 440 kkal | Protein: 14g | Karbohidrat: 55g | Lemak: 16g | Serat: 3g | Vitamin A: 800 IU | Kurkumin: 50mg',
            ],
            [
                'title' => 'Sayur Asem Jakarta',
                'category' => 'murah bergizi',
                'description' => 'Sayur asem Jakarta adalah sayuran berkuah asam segar khas Betawi yang menggunakan bahan-bahan murah seperti jagung muda, kacang panjang, labu siam, melinjo, kacang tanah, dan daun melinjo. Rasa asam dari asam jawa memberikan sensasi segar yang meningkatkan nafsu makan. Sayur asem kaya akan serat, vitamin, dan mineral dari berbagai jenis sayuran dan kacang-kacangan. Menu ini sangat ekonomis dan menyegarkan terutama di cuaca panas.',
                'nutrition_info' => 'Kalori: 150 kkal | Protein: 6g | Karbohidrat: 22g | Lemak: 4g | Serat: 5g | Vitamin C: 30mg | Zat Besi: 2.5mg | Kalium: 380mg',
            ],
            [
                'title' => 'Tempe Bacem',
                'category' => 'murah bergizi',
                'description' => 'Tempe bacem adalah makanan tradisional Jawa Tengah yang sangat ekonomis dan kaya protein nabati. Tempe direbus dalam bumbu bacem yang terdiri dari gula merah, bawang putih, ketumbar, daun salam, dan lengkuas hingga bumbu meresap. Setelah itu tempe digoreng hingga kecokelatan. Tempe bacem memiliki rasa manis gurih yang sangat disukai. Sebagai sumber protein nabati, tempe sangat murah dan menjadi andalan protein dalam program MBG.',
                'nutrition_info' => 'Kalori: 250 kkal | Protein: 16g | Karbohidrat: 18g | Lemak: 12g | Serat: 4g | Kalsium: 120mg | Zat Besi: 3mg | Vitamin B12: 0.1mcg',
            ],
            [
                'title' => 'Telor Puyuh Bumbu Balado',
                'category' => 'murah bergizi',
                'description' => 'Telur puyuh bumbu balado adalah lauk ekonomis yang disukai anak-anak. Telur puyuh yang kecil direbus lalu digoreng setengah matang dan disiram sambal balado dari cabai merah dan bawang. Telur puyuh mengandung protein tinggi dengan harga yang sangat terjangkau. Ukurannya yang kecil memudahkan porsi untuk anak-anak. Dalam satu porsi bisa disajikan beberapa butir telur puyuh yang memberikan asupan protein mencukupi.',
                'nutrition_info' => 'Kalori: 220 kkal | Protein: 14g | Karbohidrat: 6g | Lemak: 15g | Serat: 1g | Vitamin A: 400 IU | Selenium: 20mcg | Zat Besi: 2mg',
            ],

            // ============================
            // KATEGORI: VEGETARIAN
            // ============================
            [
                'title' => 'Gado-Gado Jakarta',
                'category' => 'vegetarian',
                'description' => 'Gado-gado Jakarta adalah salad Indonesia dengan bumbu kacang yang merupakan menu vegetarian sempurna. Terdiri dari sayuran rebus seperti kacang panjang, tauge, bayam, kol, kentang, dan tahu goreng yang disiram bumbu kacang tanah kental. Lontong atau ketupat menjadi sumber karbohidrat pelengkap. Menu ini menyediakan protein nabati dari kacang tanah dan tahu serta berbagai vitamin dari aneka sayuran. Sangat populer dan mengenyangkan untuk program MBG.',
                'nutrition_info' => 'Kalori: 380 kkal | Protein: 14g | Karbohidrat: 35g | Lemak: 20g | Serat: 7g | Kalsium: 200mg | Zat Besi: 4mg | Vitamin C: 40mg',
            ],
            [
                'title' => 'Pecel Lele Penyet Lalapan',
                'category' => 'vegetarian',
                'description' => 'Nasi pecel sayuran adalah menu vegetarian yang terdiri dari sayuran rebus yang disiram bumbu pecel kacang pedas. Sayuran yang digunakan meliputi bayam, kangkung, kecambah, kacang panjang, dan daun singkong. Bumbu pecel dari kacang tanah memberikan protein nabati dan rasa gurih pedas yang khas. Menu ini sangat populer di Jawa Timur dan Jawa Tengah. Seluruh bahan vegetarian dan bergizi tinggi cocok untuk keragaman pola makan dalam MBG.',
                'nutrition_info' => 'Kalori: 350 kkal | Protein: 12g | Karbohidrat: 40g | Lemak: 14g | Serat: 6g | Kalsium: 250mg | Zat Besi: 5mg | Vitamin A: 6000 IU',
            ],
            [
                'title' => 'Lodeh Terong Tahu',
                'category' => 'vegetarian',
                'description' => 'Lodeh terong tahu adalah sayuran berkuah santan yang menggabungkan terong ungu dan tahu dalam kuah santan kuning gurih. Terong kaya antioksidan antosianin yang memberikan warna ungu khasnya, sementara tahu menyediakan protein nabati berkualitas. Bumbu lodeh terdiri dari bawang merah, bawang putih, kunyit, lengkuas, dan cabai hijau. Menu vegetarian ini mengenyangkan dan lezat sehingga cocok untuk program MBG yang memperhatikan keragaman menu.',
                'nutrition_info' => 'Kalori: 220 kkal | Protein: 10g | Karbohidrat: 14g | Lemak: 14g | Serat: 4g | Kalsium: 180mg | Antosianin: 50mg | Vitamin E: 1.5mg',
            ],
            [
                'title' => 'Sayur Urap Kelapa',
                'category' => 'vegetarian',
                'description' => 'Sayur urap kelapa adalah hidangan tradisional Jawa yang menggabungkan berbagai sayuran rebus dengan bumbu kelapa parut segar. Sayuran seperti kangkung, bayam, kacang panjang, dan tauge dicampur dengan parutan kelapa yang dibumbui cabai, bawang putih, jeruk limau, dan garam. Kelapa parut memberikan lemak sehat MCT dan rasa gurih alami. Menu vegetarian ini sangat kaya serat dan vitamin dari kombinasi sayuran dan kelapa.',
                'nutrition_info' => 'Kalori: 200 kkal | Protein: 6g | Karbohidrat: 12g | Lemak: 14g | Serat: 6g | Vitamin A: 4000 IU | Vitamin C: 25mg | Mangan: 1.2mg',
            ],
            [
                'title' => 'Karedok Sunda',
                'category' => 'vegetarian',
                'description' => 'Karedok adalah salad mentah khas Sunda dengan bumbu kacang yang segar dan pedas. Sayuran mentah seperti mentimun, kol, terong bulat, kacang panjang, dan tauge dicampur bumbu kacang tanah dengan tambahan kencur yang memberikan aroma khas. Mengonsumsi sayuran mentah memaksimalkan asupan enzim dan vitamin yang tidak rusak oleh pemanasan. Menu vegetarian ini sangat segar dan cocok untuk iklim tropis Indonesia sebagai bagian program MBG.',
                'nutrition_info' => 'Kalori: 250 kkal | Protein: 10g | Karbohidrat: 20g | Lemak: 14g | Serat: 5g | Vitamin C: 35mg | Vitamin K: 80mcg | Folat: 70mcg',
            ],
            [
                'title' => 'Tumis Tempe Kecap',
                'category' => 'vegetarian',
                'description' => 'Tumis tempe kecap adalah menu vegetarian sederhana yang kaya protein nabati. Tempe diiris tipis dan ditumis dengan bawang merah, bawang putih, cabai, dan kecap manis hingga bumbu meresap. Tempe merupakan makanan fermentasi kedelai yang mengandung probiotik alami dan vitamin B12. Menu ini sangat mudah dibuat dan disukai semua kalangan karena rasanya yang manis gurih. Biaya sangat murah menjadikannya pilihan utama protein vegetarian di MBG.',
                'nutrition_info' => 'Kalori: 270 kkal | Protein: 18g | Karbohidrat: 16g | Lemak: 14g | Serat: 5g | Kalsium: 130mg | Zat Besi: 3.5mg | Vitamin B12: 0.2mcg',
            ],
            [
                'title' => 'Sayur Bening Labu Siam',
                'category' => 'vegetarian',
                'description' => 'Sayur bening labu siam adalah masakan vegetarian berkuah bening yang ringan dan menyehatkan. Labu siam dipotong kotak kecil direbus bersama daun bayam, jagung manis, dan daun melinjo dalam air dengan sedikit garam dan bawang putih. Sayur bening sangat mudah dicerna dan rendah kalori namun kaya serat dan mineral. Labu siam mengandung folat yang penting untuk ibu hamil dan anak dalam masa pertumbuhan. Ideal sebagai menu sayuran harian MBG.',
                'nutrition_info' => 'Kalori: 80 kkal | Protein: 3g | Karbohidrat: 14g | Lemak: 1g | Serat: 3g | Folat: 90mcg | Vitamin C: 15mg | Kalium: 300mg',
            ],
            [
                'title' => 'Tahu Goreng Bumbu Rujak',
                'category' => 'vegetarian',
                'description' => 'Tahu goreng bumbu rujak adalah hidangan vegetarian yang menggabungkan tahu goreng renyah dengan bumbu rujak pedas manis. Tahu putih yang digoreng garing disiram bumbu dari cabai, gula merah, petis udang alternatif petis kedelai, dan kacang tanah tumbuk. Tahu menyediakan protein nabati yang mudah dicerna dan kalsium yang penting untuk tulang. Bumbu rujak memberikan sensasi rasa yang kompleks dan meningkatkan selera makan.',
                'nutrition_info' => 'Kalori: 300 kkal | Protein: 16g | Karbohidrat: 20g | Lemak: 18g | Serat: 3g | Kalsium: 250mg | Zat Besi: 4mg | Isoflavon: 30mg',
            ],

            // ============================
            // KATEGORI: ANAK SEKOLAH
            // ============================
            [
                'title' => 'Nasi Tim Ayam Wortel',
                'category' => 'anak sekolah',
                'description' => 'Nasi tim ayam wortel adalah menu spesial untuk anak sekolah yang dikukus lembut dengan kaldu ayam, wortel, dan potongan daging ayam. Teksturnya yang lembut memudahkan anak-anak untuk makan dan mencerna. Nasi tim kaya karbohidrat kompleks dari beras dan protein dari ayam. Wortel memberikan vitamin A yang penting untuk kesehatan mata anak. Menu ini sangat cocok untuk program MBG di sekolah dasar karena tampilannya menarik dan rasanya disukai anak-anak.',
                'nutrition_info' => 'Kalori: 350 kkal | Protein: 16g | Karbohidrat: 48g | Lemak: 8g | Serat: 2g | Vitamin A: 4000 IU | Zat Besi: 2mg | Zinc: 2.5mg',
            ],
            [
                'title' => 'Nugget Ayam Sayuran Homemade',
                'category' => 'anak sekolah',
                'description' => 'Nugget ayam sayuran homemade dibuat dari daging ayam giling yang dicampur wortel parut dan brokoli cincang halus. Berbeda dari nugget komersial, versi homemade ini tidak mengandung pengawet dan MSG berlebihan. Daging ayam memberikan protein hewani, sementara sayuran yang tersembunyi memberikan vitamin tanpa anak menyadarinya. Nugget dibalut tepung roti dan dipanggang atau digoreng ringan. Menu ini sangat populer di kalangan anak sekolah.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 18g | Karbohidrat: 20g | Lemak: 12g | Serat: 2g | Vitamin A: 2500 IU | Vitamin C: 15mg | Zinc: 2mg',
            ],
            [
                'title' => 'Roti Sandwich Telur Selada',
                'category' => 'anak sekolah',
                'description' => 'Roti sandwich telur selada merupakan menu praktis untuk anak sekolah yang mudah disiapkan dan dibawa. Roti gandum diisi dengan telur dadar atau rebus yang diiris, selada segar, dan sedikit mayones rendah lemak. Roti gandum menyediakan karbohidrat kompleks dan serat, telur memberikan protein lengkap, dan selada memberikan vitamin. Menu ini sangat cocok sebagai bekal atau makan siang di sekolah dalam program MBG.',
                'nutrition_info' => 'Kalori: 320 kkal | Protein: 14g | Karbohidrat: 35g | Lemak: 12g | Serat: 4g | Vitamin B1: 0.3mg | Folat: 50mcg | Vitamin E: 2mg',
            ],
            [
                'title' => 'Sup Makaroni Sayuran',
                'category' => 'anak sekolah',
                'description' => 'Sup makaroni sayuran adalah hidangan hangat yang sangat disukai anak-anak sekolah. Makaroni direbus dalam kuah kaldu ayam bersama potongan wortel, buncis, kentang, dan ayam suwir. Tekstur makaroni yang kenyal dan kuah yang gurih membuat anak-anak lahap makan. Menu ini mengandung karbohidrat dari makaroni, protein dari ayam, dan vitamin mineral dari sayuran. Sup hangat juga membantu menjaga stamina anak selama kegiatan belajar di sekolah.',
                'nutrition_info' => 'Kalori: 300 kkal | Protein: 14g | Karbohidrat: 40g | Lemak: 8g | Serat: 3g | Vitamin A: 3000 IU | Vitamin C: 20mg | Zinc: 2mg',
            ],
            [
                'title' => 'Oatmeal Pisang Madu',
                'category' => 'anak sekolah',
                'description' => 'Oatmeal pisang madu adalah sarapan bergizi tinggi yang mudah disiapkan untuk anak sekolah. Oat dimasak dengan susu hingga lembut kemudian ditaburi irisan pisang segar dan madu asli. Oat merupakan sumber serat beta-glucan yang baik untuk pencernaan dan menjaga energi stabil sepanjang pagi. Pisang memberikan kalium dan energi cepat, sementara madu memberikan rasa manis alami dan antioksidan. Menu ini mendukung konsentrasi belajar anak.',
                'nutrition_info' => 'Kalori: 350 kkal | Protein: 10g | Karbohidrat: 55g | Lemak: 8g | Serat: 6g | Kalium: 400mg | Magnesium: 40mg | Vitamin B6: 0.4mg',
            ],
            [
                'title' => 'Nasi Bento Anak Lucu',
                'category' => 'anak sekolah',
                'description' => 'Nasi bento anak lucu adalah konsep penyajian makanan bergizi dalam kotak bento yang menarik. Nasi putih dibentuk menjadi karakter lucu dengan nori dan dikelilingi lauk seperti telur dadar gulung, sosis ayam, wortel rebus, brokoli, dan buah-buahan. Penyajian yang menarik meningkatkan minat makan anak-anak. Menu ini mengandung karbohidrat, protein, vitamin dan mineral yang seimbang. Konsep bento sangat cocok untuk program MBG yang ingin meningkatkan antusiasme anak.',
                'nutrition_info' => 'Kalori: 400 kkal | Protein: 16g | Karbohidrat: 50g | Lemak: 14g | Serat: 3g | Vitamin A: 3500 IU | Vitamin C: 30mg | Kalsium: 80mg',
            ],
            [
                'title' => 'Puding Susu Buah Segar',
                'category' => 'anak sekolah',
                'description' => 'Puding susu buah segar adalah dessert bergizi yang sangat disukai anak-anak sekolah. Puding dibuat dari susu segar, agar-agar, dan sedikit gula yang dicetak menarik kemudian dihias dengan potongan buah segar seperti strawberry, kiwi, dan mangga. Susu memberikan kalsium dan protein untuk pertumbuhan tulang anak. Buah-buahan segar memberikan vitamin C dan serat. Menu ini dapat dijadikan makanan penutup atau snack di antara jam belajar.',
                'nutrition_info' => 'Kalori: 180 kkal | Protein: 6g | Karbohidrat: 28g | Lemak: 4g | Serat: 2g | Kalsium: 200mg | Vitamin C: 40mg | Vitamin D: 2mcg',
            ],
            [
                'title' => 'Martabak Telur Mini',
                'category' => 'anak sekolah',
                'description' => 'Martabak telur mini adalah versi kecil dari martabak telur yang cocok untuk porsi anak sekolah. Kulit martabak yang tipis diisi dengan campuran telur, daging ayam cincang, daun bawang, dan wortel parut kemudian digoreng hingga renyah. Ukuran mini memudahkan anak untuk makan dan porsinya pas untuk satu kali makan. Menu ini menyediakan protein dari telur dan ayam serta karbohidrat dari kulit martabak. Sangat populer dan disukai anak-anak.',
                'nutrition_info' => 'Kalori: 260 kkal | Protein: 14g | Karbohidrat: 22g | Lemak: 12g | Serat: 1g | Vitamin A: 1500 IU | Zat Besi: 2mg | Zinc: 1.8mg',
            ],
            [
                'title' => 'Nasi Goreng Teri Medan',
                'category' => 'anak sekolah',
                'description' => 'Nasi goreng teri Medan adalah variasi nasi goreng yang menggunakan ikan teri kering sebagai sumber protein dan kalsium. Nasi digoreng dengan bumbu bawang merah, bawang putih, cabai, dan kecap dengan tambahan teri goreng renyah. Ikan teri sangat kaya kalsium karena dimakan beserta tulangnya. Menu ini menjadi favorit anak sekolah karena teri yang gurih dan renyah. Harga teri yang terjangkau membuat menu ini cocok untuk program MBG.',
                'nutrition_info' => 'Kalori: 380 kkal | Protein: 16g | Karbohidrat: 50g | Lemak: 12g | Serat: 2g | Kalsium: 300mg | Zat Besi: 3mg | Omega-3: 0.5g',
            ],

            // ============================
            // KATEGORI: TINGGI SERAT
            // ============================
            [
                'title' => 'Bubur Kacang Hijau',
                'category' => 'tinggi serat',
                'description' => 'Bubur kacang hijau adalah makanan tradisional Indonesia yang sangat tinggi serat dan nutrisi. Kacang hijau dimasak hingga lembut dengan gula merah dan sedikit santan encer serta daun pandan untuk aroma. Kacang hijau merupakan sumber serat larut dan tidak larut yang sangat baik untuk pencernaan. Selain serat, kacang hijau juga kaya protein nabati, zat besi, dan vitamin B. Menu ini dapat disajikan hangat atau dingin sebagai sarapan atau snack dalam program MBG.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 12g | Karbohidrat: 45g | Lemak: 4g | Serat: 8g | Zat Besi: 4mg | Folat: 120mcg | Magnesium: 60mg',
            ],
            [
                'title' => 'Sayur Lodeh Jawa',
                'category' => 'tinggi serat',
                'description' => 'Sayur lodeh Jawa adalah masakan berkuah santan yang berisi aneka sayuran tinggi serat seperti nangka muda, labu siam, kacang panjang, terong, dan daun melinjo. Dimasak dengan bumbu kuning dari kunyit, lengkuas, daun salam, dan cabai hijau. Kombinasi berbagai sayuran memberikan asupan serat yang sangat tinggi dalam satu hidangan. Sayur lodeh merupakan menu tradisional yang diwarisi turun temurun dan sangat cocok sebagai menu sayuran utama dalam program MBG.',
                'nutrition_info' => 'Kalori: 200 kkal | Protein: 6g | Karbohidrat: 20g | Lemak: 10g | Serat: 7g | Vitamin A: 3500 IU | Vitamin C: 20mg | Kalium: 350mg',
            ],
            [
                'title' => 'Pepes Tahu Jamur Merang',
                'category' => 'tinggi serat',
                'description' => 'Pepes tahu jamur merang menggabungkan protein nabati dari tahu dengan serat tinggi dari jamur merang dalam bungkusan daun pisang yang dikukus. Jamur merang mengandung beta-glucan yang merupakan serat larut bermanfaat untuk kesehatan jantung. Bumbu yang digunakan meliputi kemangi, cabai rawit, bawang merah, dan serai yang memberikan aroma wangi. Menu ini rendah kalori namun tinggi serat dan protein sehingga sangat mengenyangkan dan menyehatkan.',
                'nutrition_info' => 'Kalori: 180 kkal | Protein: 14g | Karbohidrat: 10g | Lemak: 8g | Serat: 6g | Kalsium: 200mg | Beta-Glucan: 2g | Selenium: 15mcg',
            ],
            [
                'title' => 'Singkong Rebus',
                'category' => 'tinggi serat',
                'description' => 'Singkong rebus merupakan makanan pokok alternatif yang sangat tinggi serat pangan. Singkong yang dikupas dan direbus menjadi lembut merupakan sumber karbohidrat kompleks dan pati resisten yang berfungsi sebagai prebiotik untuk bakteri baik di usus. Singkong juga mengandung vitamin C dan kalium yang penting. Sebagai komoditas lokal yang sangat murah dan mudah didapat, singkong rebus menjadi pilihan tepat untuk diversifikasi sumber karbohidrat dalam program MBG.',
                'nutrition_info' => 'Kalori: 160 kkal | Protein: 2g | Karbohidrat: 38g | Lemak: 0.3g | Serat: 4g | Vitamin C: 20mg | Kalium: 270mg | Pati Resisten: 3g',
            ],
            [
                'title' => 'Tumis Buncis Wortel',
                'category' => 'tinggi serat',
                'description' => 'Tumis buncis wortel adalah hidangan sayuran sederhana namun sangat tinggi serat. Buncis dan wortel dipotong serong kemudian ditumis dengan bawang putih, sedikit saus tiram, dan air. Buncis mengandung serat tidak larut yang membantu melancarkan pencernaan, sementara wortel menyediakan serat larut dan beta-karoten. Kombinasi warna hijau dan oranye membuat tampilan menarik. Menu ini sangat mudah dimasak dalam jumlah besar untuk program MBG.',
                'nutrition_info' => 'Kalori: 100 kkal | Protein: 4g | Karbohidrat: 14g | Lemak: 3g | Serat: 5g | Vitamin A: 6000 IU | Vitamin C: 15mg | Vitamin K: 50mcg',
            ],
            [
                'title' => 'Salad Buah Yogurt',
                'category' => 'tinggi serat',
                'description' => 'Salad buah yogurt menggabungkan beragam buah segar tinggi serat dengan yogurt plain sebagai dressing sehat. Buah-buahan yang digunakan meliputi apel, pir, pepaya, nanas, dan semangka yang dipotong dadu. Yogurt memberikan probiotik yang mendukung kesehatan pencernaan, sementara buah-buahan memberikan serat, vitamin, dan antioksidan. Menu ini segar dan ringan cocok sebagai snack sehat atau pendamping makan dalam program MBG di sekolah.',
                'nutrition_info' => 'Kalori: 180 kkal | Protein: 6g | Karbohidrat: 32g | Lemak: 3g | Serat: 5g | Vitamin C: 60mg | Probiotik: 1 miliar CFU | Kalium: 350mg',
            ],
            [
                'title' => 'Soto Betawi Sayuran',
                'category' => 'tinggi serat',
                'description' => 'Soto Betawi sayuran adalah variasi soto khas Jakarta yang diperkaya dengan banyak sayuran tinggi serat. Kuah santan susu yang gurih berisi kentang, wortel, tomat, daun bawang, bawang goreng, dan kacang tanah. Emping melinjo yang ditambahkan memberikan serat dan tekstur renyah. Sayuran dalam soto ini memberikan asupan serat yang baik, sementara kuah santan memberikan rasa yang kaya. Menu ini menghangatkan dan mengenyangkan untuk program MBG.',
                'nutrition_info' => 'Kalori: 320 kkal | Protein: 10g | Karbohidrat: 28g | Lemak: 18g | Serat: 5g | Vitamin A: 2500 IU | Vitamin C: 15mg | Kalsium: 80mg',
            ],
            [
                'title' => 'Kolak Ubi Pisang',
                'category' => 'tinggi serat',
                'description' => 'Kolak ubi pisang merupakan dessert tradisional Indonesia yang dibuat dari ubi jalar dan pisang yang direbus dalam kuah santan gula merah. Ubi jalar merupakan sumber serat pangan yang sangat tinggi dan juga mengandung beta-karoten. Pisang raja yang digunakan memberikan kalium dan serat tambahan. Gula merah memberikan rasa manis alami dengan indeks glikemik lebih rendah dari gula putih. Menu ini sangat populer dan cocok sebagai hidangan penutup bergizi dalam program MBG.',
                'nutrition_info' => 'Kalori: 300 kkal | Protein: 4g | Karbohidrat: 50g | Lemak: 10g | Serat: 6g | Beta-Karoten: 5000 IU | Kalium: 450mg | Mangan: 0.8mg',
            ],
            [
                'title' => 'Nasi Merah Sayur Asem',
                'category' => 'tinggi serat',
                'description' => 'Nasi merah sayur asem menggabungkan beras merah yang tinggi serat dengan sayur asem yang kaya sayuran. Beras merah mengandung serat tiga kali lipat dibanding beras putih dan memiliki indeks glikemik lebih rendah. Sayur asem dengan kacang tanah, jagung muda, labu siam, dan kacang panjang menambahkan serat dari aneka sayuran. Kombinasi ini membuat menu yang sangat tinggi serat total sehingga ideal untuk menjaga kesehatan pencernaan peserta program MBG.',
                'nutrition_info' => 'Kalori: 350 kkal | Protein: 10g | Karbohidrat: 55g | Lemak: 8g | Serat: 9g | Vitamin B1: 0.4mg | Mangan: 2mg | Selenium: 15mcg',
            ],
            [
                'title' => 'Sup Kacang Merah',
                'category' => 'tinggi serat',
                'description' => 'Sup kacang merah adalah hidangan berkuah yang sangat tinggi serat dan protein nabati. Kacang merah yang sudah direndam semalam direbus empuk kemudian dimasak dengan wortel, kentang, seledri, dan bumbu rempah. Kacang merah merupakan salah satu sumber serat terbaik yang juga kaya folat dan zat besi. Sup ini mengenyangkan dan bergizi tinggi dengan biaya yang sangat terjangkau. Cocok untuk menu MBG yang memerlukan alternatif protein nabati tinggi serat.',
                'nutrition_info' => 'Kalori: 250 kkal | Protein: 14g | Karbohidrat: 40g | Lemak: 2g | Serat: 10g | Folat: 150mcg | Zat Besi: 5mg | Magnesium: 70mg',
            ],

            // ============================
            // TAMBAHAN BERAGAM KATEGORI
            // ============================
            [
                'title' => 'Ayam Brokoli Tumis',
                'category' => 'tinggi protein',
                'description' => 'Ayam brokoli tumis adalah kombinasi sempurna protein hewani dari daging ayam dengan nutrisi tinggi dari brokoli. Daging ayam fillet dipotong dadu dan ditumis dengan kuntum brokoli segar, bawang putih, saus tiram, dan sedikit kecap asin. Brokoli mengandung sulforaphane yang merupakan antioksidan kuat, sementara ayam menyediakan protein berkualitas tinggi. Menu ini rendah kalori namun sangat bergizi dan mengenyangkan untuk program MBG.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 30g | Karbohidrat: 8g | Lemak: 12g | Serat: 3g | Vitamin C: 60mg | Sulforaphane: 40mg | Zinc: 3mg',
            ],
            [
                'title' => 'Ikan Tongkol Suwir Pedas',
                'category' => 'tinggi protein',
                'description' => 'Ikan tongkol suwir pedas adalah lauk tinggi protein yang ekonomis dan tahan lama. Ikan tongkol direbus kemudian disuwir halus dan ditumis dengan sambal dari cabai merah, bawang merah, tomat, dan sedikit terasi. Ikan tongkol merupakan ikan laut yang kaya protein dan omega-3 dengan harga yang sangat terjangkau. Tekstur suwir memudahkan anak-anak untuk memakannya. Menu ini dapat disimpan beberapa hari dan tetap lezat sebagai lauk nasi dalam program MBG.',
                'nutrition_info' => 'Kalori: 240 kkal | Protein: 28g | Karbohidrat: 5g | Lemak: 10g | Omega-3: 1g | Serat: 1g | Zat Besi: 2mg | Vitamin B12: 3mcg',
            ],
            [
                'title' => 'Sayur Daun Singkong',
                'category' => 'murah bergizi',
                'description' => 'Sayur daun singkong adalah hidangan sayuran murah bergizi yang menggunakan daun singkong yang direbus dan ditumis dengan bumbu kelapa parut. Daun singkong mengandung protein nabati yang sangat tinggi untuk kategori sayuran dan juga kaya vitamin A, vitamin C, dan zat besi. Daun singkong mudah tumbuh dan tersedia melimpah di seluruh Indonesia sehingga harganya sangat murah. Menu ini cocok untuk program MBG di daerah pedesaan.',
                'nutrition_info' => 'Kalori: 150 kkal | Protein: 8g | Karbohidrat: 12g | Lemak: 7g | Serat: 4g | Vitamin A: 8000 IU | Vitamin C: 60mg | Zat Besi: 3mg',
            ],
            [
                'title' => 'Jagung Rebus',
                'category' => 'tinggi serat',
                'description' => 'Jagung rebus merupakan makanan sederhana yang sangat tinggi serat dan menjadi camilan sehat favorit. Jagung manis direbus dengan kulitnya hingga matang sempurna. Jagung mengandung serat tidak larut yang melancarkan pencernaan dan pati resisten yang berfungsi sebagai prebiotik. Selain serat, jagung juga kaya akan lutein dan zeaxanthin yang baik untuk kesehatan mata. Menu ini sangat murah dan mudah disiapkan dalam jumlah besar untuk program MBG.',
                'nutrition_info' => 'Kalori: 130 kkal | Protein: 4g | Karbohidrat: 25g | Lemak: 2g | Serat: 4g | Lutein: 600mcg | Vitamin B5: 0.7mg | Folat: 40mcg',
            ],
            [
                'title' => 'Perkedel Kentang',
                'category' => 'anak sekolah',
                'description' => 'Perkedel kentang adalah gorengan favorit anak sekolah yang dibuat dari kentang rebus yang dihaluskan dan dicampur dengan daging cincang, bawang merah goreng, seledri, dan telur kemudian digoreng hingga kecokelatan. Kentang menyediakan karbohidrat kompleks dan kalium, sementara daging cincang memberikan protein hewani. Teksturnya yang lembut di dalam dan renyah di luar sangat disukai anak-anak. Perkedel mudah dimakan tanpa menggunakan sendok garpu.',
                'nutrition_info' => 'Kalori: 200 kkal | Protein: 8g | Karbohidrat: 20g | Lemak: 10g | Serat: 2g | Kalium: 350mg | Vitamin C: 12mg | Vitamin B6: 0.3mg',
            ],
            [
                'title' => 'Es Dawet Cendol',
                'category' => 'murah bergizi',
                'description' => 'Es dawet cendol adalah minuman tradisional yang terbuat dari tepung beras dan tepung hunkwe yang dibentuk menjadi cendol hijau dengan air daun suji. Disajikan dengan santan segar dan gula merah cair. Cendol memberikan karbohidrat, santan memberikan lemak sehat MCT, dan gula merah memberikan energi serta mineral. Menu ini sangat menyegarkan di cuaca panas dan menjadi minuman khas yang disukai semua kalangan dalam program MBG.',
                'nutrition_info' => 'Kalori: 250 kkal | Protein: 3g | Karbohidrat: 42g | Lemak: 8g | Serat: 1g | Zat Besi: 2mg | Kalium: 200mg | Kalsium: 40mg',
            ],
            [
                'title' => 'Soto Ayam Lamongan',
                'category' => 'tinggi protein',
                'description' => 'Soto ayam Lamongan adalah sup ayam khas Jawa Timur dengan kuah kuning gurih yang menggunakan kunyit dan rempah-rempah. Disajikan dengan suwiran ayam yang melimpah, tauge, daun bawang, seledri, bawang goreng, dan kerupuk udang. Kuah soto yang kaya kolagen dari kaldu tulang ayam memberikan manfaat untuk kesehatan sendi dan kulit. Menu ini mengandung protein tinggi dari ayam dan sangat menghangatkan tubuh. Populer sebagai menu makan siang MBG.',
                'nutrition_info' => 'Kalori: 350 kkal | Protein: 24g | Karbohidrat: 25g | Lemak: 15g | Serat: 2g | Kolagen: 3g | Vitamin A: 2000 IU | Zinc: 3mg',
            ],
            [
                'title' => 'Ubi Jalar Panggang',
                'category' => 'tinggi serat',
                'description' => 'Ubi jalar panggang merupakan cemilan sehat tinggi serat yang mudah disiapkan. Ubi jalar dicuci bersih kemudian dipanggang dengan kulit hingga matang sempurna. Ubi jalar oranye sangat kaya beta-karoten yang diubah tubuh menjadi vitamin A. Selain itu, ubi jalar mengandung serat pangan yang tinggi dan pati resisten yang baik untuk bakteri usus. Indeks glikemiknya lebih rendah dari kentang sehingga memberikan energi yang stabil untuk anak-anak sekolah.',
                'nutrition_info' => 'Kalori: 180 kkal | Protein: 3g | Karbohidrat: 40g | Lemak: 0.5g | Serat: 5g | Beta-Karoten: 9000 IU | Vitamin C: 18mg | Mangan: 0.5mg',
            ],
            [
                'title' => 'Gudeg Jogja',
                'category' => 'murah bergizi',
                'description' => 'Gudeg Jogja adalah masakan khas Yogyakarta yang terbuat dari nangka muda yang dimasak lama dalam santan, gula merah, dan rempah-rempah hingga berwarna cokelat dan empuk. Gudeg biasanya disajikan dengan areh santan kental, telur pindang, dan ayam kampung. Nangka muda kaya serat dan potasium, sementara gula merah memberikan mineral seperti zat besi. Menu tradisional ini sangat mengenyangkan dan bernilai budaya tinggi untuk program MBG.',
                'nutrition_info' => 'Kalori: 400 kkal | Protein: 10g | Karbohidrat: 52g | Lemak: 16g | Serat: 4g | Kalium: 300mg | Zat Besi: 3mg | Vitamin C: 10mg',
            ],
            [
                'title' => 'Opor Ayam Bumbu Kuning',
                'category' => 'tinggi protein',
                'description' => 'Opor ayam bumbu kuning adalah masakan khas Indonesia yang dimasak dalam santan berbumbu kunyit, kemiri, ketumbar, dan rempah lainnya. Daging ayam yang dimasak lama dalam kuah opor menjadi empuk dan bumbu meresap sempurna. Opor ayam kaya protein hewani dan lemak sehat dari santan. Menu ini identik dengan perayaan hari besar dan memberikan kesan istimewa. Sangat cocok untuk menu spesial program MBG pada hari-hari tertentu.',
                'nutrition_info' => 'Kalori: 420 kkal | Protein: 28g | Karbohidrat: 8g | Lemak: 30g | Serat: 2g | Vitamin A: 500 IU | Zat Besi: 2.5mg | Vitamin E: 3mg',
            ],
            [
                'title' => 'Pepes Jamur Tiram',
                'category' => 'vegetarian',
                'description' => 'Pepes jamur tiram adalah hidangan vegetarian yang dibungkus daun pisang dan dikukus. Jamur tiram segar dicampur dengan bumbu yang terdiri dari bawang merah, bawang putih, cabai, kemangi, dan serai. Jamur tiram memiliki tekstur yang mirip daging dan kaya akan protein nabati, vitamin B, dan selenium. Menu ini rendah kalori namun sangat mengenyangkan dan cocok untuk variasi menu vegetarian dalam program MBG. Pepes menjaga kelembapan dan nutrisi jamur.',
                'nutrition_info' => 'Kalori: 120 kkal | Protein: 8g | Karbohidrat: 10g | Lemak: 4g | Serat: 3g | Selenium: 20mcg | Vitamin B3: 4mg | Vitamin D: 2mcg',
            ],
            [
                'title' => 'Pisang Goreng Kipas',
                'category' => 'anak sekolah',
                'description' => 'Pisang goreng kipas adalah cemilan tradisional yang disukai anak-anak sekolah. Pisang kepok yang matang diiris tipis berbentuk kipas kemudian dicelup adonan tepung dan digoreng hingga renyah kecokelatan. Pisang mengandung kalium, vitamin B6, dan karbohidrat untuk energi. Adonan tepung memberikan tekstur renyah yang menarik. Cemilan ini cocok sebagai snack tambahan di program MBG yang memberikan energi cepat untuk aktivitas anak-anak di sekolah.',
                'nutrition_info' => 'Kalori: 220 kkal | Protein: 3g | Karbohidrat: 35g | Lemak: 8g | Serat: 2g | Kalium: 300mg | Vitamin B6: 0.4mg | Magnesium: 25mg',
            ],
            [
                'title' => 'Rawon Daging Sapi',
                'category' => 'tinggi protein',
                'description' => 'Rawon daging sapi adalah sup daging hitam khas Jawa Timur yang mendapat warna hitam dari kluwek. Daging sapi dipotong kecil dan dimasak lama dalam bumbu kluwek, bawang merah, bawang putih, lengkuas, dan kunyit. Rawon kaya protein hewani berkualitas tinggi dan zat besi heme. Kluwek mengandung antioksidan unik yang jarang ditemukan dalam makanan lain. Disajikan dengan tauge, telur asin, sambal, dan nasi putih sebagai menu premium MBG.',
                'nutrition_info' => 'Kalori: 380 kkal | Protein: 32g | Karbohidrat: 10g | Lemak: 22g | Serat: 2g | Zat Besi: 5mg | Vitamin B12: 3mcg | Zinc: 5mg',
            ],
            [
                'title' => 'Sayur Kelor',
                'category' => 'murah bergizi',
                'description' => 'Sayur kelor merupakan masakan dari daun kelor yang dikenal sebagai superfood dengan kandungan nutrisi luar biasa. Daun kelor mengandung vitamin A tujuh kali lebih banyak dari wortel, kalsium empat kali lebih banyak dari susu, dan protein dua kali lebih banyak dari yogurt. Sayur kelor biasanya dimasak bening dengan jagung manis dan potongan wortel. Pohon kelor tumbuh subur di seluruh Indonesia dan daunnya gratis sehingga sangat ideal untuk program MBG.',
                'nutrition_info' => 'Kalori: 90 kkal | Protein: 6g | Karbohidrat: 10g | Lemak: 2g | Serat: 3g | Vitamin A: 7500 IU | Kalsium: 400mg | Zat Besi: 4mg | Vitamin C: 50mg',
            ],
            [
                'title' => 'Kwetiau Goreng Seafood',
                'category' => 'tinggi protein',
                'description' => 'Kwetiau goreng seafood adalah mi pipih yang digoreng dengan campuran udang, cumi, dan sayuran segar. Kwetiau dimasak dengan api besar bersama tauge, sawi hijau, telur, dan bumbu kecap. Udang dan cumi menyediakan protein hewani rendah lemak dan kaya mineral selenium serta zinc. Menu ini populer di kalangan masyarakat Indonesia dan menyediakan karbohidrat, protein, dan vitamin dalam satu hidangan untuk program MBG.',
                'nutrition_info' => 'Kalori: 380 kkal | Protein: 22g | Karbohidrat: 42g | Lemak: 12g | Serat: 2g | Selenium: 35mcg | Zinc: 3mg | Vitamin B12: 2mcg',
            ],
            [
                'title' => 'Sambal Goreng Kentang Tempe',
                'category' => 'murah bergizi',
                'description' => 'Sambal goreng kentang tempe adalah lauk pendamping yang menggabungkan kentang dan tempe dalam sambal manis pedas. Kentang dan tempe dipotong dadu kecil, digoreng, kemudian dicampur sambal dari cabai merah, bawang merah, bawang putih, gula merah, dan kecap. Menu ini menyediakan karbohidrat dari kentang dan protein nabati dari tempe. Sangat ekonomis dan tahan lama menjadikannya lauk andalan dalam program MBG di berbagai daerah.',
                'nutrition_info' => 'Kalori: 300 kkal | Protein: 12g | Karbohidrat: 28g | Lemak: 15g | Serat: 4g | Kalium: 400mg | Vitamin C: 15mg | Zat Besi: 3mg',
            ],
            [
                'title' => 'Sup Jagung Telur',
                'category' => 'anak sekolah',
                'description' => 'Sup jagung telur adalah hidangan berkuah yang sangat disukai anak-anak sekolah. Jagung manis yang dipipil dimasak dalam kaldu ayam yang gurih kemudian dituangi telur kocok yang membentuk serat-serat halus dalam kuah. Ditambahkan wortel dan daun bawang untuk nutrisi dan warna. Jagung manis memberikan rasa manis alami yang disukai anak-anak. Sup ini kaya karbohidrat, protein dari telur, dan vitamin dari sayuran.',
                'nutrition_info' => 'Kalori: 200 kkal | Protein: 10g | Karbohidrat: 28g | Lemak: 6g | Serat: 3g | Vitamin A: 2000 IU | Lutein: 400mcg | Folat: 50mcg',
            ],
            [
                'title' => 'Nasi Uduk Betawi',
                'category' => 'murah bergizi',
                'description' => 'Nasi uduk Betawi adalah nasi yang dimasak dengan santan, serai, daun salam, dan daun pandan sehingga memiliki aroma yang harum dan rasa gurih. Nasi uduk biasanya disajikan dengan lauk sederhana seperti tahu goreng, tempe goreng, telur balado, bihun goreng, dan sambal kacang. Menu ini sangat mengenyangkan dan ekonomis karena satu porsi nasi uduk dengan lauk lengkap bisa disajikan dengan biaya rendah. Favorit masyarakat Jakarta untuk program MBG.',
                'nutrition_info' => 'Kalori: 450 kkal | Protein: 14g | Karbohidrat: 55g | Lemak: 18g | Serat: 3g | Kalsium: 80mg | Vitamin B1: 0.2mg | Zat Besi: 2.5mg',
            ],
            [
                'title' => 'Bakwan Jagung',
                'category' => 'anak sekolah',
                'description' => 'Bakwan jagung adalah gorengan renyah yang sangat populer sebagai cemilan anak sekolah. Terbuat dari jagung manis yang dicampur adonan tepung terigu, sedikit tepung beras, daun bawang, dan wortel parut kemudian digoreng hingga kecokelatan. Jagung manis memberikan rasa manis alami dan serat, sementara sayuran memberikan vitamin. Bakwan jagung mudah dibuat dalam jumlah besar dan sangat disukai anak-anak sebagai snack di program MBG.',
                'nutrition_info' => 'Kalori: 180 kkal | Protein: 4g | Karbohidrat: 24g | Lemak: 8g | Serat: 2g | Vitamin A: 500 IU | Vitamin C: 5mg | Folat: 25mcg',
            ],
            [
                'title' => 'Tahu Bacem Goreng',
                'category' => 'murah bergizi',
                'description' => 'Tahu bacem goreng merupakan olahan tahu khas Jawa yang direbus dalam bumbu bacem gula merah dan rempah-rempah kemudian digoreng kering. Tahu menyerap bumbu bacem yang manis gurih dan menjadi lauk yang sangat lezat. Tahu merupakan sumber protein nabati yang sangat murah dan kaya kalsium. Proses bacem membuat tahu lebih awet dan berasa lebih enak. Menu ini menjadi andalan protein ekonomis dalam program Makan Bergizi Gratis.',
                'nutrition_info' => 'Kalori: 230 kkal | Protein: 14g | Karbohidrat: 14g | Lemak: 12g | Serat: 2g | Kalsium: 250mg | Isoflavon: 25mg | Zat Besi: 3mg',
            ],
            [
                'title' => 'Sayur Tumis Kangkung Terasi',
                'category' => 'rendah gula',
                'description' => 'Sayur tumis kangkung terasi adalah masakan sayuran yang sangat populer di Indonesia. Kangkung segar ditumis dengan api besar bersama bumbu terasi, bawang merah, bawang putih, cabai rawit, dan tomat. Terasi memberikan rasa umami yang khas dan menambah mineral. Kangkung merupakan sayuran hijau yang sangat kaya zat besi dan kalsium. Menu ini rendah gula, rendah kalori, dan sangat cepat dimasak sehingga ideal untuk penyajian massal dalam program MBG.',
                'nutrition_info' => 'Kalori: 100 kkal | Protein: 5g | Karbohidrat: 6g | Gula: 1g | Lemak: 6g | Serat: 3g | Zat Besi: 4mg | Kalsium: 130mg | Vitamin A: 5000 IU',
            ],
            [
                'title' => 'Sup Tahu Sayuran Bening',
                'category' => 'rendah gula',
                'description' => 'Sup tahu sayuran bening adalah hidangan ringan rendah gula yang menggunakan tahu sutra lembut dalam kuah kaldu bening. Ditambahkan wortel, sawi putih, jamur kuping, dan daun bawang untuk nutrisi dan rasa. Sup bening tanpa gula tambahan ini sangat sehat dan mudah dicerna. Tahu sutra memberikan protein nabati yang lembut, sementara sayuran memberikan serat dan vitamin. Menu ini cocok untuk pendamping menu utama dalam program MBG yang sehat.',
                'nutrition_info' => 'Kalori: 110 kkal | Protein: 8g | Karbohidrat: 8g | Gula: 2g | Lemak: 5g | Serat: 2g | Kalsium: 150mg | Vitamin C: 10mg',
            ],
            [
                'title' => 'Ayam Goreng Kalasan',
                'category' => 'tinggi protein',
                'description' => 'Ayam goreng Kalasan adalah ayam goreng khas Yogyakarta yang direndam dalam air kelapa muda dan bumbu rempah sebelum digoreng. Rendaman air kelapa membuat daging ayam menjadi sangat empuk dan gurih. Bumbu yang meresap memberikan cita rasa khas yang berbeda dari ayam goreng biasa. Ayam goreng Kalasan kaya protein hewani dan menjadi menu premium yang sangat disukai. Cocok untuk menu istimewa dalam program MBG pada acara tertentu.',
                'nutrition_info' => 'Kalori: 400 kkal | Protein: 32g | Karbohidrat: 10g | Lemak: 24g | Serat: 1g | Vitamin B6: 0.5mg | Zat Besi: 2.5mg | Niacin: 8mg',
            ],
            [
                'title' => 'Kacang Tanah Rebus',
                'category' => 'tinggi serat',
                'description' => 'Kacang tanah rebus merupakan cemilan sehat tinggi serat dan protein yang sangat ekonomis. Kacang tanah mentah dengan kulitnya direbus dalam air garam hingga empuk. Kacang tanah mengandung protein nabati tinggi, lemak tak jenuh yang menyehatkan jantung, dan serat pangan yang baik untuk pencernaan. Selain itu kacang tanah kaya vitamin E, folat, dan magnesium. Menu cemilan ini sangat murah dan mudah disiapkan untuk program MBG di sekolah.',
                'nutrition_info' => 'Kalori: 320 kkal | Protein: 14g | Karbohidrat: 12g | Lemak: 24g | Serat: 6g | Vitamin E: 8mg | Folat: 100mcg | Magnesium: 80mg',
            ],
            [
                'title' => 'Ikan Patin Bumbu Kuning',
                'category' => 'tinggi protein',
                'description' => 'Ikan patin bumbu kuning adalah hidangan ikan air tawar yang dimasak dalam bumbu kuning berbasis kunyit dan santan. Ikan patin memiliki daging yang lembut dan mudah dibudidayakan sehingga harganya stabil dan terjangkau. Bumbu kuning dari kunyit, lengkuas, serai, dan daun jeruk memberikan aroma wangi dan rasa gurih. Ikan patin kaya protein dan asam lemak omega-3 yang penting untuk perkembangan otak anak. Ideal sebagai lauk utama program MBG.',
                'nutrition_info' => 'Kalori: 300 kkal | Protein: 26g | Karbohidrat: 5g | Lemak: 18g | Omega-3: 0.8g | Serat: 1g | Vitamin D: 4mcg | Fosfor: 200mg',
            ],
            [
                'title' => 'Ketoprak Jakarta',
                'category' => 'vegetarian',
                'description' => 'Ketoprak Jakarta adalah makanan jalanan khas Betawi yang terdiri dari lontong, tahu goreng, bihun, dan tauge yang disiram bumbu kacang encer. Bumbu kacang terbuat dari kacang tanah goreng yang dihaluskan dengan cabai, bawang putih, kecap manis, dan air asam. Ketoprak merupakan menu vegetarian yang lengkap dengan karbohidrat, protein nabati, dan sayuran. Harganya sangat ekonomis dan mengenyangkan menjadikannya pilihan ideal untuk program MBG.',
                'nutrition_info' => 'Kalori: 400 kkal | Protein: 14g | Karbohidrat: 48g | Lemak: 16g | Serat: 4g | Kalsium: 150mg | Zat Besi: 3mg | Vitamin C: 10mg',
            ],
            [
                'title' => 'Nasi Jagung Sayur Daun Pepaya',
                'category' => 'tinggi serat',
                'description' => 'Nasi jagung sayur daun pepaya adalah menu alternatif yang menggabungkan nasi jagung sebagai pengganti beras dengan sayur daun pepaya yang pahit namun sangat bernutrisi. Nasi jagung dibuat dari jagung yang ditumbuk kasar dan dimasak seperti nasi. Daun pepaya yang direbus dan ditumis mengandung enzim papain yang membantu pencernaan protein. Kedua bahan ini sangat tinggi serat dan murah. Cocok untuk diversifikasi pangan dalam program MBG.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 8g | Karbohidrat: 48g | Lemak: 5g | Serat: 8g | Vitamin A: 5000 IU | Vitamin C: 40mg | Papain: aktif',
            ],
            [
                'title' => 'Empek-Empek Palembang',
                'category' => 'tinggi protein',
                'description' => 'Empek-empek Palembang adalah makanan khas Sumatera Selatan yang terbuat dari ikan tenggiri yang dihaluskan dan dicampur tepung sagu. Adonan dibentuk menjadi berbagai bentuk dan direbus kemudian digoreng. Disajikan dengan kuah cuko yang asam pedas manis. Empek-empek sangat kaya protein dari ikan tenggiri dan karbohidrat dari sagu. Menu ini sangat populer di seluruh Indonesia dan menarik untuk disajikan dalam program MBG sebagai variasi menu daerah.',
                'nutrition_info' => 'Kalori: 350 kkal | Protein: 20g | Karbohidrat: 38g | Lemak: 12g | Serat: 1g | Omega-3: 0.6g | Zat Besi: 2mg | Fosfor: 180mg',
            ],
            [
                'title' => 'Bubur Manado Tinutuan',
                'category' => 'tinggi serat',
                'description' => 'Bubur Manado atau tinutuan adalah bubur khas Sulawesi Utara yang berisi berbagai sayuran seperti kangkung, bayam, jagung manis, labu kuning, ubi, dan daun kemangi. Semua bahan dimasak bersama hingga menjadi bubur yang kaya serat dan nutrisi. Tinutuan merupakan makanan sarapan tradisional yang sangat sehat karena mengandung aneka sayuran dalam satu hidangan. Disajikan dengan ikan asin goreng dan sambal. Sangat cocok sebagai menu sarapan bergizi dalam MBG.',
                'nutrition_info' => 'Kalori: 250 kkal | Protein: 8g | Karbohidrat: 42g | Lemak: 5g | Serat: 7g | Vitamin A: 6000 IU | Vitamin C: 30mg | Zat Besi: 3.5mg',
            ],
            [
                'title' => 'Tempe Mendoan',
                'category' => 'vegetarian',
                'description' => 'Tempe mendoan adalah olahan tempe khas Purwokerto yang dibalut adonan tepung tipis dan digoreng setengah matang sehingga masih lembek di dalam. Tempe diiris tipis memanjang dan dicelup adonan tepung berbumbu daun bawang kemudian digoreng cepat. Tempe mendoan mempertahankan kandungan protein dan probiotik dari fermentasi karena tidak digoreng terlalu lama. Teksturnya yang unik dan rasanya yang gurih menjadikannya cemilan vegetarian favorit dalam program MBG.',
                'nutrition_info' => 'Kalori: 240 kkal | Protein: 16g | Karbohidrat: 16g | Lemak: 12g | Serat: 4g | Kalsium: 110mg | Isoflavon: 28mg | Vitamin B2: 0.3mg',
            ],
            [
                'title' => 'Ikan Lele Goreng Sambal Tomat',
                'category' => 'murah bergizi',
                'description' => 'Ikan lele goreng sambal tomat merupakan menu murah bergizi yang menggunakan ikan lele yang dibudidayakan secara luas di Indonesia. Ikan lele digoreng garing kemudian disiram sambal tomat segar. Lele merupakan ikan air tawar yang sangat murah dan mudah dibudidayakan dengan kandungan protein yang tinggi. Sambal tomat memberikan vitamin C dan likopen sebagai antioksidan. Menu ini menjadi andalan lauk protein hewani ekonomis dalam program MBG desa dan kota.',
                'nutrition_info' => 'Kalori: 300 kkal | Protein: 22g | Karbohidrat: 8g | Lemak: 18g | Serat: 1g | Vitamin C: 20mg | Omega-3: 0.5g | Zat Besi: 2mg',
            ],
            [
                'title' => 'Sup Wortel Kentang Ayam',
                'category' => 'anak sekolah',
                'description' => 'Sup wortel kentang ayam adalah hidangan hangat yang menyehatkan dan sangat disukai anak-anak sekolah. Wortel dan kentang dipotong dadu kecil dan dimasak dalam kaldu ayam bersama potongan daging ayam, buncis, dan seledri. Kuah yang gurih dan hangat sangat menyenangkan terutama di pagi hari. Wortel kaya vitamin A untuk mata, kentang memberikan energi, dan ayam menyediakan protein. Menu ini mudah dimasak dalam jumlah besar untuk kantin sekolah program MBG.',
                'nutrition_info' => 'Kalori: 250 kkal | Protein: 16g | Karbohidrat: 28g | Lemak: 8g | Serat: 3g | Vitamin A: 5000 IU | Vitamin C: 18mg | Kalium: 400mg',
            ],
            [
                'title' => 'Asinan Sayur Jakarta',
                'category' => 'rendah gula',
                'description' => 'Asinan sayur Jakarta adalah makanan khas Betawi yang terdiri dari sayuran mentah dan rebus dalam kuah cuka pedas. Bahan-bahannya meliputi kol, tauge, mentimun, sawi asin, dan tahu goreng dengan kacang tanah goreng di atasnya. Kuah asam dari cuka tanpa gula membuat menu ini rendah gula namun kaya rasa. Sayuran mentah memberikan enzim aktif dan serat, sementara tahu dan kacang memberikan protein nabati. Sangat menyegarkan untuk program MBG.',
                'nutrition_info' => 'Kalori: 170 kkal | Protein: 8g | Karbohidrat: 14g | Gula: 3g | Lemak: 8g | Serat: 4g | Vitamin C: 25mg | Probiotik: dari fermentasi',
            ],
            [
                'title' => 'Dendeng Balado Padang',
                'category' => 'tinggi protein',
                'description' => 'Dendeng balado Padang adalah irisan tipis daging sapi yang dikeringkan dan digoreng kemudian disiram sambal balado pedas. Dendeng merupakan makanan awetan tradisional yang kaya protein dengan kadar air rendah sehingga tahan lama. Proses pengeringan mengkonsentrasikan protein dan mineral dalam daging. Sambal balado dari cabai merah besar memberikan vitamin C dan capsaicin. Menu ini bernilai protein sangat tinggi per gramnya dan cocok sebagai lauk premium program MBG.',
                'nutrition_info' => 'Kalori: 350 kkal | Protein: 40g | Karbohidrat: 8g | Lemak: 16g | Serat: 1g | Zat Besi: 6mg | Vitamin B12: 3mcg | Zinc: 6mg',
            ],
            [
                'title' => 'Siomay Bandung',
                'category' => 'tinggi protein',
                'description' => 'Siomay Bandung adalah dimsum khas Indonesia yang terbuat dari daging ikan tenggiri yang dihaluskan dan dibungkus kulit pangsit kemudian dikukus. Disajikan dengan kentang rebus, tahu, kol, telur rebus, dan pare yang disiram bumbu kacang encer. Ikan tenggiri memberikan protein berkualitas tinggi, sementara sayuran pelengkap memberikan vitamin dan serat. Siomay sangat populer sebagai jajanan sehat yang mengenyangkan dan cocok untuk program MBG.',
                'nutrition_info' => 'Kalori: 320 kkal | Protein: 22g | Karbohidrat: 25g | Lemak: 14g | Serat: 3g | Omega-3: 0.7g | Kalsium: 80mg | Vitamin C: 15mg',
            ],
            [
                'title' => 'Nasi Bakar Isi Ayam Jamur',
                'category' => 'anak sekolah',
                'description' => 'Nasi bakar isi ayam jamur adalah nasi yang dicampur dengan suwiran ayam dan jamur kemudian dibungkus daun pisang dan dipanggang. Proses pemanggangan memberikan aroma daun pisang yang harum dan membuat nasi sedikit kecokelatan di bagian luar. Ayam dan jamur memberikan protein dari dua sumber berbeda. Menu ini sangat menarik untuk anak sekolah karena kemasannya yang unik dalam daun pisang. Cocok sebagai variasi menu makan siang program MBG.',
                'nutrition_info' => 'Kalori: 380 kkal | Protein: 18g | Karbohidrat: 50g | Lemak: 10g | Serat: 2g | Vitamin B3: 5mg | Selenium: 15mcg | Zinc: 2.5mg',
            ],
            [
                'title' => 'Sayur Nangka Muda (Gudeg Kering)',
                'category' => 'murah bergizi',
                'description' => 'Sayur nangka muda atau gudeg kering adalah masakan dari buah nangka yang masih muda dimasak dengan santan dan bumbu rempah hingga bumbu meresap. Nangka muda kaya serat, kalium, dan vitamin C. Harga nangka muda sangat murah terutama di daerah pedesaan karena pohon nangka tumbuh subur di mana-mana. Dimasak kering tanpa banyak kuah sehingga lebih awet. Menu ini merupakan alternatif lauk sayuran yang sangat ekonomis untuk program MBG.',
                'nutrition_info' => 'Kalori: 180 kkal | Protein: 4g | Karbohidrat: 24g | Lemak: 8g | Serat: 5g | Vitamin C: 15mg | Kalium: 280mg | Vitamin B6: 0.3mg',
            ],
            [
                'title' => 'Telur Dadar Sayuran',
                'category' => 'murah bergizi',
                'description' => 'Telur dadar sayuran adalah menu sederhana yang menggabungkan telur dengan irisan wortel, daun bawang, dan sedikit kol halus. Telur dikocok bersama sayuran dan sedikit garam kemudian didadar tipis dengan minyak. Menu ini sangat cepat dimasak dan ekonomis karena telur merupakan sumber protein termurah. Sayuran yang ditambahkan memberikan vitamin A dari wortel dan vitamin C dari daun bawang. Sempurna sebagai lauk harian dalam program MBG.',
                'nutrition_info' => 'Kalori: 200 kkal | Protein: 12g | Karbohidrat: 4g | Lemak: 14g | Serat: 1g | Vitamin A: 2000 IU | Vitamin D: 2mcg | Selenium: 18mcg',
            ],
            [
                'title' => 'Pecel Sayur Madiun',
                'category' => 'vegetarian',
                'description' => 'Pecel sayur Madiun adalah hidangan vegetarian khas Jawa Timur dengan bumbu pecel yang khas dari kacang tanah goreng, cabai, kencur, jeruk limau, dan daun jeruk. Sayuran yang digunakan meliputi bayam, kangkung, kecambah, kacang panjang, dan kenikir yang direbus setengah matang. Bumbu pecel Madiun terkenal lebih pedas dan wangi dibanding daerah lain. Menu ini menyediakan protein nabati, serat tinggi, dan berbagai vitamin yang sempurna untuk MBG.',
                'nutrition_info' => 'Kalori: 350 kkal | Protein: 14g | Karbohidrat: 30g | Lemak: 18g | Serat: 7g | Vitamin A: 6500 IU | Vitamin C: 35mg | Zat Besi: 5mg',
            ],
            [
                'title' => 'Arem-Arem Isi Tempe',
                'category' => 'murah bergizi',
                'description' => 'Arem-arem isi tempe adalah lontong yang berisi tumisan tempe dan sayuran yang dibungkus daun pisang dan dikukus. Nasi dimasak dalam daun pisang bersama isian tempe yang ditumis dengan bumbu bawang, cabai, dan kecap. Arem-arem merupakan makanan tradisional yang praktis dibawa sebagai bekal. Tempe memberikan protein nabati, sementara nasi memberikan karbohidrat. Menu ini sangat ekonomis dan mudah diproduksi massal untuk program MBG di sekolah.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 10g | Karbohidrat: 42g | Lemak: 8g | Serat: 3g | Kalsium: 80mg | Zat Besi: 2mg | Vitamin B1: 0.2mg',
            ],
            [
                'title' => 'Tumis Tauge Tahu',
                'category' => 'rendah gula',
                'description' => 'Tumis tauge tahu adalah masakan sederhana rendah gula yang menggabungkan tauge atau kecambah kacang hijau dengan tahu putih yang dipotong kotak. Ditumis dengan bawang putih, kecap asin, dan sedikit minyak wijen. Tauge mengandung enzim aktif dan vitamin C yang tinggi karena dalam proses perkecambahan nutrisi meningkat drastis. Tahu memberikan protein nabati dan kalsium. Menu ini sangat rendah gula dan rendah kalori cocok untuk MBG yang sehat.',
                'nutrition_info' => 'Kalori: 160 kkal | Protein: 12g | Karbohidrat: 8g | Gula: 1g | Lemak: 8g | Serat: 3g | Vitamin C: 20mg | Kalsium: 180mg',
            ],
            [
                'title' => 'Cah Kangkung Bawang',
                'category' => 'rendah gula',
                'description' => 'Cah kangkung bawang adalah tumisan kangkung ala Chinese-Indonesian yang dimasak dengan bawang putih, bawang bombay, dan saus tiram tanpa gula tambahan. Kangkung yang segar ditumis cepat dengan api besar agar tetap hijau dan renyah. Kangkung terkenal kaya zat besi yang penting untuk mencegah anemia pada anak. Teknik cah mempertahankan warna, tekstur, dan nutrisi sayuran. Menu rendah gula dan rendah kalori ini ideal sebagai pendamping protein dalam MBG.',
                'nutrition_info' => 'Kalori: 80 kkal | Protein: 4g | Karbohidrat: 5g | Gula: 1g | Lemak: 4g | Serat: 3g | Zat Besi: 3.5mg | Vitamin A: 4500 IU | Vitamin C: 18mg',
            ],
            [
                'title' => 'Sop Buntut Sapi',
                'category' => 'tinggi protein',
                'description' => 'Sop buntut sapi merupakan hidangan premium Indonesia dengan kuah kaldu bening yang sangat kaya kolagen dan protein. Buntut sapi yang berisi daging dan tulang rawan dimasak lama hingga empuk dalam kaldu dengan wortel, kentang, tomat, dan seledri. Kolagen dari tulang rawan sangat baik untuk kesehatan sendi dan kulit. Kuah kaldu yang kental mengandung mineral dari tulang. Menu ini dapat dijadikan menu istimewa pada hari-hari tertentu dalam program MBG.',
                'nutrition_info' => 'Kalori: 400 kkal | Protein: 30g | Karbohidrat: 15g | Lemak: 22g | Kolagen: 5g | Serat: 2g | Kalsium: 60mg | Zat Besi: 4mg',
            ],
            [
                'title' => 'Terong Balado',
                'category' => 'rendah gula',
                'description' => 'Terong balado adalah hidangan sayuran rendah gula yang menggunakan terong ungu goreng disiram sambal balado pedas. Terong kaya serat larut dan antioksidan nasunin yang memberikan warna ungu khas. Sambal balado dari cabai merah, bawang, dan tomat memberikan vitamin C tanpa gula tambahan. Menu ini rendah kalori dan rendah gula sehingga aman dikonsumsi semua kalangan. Terong harganya murah dan tersedia di seluruh pasar tradisional Indonesia.',
                'nutrition_info' => 'Kalori: 130 kkal | Protein: 3g | Karbohidrat: 12g | Gula: 3g | Lemak: 8g | Serat: 4g | Nasunin: 20mg | Vitamin C: 15mg | Kalium: 250mg',
            ],
            [
                'title' => 'Klepon Pandan',
                'category' => 'anak sekolah',
                'description' => 'Klepon pandan adalah jajanan tradisional dari tepung ketan yang diberi pewarna hijau dari daun suji dan diisi gula merah lumer kemudian direbus dan digulingkan di parutan kelapa. Klepon menjadi cemilan favorit anak sekolah karena sensasi gula merah yang meleleh di mulut. Tepung ketan memberikan karbohidrat dan energi, gula merah memberikan mineral alami, dan kelapa parut memberikan lemak MCT. Menu ini cocok sebagai snack tradisional dalam program MBG.',
                'nutrition_info' => 'Kalori: 180 kkal | Protein: 2g | Karbohidrat: 32g | Lemak: 5g | Serat: 2g | Zat Besi: 1.5mg | Mangan: 0.4mg | Kalium: 120mg',
            ],
            [
                'title' => 'Ikan Mas Arsik Batak',
                'category' => 'tinggi protein',
                'description' => 'Ikan mas arsik adalah masakan khas Batak Toba yang menggunakan ikan mas segar dimasak dengan bumbu andaliman, kunyit, lengkuas, dan kemiri. Andaliman atau merica Batak memberikan sensasi getir yang unik dan aroma khas. Ikan mas merupakan ikan air tawar yang dibudidayakan luas dan kaya protein. Arsik dimasak tanpa santan sehingga lebih rendah lemak. Menu ini memperkenalkan keanekaragaman kuliner nusantara dalam program MBG.',
                'nutrition_info' => 'Kalori: 280 kkal | Protein: 28g | Karbohidrat: 6g | Lemak: 14g | Omega-3: 0.6g | Serat: 1g | Fosfor: 250mg | Vitamin D: 3mcg',
            ],
            [
                'title' => 'Nasi Liwet Solo',
                'category' => 'murah bergizi',
                'description' => 'Nasi liwet Solo adalah nasi yang dimasak dengan santan, kaldu ayam, salam, serai, dan lengkuas hingga pulen dan beraroma harum. Disajikan dengan lauk telur pindang, ayam suwir, dan sayur labu siam. Nasi liwet sangat gurih dan mengenyangkan dengan biaya bahan baku yang terjangkau. Menu ini merupakan makanan khas Solo yang dapat dinikmati semua kalangan. Penyajian dalam porsi komunal tradisional meningkatkan kebersamaan dalam program MBG.',
                'nutrition_info' => 'Kalori: 430 kkal | Protein: 14g | Karbohidrat: 52g | Lemak: 16g | Serat: 2g | Vitamin A: 1000 IU | Kalsium: 60mg | Zat Besi: 2mg',
            ],
            [
                'title' => 'Edamame Rebus',
                'category' => 'tinggi protein',
                'description' => 'Edamame rebus merupakan kacang kedelai muda yang direbus dalam air garam dan disajikan dalam kulitnya. Edamame sangat populer sebagai cemilan sehat di Jepang dan semakin digemari di Indonesia. Kacang kedelai muda mengandung protein nabati lengkap dengan semua asam amino esensial. Selain itu edamame kaya isoflavon, serat, vitamin K, dan folat. Menu cemilan ini sangat cocok untuk program MBG sebagai sumber protein nabati yang menarik dan lezat.',
                'nutrition_info' => 'Kalori: 190 kkal | Protein: 17g | Karbohidrat: 12g | Lemak: 8g | Serat: 5g | Isoflavon: 45mg | Folat: 130mcg | Vitamin K: 30mcg',
            ],
            [
                'title' => 'Lempah Kuning Bangka',
                'category' => 'murah bergizi',
                'description' => 'Lempah kuning adalah masakan khas Bangka Belitung berupa sayuran berkuah kuning dari kunyit dan nanas. Bahan yang digunakan meliputi terong, nangka muda, atau ikan yang dimasak dalam kuah asam segar dari nanas dan bumbu kuning. Nanas memberikan enzim bromelain yang membantu pencernaan protein. Menu ini sangat segar dengan rasa asam pedas yang khas. Bahan-bahan yang murah dan melimpah di daerah tropis menjadikannya cocok untuk program MBG.',
                'nutrition_info' => 'Kalori: 150 kkal | Protein: 5g | Karbohidrat: 18g | Lemak: 6g | Serat: 3g | Vitamin C: 35mg | Bromelain: aktif | Kurkumin: 30mg',
            ],
            [
                'title' => 'Nasi Putih Lauk Ikan Asin Sambal',
                'category' => 'murah bergizi',
                'description' => 'Nasi putih dengan lauk ikan asin dan sambal merupakan menu paling sederhana namun bergizi yang menjadi makanan sehari-hari masyarakat Indonesia. Ikan asin yang digoreng kering memberikan protein hewani terkonsentrasi dan mineral dari garam laut. Sambal terasi yang pedas meningkatkan nafsu makan dan memberikan vitamin C dari cabai. Meskipun sederhana, menu ini menyediakan karbohidrat, protein, dan micronutrient dasar. Sangat murah untuk program MBG.',
                'nutrition_info' => 'Kalori: 380 kkal | Protein: 16g | Karbohidrat: 55g | Lemak: 10g | Serat: 1g | Natrium: 800mg | Kalsium: 100mg | Zat Besi: 2mg',
            ],
            [
                'title' => 'Smoothie Bowl Buah Naga',
                'category' => 'rendah gula',
                'description' => 'Smoothie bowl buah naga adalah menu modern rendah gula yang dibuat dari buah naga merah yang diblender dengan sedikit yogurt plain tanpa gula. Buah naga kaya antioksidan betalain yang memberikan warna merah terang. Disajikan dengan topping granola, chia seed, dan irisan buah segar. Buah naga memiliki kandungan gula alami yang rendah dibanding buah lain. Menu ini kaya vitamin C, serat, dan antioksidan yang sangat baik untuk kesehatan dalam program MBG.',
                'nutrition_info' => 'Kalori: 200 kkal | Protein: 6g | Karbohidrat: 32g | Gula: 8g | Lemak: 5g | Serat: 5g | Vitamin C: 50mg | Betalain: 30mg | Omega-3: 1g (chia)',
            ],
            [
                'title' => 'Sup Ayam Jahe',
                'category' => 'anak sekolah',
                'description' => 'Sup ayam jahe adalah hidangan hangat yang sangat cocok untuk anak-anak sekolah terutama saat cuaca dingin atau hujan. Potongan ayam dimasak dalam kuah kaldu dengan jahe segar, wortel, kentang, dan daun bawang. Jahe memiliki khasiat menghangatkan tubuh dan meredakan gejala flu. Kuah yang gurih dan hangat meningkatkan nafsu makan anak. Menu ini kaya protein dari ayam dan vitamin dari sayuran. Sangat mudah dimasak dalam jumlah besar untuk kantin sekolah MBG.',
                'nutrition_info' => 'Kalori: 260 kkal | Protein: 20g | Karbohidrat: 22g | Lemak: 8g | Serat: 2g | Gingerol: 10mg | Vitamin C: 12mg | Zinc: 2.5mg',
            ],
            [
                'title' => 'Tumpeng Mini Nasi Kuning',
                'category' => 'anak sekolah',
                'description' => 'Tumpeng mini nasi kuning adalah versi kecil dari tumpeng tradisional yang dibuat dalam porsi individual untuk anak sekolah. Nasi kuning dibentuk kerucut kecil dan dikelilingi lauk mini seperti ayam goreng, telur puyuh, perkedel, dan irisan mentimun. Tumpeng memiliki makna budaya kebersamaan dan syukur dalam tradisi Jawa. Penyajian yang menarik dan penuh warna membuat anak-anak antusias makan. Sangat cocok untuk menu spesial program MBG.',
                'nutrition_info' => 'Kalori: 450 kkal | Protein: 18g | Karbohidrat: 52g | Lemak: 16g | Serat: 3g | Vitamin A: 2500 IU | Kurkumin: 40mg | Zat Besi: 3mg',
            ],
            [
                'title' => 'Sambal Tempe Kering',
                'category' => 'vegetarian',
                'description' => 'Sambal tempe kering adalah lauk vegetarian yang terbuat dari tempe yang diiris kecil dan dimasak kering dengan sambal cabai, bawang merah, bawang putih, gula merah, dan kecap. Tempe digoreng kering terlebih dahulu kemudian dicampur dengan bumbu sambal hingga kering dan meresap. Menu ini sangat awet dan bisa disimpan beberapa hari. Tempe memberikan protein nabati dan probiotik dari fermentasi. Cocok sebagai lauk pendamping nasi dalam program MBG.',
                'nutrition_info' => 'Kalori: 260 kkal | Protein: 14g | Karbohidrat: 18g | Lemak: 14g | Serat: 4g | Isoflavon: 30mg | Zat Besi: 3mg | Vitamin B2: 0.3mg',
            ],
        ];
    }
}
