<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalRecord;
use App\Models\Movement;
use App\Models\User;

class RankingController extends Controller
{
    public function getRanking($movement_id)
    {
        // Verifica se o movimento existe
        $movement = Movement::find($movement_id);
        if (!$movement) {
            return response()->json(['error' => 'Movimento não encontrado'], 404);
        }

        // Consulta os recordes pessoais (pegando o maior valor para cada usuário)
        $records = PersonalRecord::selectRaw('user_id, MAX(value) as max_value, MAX(date) as record_date')
            ->where('movement_id', $movement_id)
            ->groupBy('user_id')
            ->orderByDesc('max_value') // Ordena primeiro pelo maior recorde
            ->orderBy('record_date')   // Em caso de empate, ordena pela data do recorde
            ->get();

        // Definição do ranking (usuários com o mesmo recorde têm a mesma posição)
        $ranking = [];
        $last_value = null;
        $position = 0;
        $count = 0; // Contador de usuários processados

        //dd($records->toArray());


        foreach ($records as $record) {
            
            // A posição só é incrementada se o recorde for diferente do anterior
            if ($record->max_value !== $last_value) {
                $count++;
                $position = $count;
            }

            $user = User::find($record->user_id);

            $ranking[] = [
                'position' => $position,
                'user' => $user->name,
                'record' => $record->max_value,
                'date' => $record->record_date,
            ];

            $last_value = $record->max_value; // Atualiza o último recorde processado
        }

        return response()->json([
            'movement' => $movement->name,
            'ranking' => $ranking
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
