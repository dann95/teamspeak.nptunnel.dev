<?php

use Illuminate\Database\Seeder;

use NpTS\Domain\Client\Models\InvoiceStatus;

class InvoiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'Cancelado',
            'Aguardando Pagamento',
            'Pagamento Confirmado',
            'Serviço Entregue'
        ];

        for($i = 0; $i <= count($status)-1; $i++)
        {
            InvoiceStatus::create([
                'id' => $i,
                'status' => $status[$i]
            ])->save();
        }
    }
}
