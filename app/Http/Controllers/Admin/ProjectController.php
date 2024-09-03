<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Category;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('category', 'technologies')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        // Genera lo slug
        $slug = Str::slug($validated['name']);

        // Gestisci il caricamento dell'immagine
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Genera un nome unico per l'immagine
            $imagePath = $image->move(public_path('images'), $imageName); // Sposta l'immagine in public/images
            $imagePath = 'images/' . $imageName; // Salva solo il percorso relativo
        } else {
            $imagePath = null;
        }

        // Crea il progetto con i dati validati e il percorso dell'immagine
        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'slug' => $slug,
            'status' => $validated['status'],
            'category_id' => $validated['category_id'],
            'image_path' => $imagePath,
        ]);

        // Sincronizza le tecnologie selezionate
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->input('technologies'));
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('category', 'technologies')->firstOrFail();
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $validated = $request->validated();

        // Genera lo slug solo se il nome è cambiato
        $slug = Str::slug($validated['name']);

        // Gestisci il caricamento dell'immagine solo se è stata fornita una nuova immagine
        if ($request->hasFile('image')) {
            // Elimina l'immagine esistente, se presente
            if ($project->image_path) {
                $imagePath = public_path($project->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Usa unlink per eliminare il file
                }
            }

            // Carica la nuova immagine
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Genera un nome unico per l'immagine
            $imagePath = $image->move(public_path('images'), $imageName); // Sposta l'immagine in public/images
            $imagePath = 'images/' . $imageName; // Salva solo il percorso relativo
        } else {
            $imagePath = $project->image_path; // Mantieni l'immagine esistente se non viene caricata una nuova
        }

        // Aggiorna il progetto con i dati validati e il percorso dell'immagine
        $project->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'slug' => $slug,
            'status' => $validated['status'],
            'category_id' => $validated['category_id'],
            'image_path' => $imagePath,
        ]);

        // Sincronizza le tecnologie selezionate
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->input('technologies'));
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        // Elimina l'immagine associata, se presente
        if ($project->image_path) {
            $imagePath = public_path($project->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Usa unlink per eliminare il file
            }
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
