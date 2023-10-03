<?php

namespace Database\Seeders;

use App\Models\FinancialCenter;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $costCenters = [
            'Aluguel ou Prestação da Casa',
            'Água e Esgoto',
            'Alimentação',
            'Assinaturas (TV, Internet, etc.)',
            'Contas de Energia Elétrica',
            'Condomínio',
            'Educação (Mensalidades Escolares, Material Escolar)',
            'Impostos e Taxas',
            'Lazer e Entretenimento',
            'Medicamentos e Saúde',
            'Moradia (Manutenção, Reformas, etc.)',
            'Seguro (Seguro de Saúde, Seguro de Carro, etc.)',
            'Transporte (Gasolina, Transporte Público, Manutenção do Veículo)',
            'Vestuário e Acessórios',
            'Viagens',
            'Outras Despesas',
        ];
        foreach ($costCenters as $costCenter) {
            DB::table('financial_centers')->insert([
                'type' => 'debit',
                'financial_center_name' => $costCenter,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $origins = [
            'Aposentadoria',
            'Aluguel',
            'Ações',
            'Atividade Rural',
            'Bônus',
            'Cônjuge',
            'Dependente',
            'Diárias',
            'Empreendimento',
            'Fundo de Investimento',
            'Ganho de Capital',
            'Imóveis',
            'Investimento',
            'Juros sobre Capital Próprio',
            'Outras Fontes',
            'Pensão Alimentícia',
            'Prêmios',
            'Rendimentos de Trabalho',
            'Rendimentos Isentos',
            'Rendimentos Sujeitos à Tributação Exclusiva',
            'Salário',
            'Sócio ou Acionista',
            'Venda de Bens',
        ];

        foreach ($origins as $origin) {
            DB::table('financial_centers')->insert([
                'type' => 'credit',
                'financial_center_name' => $origin,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
