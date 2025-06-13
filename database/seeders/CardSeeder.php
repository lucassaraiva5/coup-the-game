<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Carta Embaixador
        Card::create([
            'title' => 'ambassador',
            'description' => 'Recebe 2 cartas e devolve 2 cartas. Pode bloquear o capitão e não pode ser bloqueado.',
            'image' => 'images/ambassador.jpg'
        ]);

        // Carta Capitão
        Card::create([
            'title' => 'captain',
            'description' => 'Rouba 2 moedas de outro jogador e não pode ser roubado por outro capitão	',
            'image' => 'images/captain.jpg'
        ]);

        // Carta Duke
        Card::create([
            'title' => 'duke',
            'description' => 'Compra 3 moedas e pode bloquear ajuda externa	',
            'image' => 'images/duke.jpg'
        ]);

        // Carta Assassin
        Card::create([
            'title' => 'assassin',
            'description' => 'Assassinar: Pague 3 moedas. Escolha um oponente que perderá uma influencia. Pode ser bloqueado pela condessa.	',
            'image' => 'images/assassin.jpg'
        ]);

        // Carta Condessa
        Card::create([
            'title' => 'contessa',
            'description' => 'Bloqueia o assassino e não pode ser bloqueado.',
            'image' => 'images/contessa.jpg'
        ]);
    }
}
