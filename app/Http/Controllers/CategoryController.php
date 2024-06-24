<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

/**
 * Contrôleur pour la gestion des catégories.(Super_admin)
 */
class CategoryController extends Controller
{
    /**
     * Affiche le formulaire d'édition des catégories.
     *
     * @return \Illuminate\Contracts\View\View Vue avec les catégories chargées depuis la base de données.
     */
    public function editCategory()
    {
        $categories = Category::all();
        return view("category/edit")->with("categories", $categories);
    }

    /**
     * Affiche le formulaire de création d'une nouvelle catégorie.
     *
     * @return \Illuminate\Contracts\View\View Vue avec les catégories chargées depuis la base de données.
     */
    public function create()
    {
        $categories = Category::all();
        return view("category/create")->with("categories", $categories);
    }

    /**
     * Crée une nouvelle catégorie à partir des données soumises dans le formulaire.
     *
     * @param  CategoryRequest  $request Les données validées du formulaire de création de catégorie.
     * @return \Illuminate\Http\RedirectResponse Redirection vers la liste des catégories après création.
     */
    public function createCategory(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        return redirect("category/edit");
    }

    /**
     * Affiche le formulaire de mise à jour d'une catégorie spécifique.
     *
     * @param  int  $id L'identifiant de la catégorie à mettre à jour.
     * @return \Illuminate\Contracts\View\View Vue avec la catégorie à mettre à jour.
     */
    public function update($id)
    {
        $category = Category::find($id);
        return view("category/update")->with("category", $category);
    }

    /**
     * Met à jour les informations d'une catégorie spécifique avec les données soumises dans le formulaire.
     *
     * @param  CategoryRequest  $request Les données validées du formulaire de mise à jour de catégorie.
     * @param  int  $id L'identifiant de la catégorie à mettre à jour.
     * @return \Illuminate\Http\RedirectResponse Redirection vers la liste des catégories après mise à jour.
     */
    public function updateCategory(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        return redirect("category/edit");
    }

    /**
     * Supprime une catégorie spécifique de la base de données.
     *
     * @param  int  $id L'identifiant de la catégorie à supprimer.
     * @return \Illuminate\Http\RedirectResponse Redirection vers la liste des catégories après suppression.
     */
    public function destroyCategory($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect("/category/edit");
    }
}
