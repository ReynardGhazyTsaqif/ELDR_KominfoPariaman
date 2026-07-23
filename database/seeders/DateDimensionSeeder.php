<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DateDimensionSeeder extends Seeder
{
    public function run(): void
    {
        $sqlPath = base_path('PENJELASAN/D_DATE.sql');

        if (!File::exists($sqlPath)) {
            $this->command->warn("File D_DATE.sql tidak ditemukan di {$sqlPath}");
            return;
        }

        $sql = File::get($sqlPath);

        // Hanya jalankan statement INSERT jika d_date masih kosong
        if (DB::table('d_date')->count() === 0) {
            // Filter pernyataan INSERT INTO d_date
            preg_match_all('/INSERT INTO d_date.*?;/s', $sql, $matches);

            foreach ($matches[0] as $query) {
                DB::unprepared($query);
            }
        }
    }
}
