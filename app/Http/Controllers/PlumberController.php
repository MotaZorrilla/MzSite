<?php

namespace App\Http\Controllers;

use App\Models\PlumberHighScore; // Cambiado a nuestro nuevo modelo
use Illuminate\Http\Request;

class PlumberController extends Controller
{
    public function index()
    {
        $topScoreHard = PlumberHighScore::where('difficulty', 'hard')->orderBy('score', 'desc')->first();
        $topScoreNormal = PlumberHighScore::where('difficulty', 'normal')->orderBy('score', 'desc')->first();
        $topScoreEasy = PlumberHighScore::where('difficulty', 'easy')->orderBy('score', 'desc')->first();

        $topScores = [
            'hard' => $topScoreHard,
            'normal' => $topScoreNormal,
            'easy' => $topScoreEasy,
        ];

        foreach ($topScores as $difficulty => $score) {
            if (!$score) {
                $topScores[$difficulty] = (object)[
                    'name' => 'Mota Zorrilla',
                    'score' => 0,
                    'difficulty' => $difficulty,
                ];
            }
        }

        $recentScores = PlumberHighScore::orderBy('created_at', 'desc')->take(6)->get();

        return view('plumber', [
            'topScores' => $topScores,
            'recentScores' => $recentScores
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'score' => 'required|integer|min:0',
            'difficulty' => 'required|string',
            'time' => 'required|integer|min:0',
        ]);

        $data = [
            'name' => $request->name,
            'score' => $request->score,
            'difficulty' => $request->difficulty,
            'time' => $request->time,
        ];

        // Lógica para la tabla de Plumber
        $topScoresCount = PlumberHighScore::where('type', 'top')
            ->where('difficulty', $request->difficulty)
            ->count();
        $lowestTopScore = PlumberHighScore::where('type', 'top')
            ->where('difficulty', $request->difficulty)
            ->orderBy('score', 'asc')->first();

        if ($topScoresCount < 1 || ($lowestTopScore && $request->score > $lowestTopScore->score)) {
            PlumberHighScore::create(array_merge($data, ['type' => 'top']));
            $this->trimTopScores($request->difficulty);
        } else {
            PlumberHighScore::create(array_merge($data, ['type' => 'recent']));
            $this->trimRecentScores();
        }

        return response()->json(['message' => 'Score saved successfully!']);
    }

    private function trimTopScores($difficulty)
    {
        $scores = PlumberHighScore::where('type', 'top')
            ->where('difficulty', $difficulty)
            ->orderBy('score', 'desc')->get();
        if ($scores->count() > 1) {
            $scores->slice(1)->each->delete();
        }
    }

    private function trimRecentScores()
    {
        $scores = PlumberHighScore::where('type', 'recent')->orderBy('created_at', 'desc')->get();
        if ($scores->count() > 6) {
            $scores->slice(6)->each->delete();
        }
    }
}
