<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AIController extends Controller
{
    public function refreshKnowledge()
    {
        $components = [
            'site/about',
            'site/resume',
            'site/skills',
            'site/portfolio',
            'site/hero',
            'site/services',
            'site/engineering',
            'site/financial-analysis',
            'site/games',
            'site/contact',
        ];

        $knowledge = "";
        $errors = [];

        foreach ($components as $component) {
            $path = resource_path('views/components/' . $component . '.blade.php');

            if (!File::exists($path)) {
                $errors[] = "Archivo no encontrado: " . $path;
                continue;
            }

            $content = File::get($path);
            
            $cleanedContent = strip_tags($content);
            $cleanedContent = preg_replace('/\s+/s', ' ', $cleanedContent);
            $cleanedContent = trim($cleanedContent);

            $componentName = str_replace('site/', '', $component);
            $knowledge .= "--- Seccion: " . ucfirst($componentName) . " ---
";
            $knowledge .= $cleanedContent . "\n\n";
        }

        if (!empty($errors)) {
            return response("Errores encontrados:\n" . implode("\n", $errors), 500)
                   ->header('Content-Type', 'text/plain');
        }

        Storage::disk('local')->put('knowledge_base.txt', $knowledge);

        return response('Base de conocimiento de la IA actualizada exitosamente. Se han procesado ' . count($components) . ' secciones.', 200)
               ->header('Content-Type', 'text/plain');
    }

    /**
     * Handles the chat request from the user.
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $userMessage = $request->input('message');

        // --- SIMULATED AI RESPONSE ---
        // In a real application, you would read the knowledge base,
        // construct a prompt, and call an external AI API here.
        
        // $knowledge = Storage::disk('local')->get('knowledge_base.txt');
        // $prompt = "Based on the following information about Héctor Mota:\n\n{$knowledge}\n\nAnswer this question: {$userMessage}";
        // $reply = // Call to OpenAI, Gemini, etc. with the prompt

        $reply = "Respuesta simulada a tu pregunta: '" . $userMessage . "'. Para una respuesta real, conecta este controlador a una API de IA.";

        return response()->json(['reply' => $reply]);
    }
}
