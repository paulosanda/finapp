<?php

namespace Database\Seeders;

use App\Models\CostCenter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $costCenters = [
            'Alimentação',
            'Assinaturas',
            'Beleza',
            'Contas de Consumo (água, luz, internet, tv a cabo, etc)',
            'Cuidados com animais de estimação',
            'Dívidas/Empréstimos',
            'Doações',
            'Educação',
            'Impostos',
            'Investimentos',
            'Lazer',
            'Moradia',
            'Saúde',
            'Seguros',
            'Transporte',
            'Viagens'
        ];
        foreach ($costCenters as $costCenter) {
           DB::table('cost_centers')->insert([
               'cost_center_name' => $costCenter
           ]);
        }
    }
}
