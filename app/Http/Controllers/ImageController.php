<?php

namespace App\Http\Controllers;

use App\Models\ChapterImage; // Alterado para usar o modelo correto
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Upload de novas imagens associadas a um capítulo.
     */
    public function upload(Request $request, Chapter $chapter)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Salvar a imagem no armazenamento
                $path = $image->store("mangas/{$chapter->manga_id}/chapters/{$chapter->id}", 'public');
    
                // Criar o registro no banco de dados
                $imageModel = $chapter->images()->create(['path' => $path]);
                $images[] = [
                    'id' => $imageModel->id,
                    'path' => $imageModel->path,
                ];
            }
        }
    
        return response()->json(['success' => true, 'images' => $images]);
    }
    
    

    /**
     * Deletar uma imagem de um capítulo.
     */
    public function destroy(ChapterImage $image) // Alterado para usar o modelo correto
    {
        // Deletar o arquivo físico
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        // Deletar o registro no banco de dados
        $image->delete();

        return back()->with('success', 'Imagem excluída com sucesso!');
    }
}
