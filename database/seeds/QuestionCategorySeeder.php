<?php

use Illuminate\Database\Seeder;
use NpTS\Domain\HelpDesk\Models\QuestionCategory;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Financeiro',
            'Suporte',
            'Vendas'
        ];
        foreach($categories as $category)
        {
            QuestionCategory::create([
                'name' => $category
            ]);
        }
    }
}
