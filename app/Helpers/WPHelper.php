<?php

namespace App\Helpers;

class WPHelper
{
    public static function calculateWP($resellers, $weights)
    {
        $results = [];

        foreach ($resellers as $reseller) {
            $score = 1; // Inisialisasi skor WP

            foreach ($weights as $criteria => $weight) {
                $value = $reseller[$criteria];

                // Jika kriteria adalah cost, gunakan 1/nilai
                if ($criteria == 'harga_produk') {
                    $value = 1 / $value;
                }

                // Hitung nilai WP
                $score *= pow($value, $weight);
            }

            // Simpan hasil perhitungan
            $results[] = [
                'id_pemesanan' => $reseller['id_pemesanan'],
                'score' => $score
            ];
        }

        // Urutkan hasil berdasarkan skor tertinggi
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $results;
    }
}
