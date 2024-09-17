<?php

namespace Database\Seeders;

class BobinaBankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Cria uma empresa/filial
        $office = static::$ROOT_USER->createdOffices()->create([
            'name' => 'Minha Empresa',
            'description' => 'This is a business for many peoples!',
        ]);

        // Cria alguns armazenamentos relacionados a empresa/filial
        $office->holdedAccounts()->create([
            'name' => 'Depósito Central',
            'creator_user_id' => static::$ROOT_USER->id,
        ]);
        $office->holdedAccounts()->create([
            'name' => 'Depósito Sul',
            'creator_user_id' => static::$ROOT_USER->id,
        ]);
        $office->holdedAccounts()->create([
            'name' => 'Depósito Norte',
            'creator_user_id' => static::$ROOT_USER->id,
        ]);

        // Cria os Tipos de Transações
        static::$ROOT_USER->createdTransactionTypes()->create([
            'name' => 'Recebimento',
            'description' => 'Lancamento para quando um novo pedido é recebido do fornecedor!',
            'origin' => 0,
            'destin' => 1,
        ]);
        static::$ROOT_USER->createdTransactionTypes()->create([
            'name' => 'Transferência',
            'description' => 'Registra tranferências entre armazéns!',
            'origin' => -1,
            'destin' => 1,
        ]);
        static::$ROOT_USER->createdTransactionTypes()->create([
            'name' => 'Utilização',
            'description' => 'Registra o uso de bobinas para controle da quantidade de impressões!',
            'origin' => -1,
            'destin' => 0,
        ]);

    }
}
