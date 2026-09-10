<?php
// data/transaksi/city_coords.php
// Koordinat approx (pusat kota/kabupaten) untuk kota-kota yang paling sering muncul di data transaksi
// (semua 38 nilai KOTA ASAL + kota-kota besar yang biasa masuk top KOTA TUJUAN).
// Sumber: titik pusat kota/kabupaten publik, presisi cukup untuk visualisasi sebaran (bukan alamat persis).
// Kota yang tidak ada di sini otomatis fallback ke pusat provinsi (lihat trx_city_to_coords()).

return [
    // === Sumatera ===
    'BANDA ACEH' => [5.5483, 95.3238], 'BANDAACEH' => [5.5483, 95.3238],
    'MEDAN' => [3.5952, 98.6722],
    'PEKANBARU' => [0.5333, 101.4500],
    'PADANG' => [-0.9471, 100.4172],
    'JAMBI' => [-1.6101, 103.6131],
    'PALEMBANG' => [-2.9761, 104.7754],
    'BENGKULU' => [-3.7928, 102.2608],
    'BANDARLAMPUNG' => [-5.4292, 105.2610], 'BANDAR LAMPUNG' => [-5.4292, 105.2610],
    'PANGKAL PINANG' => [-2.1316, 106.1169],
    'BATAM' => [1.0456, 104.0305],
    'LUBUK PAKAM,KAB.DELI SERDANG' => [3.5578, 98.8778],
    'JATI AGUNG, KAB.LAMPUNG SEL' => [-5.2333, 105.3667],

    // === Jawa ===
    'JAKARTA' => [-6.2088, 106.8456],
    'BOGOR' => [-6.5971, 106.8060],
    'DEPOK' => [-6.4025, 106.7942],
    'TANGERANG' => [-6.1783, 106.6319],
    'BEKASI' => [-6.2383, 106.9756],
    'KARAWANG' => [-6.3227, 107.3376],
    'CIKAMPEK,KARAWANG' => [-6.4167, 107.4500],
    'CIKARANG,KAB.BEKASI' => [-6.2650, 107.1500],
    'BANDUNG' => [-6.9175, 107.6191],
    'GARUT, KAB. GARUT' => [-7.2103, 107.9081],
    'CIREBON' => [-6.7063, 108.5570],
    'TEGAL' => [-6.8694, 109.1402],
    'SLAWI,KAB.TEGAL' => [-6.9614, 109.1381],
    'SEMARANG' => [-6.9667, 110.4167],
    'UNGARAN' => [-7.1333, 110.4083],
    'DEMAK' => [-6.8944, 110.6386],
    'KEBUMEN' => [-7.6725, 109.6533],
    'YOGYAKARTA' => [-7.7956, 110.3695],
    'SUKOHARJO' => [-7.6890, 110.8360],
    'SURABAYA' => [-7.2575, 112.7521],
    'MALANG' => [-7.9666, 112.6326],
    'BATU' => [-7.8706, 112.5239],
    'SIDOARJO' => [-7.4478, 112.7183],
    'GRESIK,KAB.GRESIK' => [-7.1547, 112.6172],
    'KEDIRI' => [-7.8480, 112.0178],
    'JEMBER' => [-8.1725, 113.7003],
    'LAMONGAN,KAB.LAMONGAN' => [-7.1206, 112.4147],
    'MAGETAN, KAB MAGETAN' => [-7.6531, 111.3378],
    'INDRAMAYU' => [-6.3267, 108.3200],
    'SERANG' => [-6.1200, 106.1500],
    'CILEGON' => [-6.0025, 106.0111],

    // === Bali & Nusa Tenggara ===
    'DENPASAR' => [-8.6705, 115.2126],

    // === Kalimantan ===
    'BALIKPAPAN' => [-1.2379, 116.8529],
    'BANJARMASIN' => [-3.3186, 114.5944],
    'PONTIANAK' => [-0.0263, 109.3425],
    'SAMARINDA' => [-0.5022, 117.1536],
    'PALANGKA RAYA' => [-2.2161, 113.9135],

    // === Sulawesi ===
    'MAKASAR' => [-5.1477, 119.4327], 'MAKASSAR' => [-5.1477, 119.4327],
    'MANADO' => [1.4748, 124.8421],
    'PALU' => [-0.8917, 119.8707],
    'KENDARI' => [-3.9450, 122.4989],
    'GORONTALO' => [0.5412, 123.0595],
    'AMPANA KOTA,AMPANA' => [-0.8814, 121.5822],
    'AIRMADIDI,KAB.MINAHASA UTARA' => [1.4381, 124.9111],

    // === Maluku & Papua ===
    'AMBON' => [-3.6954, 128.1814],
    'JAYAPURA' => [-2.5337, 140.7181],
    'SORONG' => [-0.8762, 131.2558],
    'AIMAS,SORONG' => [-0.9333, 131.2833],
    'WAMENA,KAB.JAYAWIJAYA' => [-4.0847, 138.9500],
    'MANOKWARI' => [-0.8615, 134.0620],
    'LABUAN BAJO' => [-8.4963, 119.8886],
    'TIMIKA' => [-4.5461, 136.8873],
];
