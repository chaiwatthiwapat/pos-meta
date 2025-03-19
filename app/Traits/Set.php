<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait Set
{
    // @นามสกุลไฟล์
    public static function fileExt(?UploadedFile $file): string {
        return $file?->getClientOriginalExtension() ?? '';
    }

    // @ชื่อใหม่ไฟล์
    public static function newFileName(?UploadedFile $file): string {
        $ext = self::fileExt($file);
        $time = time();
        $uniqid = uniqid();
        return "{$uniqid}{$time}.{$ext}";
    }

    // @ตัวเลขเท่านั้น
    public static function number(?string $number): float {
        // ลบทุกตัวที่ไม่ใช่ตัวเลข ยกเว้นจุดทศนิยม
        $numberOnly = preg_replace('/[^0-9.]/', '', (string) $number);
    
        // ลบจุดทศนิยมตัวที่สองขึ้นไป ให้เหลือเพียงตัวเดียว
        $numberOnly = preg_replace('/\.(?=.*\.)/', '', $numberOnly);
    
        // แปลงเป็น float และปัดเศษให้มีทศนิยม 2 ตำแหน่ง
        return round((float)$numberOnly, 2);
    }

    // @กรองเอาตัวเลข & number_format
    public static function numberFormat(?string $number, int $decimal = 0): string {
        $numberOnly = self::Number($number);
        return !empty($numberOnly) ? number_format($numberOnly, $decimal) : '';
    }

    // @ตัด tag ออก เช่น (div | script | style)
    public static function string(?string $string): string {
        return $string ? htmlspecialchars(strip_tags($string), ENT_QUOTES, 'UTF-8') : '';
    }
}

