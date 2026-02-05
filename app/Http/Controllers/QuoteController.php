<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function download(Project $project)
    {
        $project->load(['projectType.category', 'features', 'quote', 'platforms', 'user']);

        $pdf = Pdf::loadView('pdf.quote', compact('project'));

        return $pdf->download('Devis-' . $project->quote->reference . '.pdf');
    }
}
