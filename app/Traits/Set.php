<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

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

    public static function textLimit(string $text, int $limit = 100): ?string {
        if (empty($text)) {
            return null;
        }
    
        return Str::limit($text, $limit, '...');
    }

    // @date พศ.
    public static function dmyThai($GetDate): ?string {
        if (is_null($GetDate)) {
            return null; // คืนค่า null หากไม่มีวันที่
        }

        // ตรวจสอบรูปแบบวันที่ที่รองรับ
        $formats = [
            'Y-m-d H:i:s.u', // รูปแบบวันที่แบบเต็ม
            'Y-m-d H:i:s',   // รูปแบบวันที่ไม่มี microsecond
            'Y-m-d',         // รูปแบบวันที่ธรรมดา
        ];

        $DateTime = null;

        // แปลงวันที่ด้วยรูปแบบที่รองรับ
        foreach ($formats as $format) {
            $DateTime = \DateTime::createFromFormat($format, $GetDate);
            if ($DateTime) {
                break; // หากสำเร็จ ให้ออกจาก loop
            }
        }

        // คืนค่า null หากวันที่ไม่ตรงกับรูปแบบใดเลย
        if (!$DateTime) {
            return null;
        }

        // ดึงวัน เดือน ปี
        $Day = $DateTime->format('d');
        $Month = $DateTime->format('m');
        $Year = $DateTime->format('Y') + 543; // แปลงปี ค.ศ. เป็นปี พ.ศ.

        // รวมผลลัพธ์
        return "{$Day}/{$Month}/{$Year}";
    }
}

