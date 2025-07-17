<?php

namespace App\Http\Controllers;

use App\Models\HighScore;
use Illuminate\Http\Request;

class TetrisController extends Controller
{
    public function index()
    {
        $topScores = HighScore::where('type', 'top')->orderBy('score', 'desc')->take(3)->get();
        $recentScores = HighScore::where('type', 'recent')->orderBy('created_at', 'desc')->take(2)->get();
        return view('tetris', [
            'topScores' => $topScores,
            'recentScores' => $recentScores
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'score' => 'required|integer|min:0',
        ]);

        // Handle top scores
        $topScoresCount = HighScore::where('type', 'top')->count();
        $lowestTopScore = HighScore::where('type', 'top')->orderBy('score', 'asc')->first();

        if ($topScoresCount < 3 || ($lowestTopScore && $request->score > $lowestTopScore->score)) {
            // If there's space in top 3 or new score is higher than lowest top score
            HighScore::create([
                'name' => $request->name,
                'score' => $request->score,
                'type' => 'top',
            ]);
            $this->trimTopScores();
        } else {
            // If not a top score, save as recent
            HighScore::create([
                'name' => $request->name,
                'score' => $request->score,
                'type' => 'recent',
            ]);
            $this->trimRecentScores();
        }

        return response()->json(['message' => 'Score saved successfully!']);
    }

    private function trimTopScores()
    {
        $scores = HighScore::where('type', 'top')->orderBy('score', 'desc')->get();
        if ($scores->count() > 3) {
            $scores->slice(3)->each->delete();
        }
    }

    private function trimRecentScores()
    {
        $scores = HighScore::where('type', 'recent')->orderBy('created_at', 'desc')->get();
        if ($scores->count() > 2) {
            $scores->slice(2)->each->delete();
        }
    }
}
