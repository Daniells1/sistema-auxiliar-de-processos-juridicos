<?php

namespace App\Helpers;

class Helper{

    public static function formatNumber($value = "", $decimal = 2, $decimalSeparator = ",", $thousands = "."){
        if($value == "" || $value == null || !is_numeric($value)) return "R$ 0.00";

        return "R$ " . number_format($value, $decimal, $decimalSeparator, $thousands);

    }

    public static function formatDate($date, $formatIn = "Y-m-d", $formatOut = "d/m/Y"){
        if($date == "" || $date == null) return  null;

        try{
            $dt = \Carbon\Carbon::createFromFormat($formatIn, $date);
            return $dt->format($formatOut);


        }catch(\Exception $e){
            \Log::error("Erro Helper formatDate", [ $e->getMessage()]);
            return "";

        }
    }
}