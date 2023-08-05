<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createFakeTasks(1, 1);
        $this->createFakeTasks(2, 2, 4);
        $this->createFakeTasks(3, 3, 3);
        $this->createFakeTasks(4, 4, 1);
    }

    private function createFakeTasks(int $user_id, int $company_id, int $cont = 5)
    {
        $user = User::find($user_id);
        $company = Company::find($company_id);

        if ($user && $company)
            Task::factory($cont)->conExpiracion(5)->create([
                'user_id' => $user_id,
                'company_id' => $company_id
            ]);
    }
}
