<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\DocumentCategory;
use App\Models\ImageCategory;

class AdminLayoutComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $documentCategories = DocumentCategory::orderBy('name')->get();
        $imageCategories = ImageCategory::orderBy('name')->get();

        $view->with('documentCategories', $documentCategories)
             ->with('imageCategories', $imageCategories);
    }
}
