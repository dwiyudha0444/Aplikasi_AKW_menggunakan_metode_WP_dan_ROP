<?php

namespace App\Helpers;

class ROPHelper
{
    /**
     * Hitung Reorder Point (ROP) dengan validasi
     *
     * @param int $leadTime       Waktu tunggu (dalam hari)
     * @param int $dailyDemand    Permintaan harian rata-rata
     * @param int $safetyStock    Stok cadangan (opsional, default = 0)
     * @return int                Nilai Reorder Point
     */
    public static function calculateROP($leadTime, $dailyDemand, $safetyStock = 0)
    {
        // Validasi input
        if ($leadTime < 0 || $dailyDemand < 0 || $safetyStock < 0) {
            throw new \InvalidArgumentException("Nilai tidak boleh negatif.");
        }

        // Hitung ROP
        $rop = ($leadTime * $dailyDemand) + $safetyStock;

        return $rop;
    }
}