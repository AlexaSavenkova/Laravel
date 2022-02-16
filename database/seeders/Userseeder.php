<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [
            'name' => 'Администратор',
            'email' => 'admin@test',
            'password' => '$2y$10$2Qpu4hVgym5g2XusIzcE1OsSNFfep68XTMRvWY9rbsYMGIyr7ZhTy',
            'is_admin' => 1,
        ];
        return $data;
    }
}
