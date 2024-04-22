<?php

namespace App\Http\Controllers;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function editPicture()
    {
        $pictures = Picture::all();
        return view("picture/edit")->with("pictures",$pictures);
    }

    public function update($id){
        $picture = Picture::find($id);
        return view("picture/update")->with("picture",$picture);
    }
    public function updatePicture( $request, $id)
    {
        $update = Picture::find($id);
        $update->images = $request->input('images');
        $update->save();

        return redirect("carousel/view");
    }
//     public function editPicture()
//     {
//         $pictures = Picture::all();
//         return view("picture/edit")->with("pictures",$pictures);
//     }
//     // ajout de la methode
//     public function create(){
//         $pictures = Picture::all();
//         return view("picture/create")->with("pictures",$pictures);
//     }
//     public function createPicture(Request $request)
// {
//     // Créer une nouvelle instance de Picture avec les données de la requête
//     $picture = new Picture($request->all());

//     // Gérer le téléchargement de l'image si elle est présente dans la requête
//     if ($request->hasFile('image')) {
//         $image = $request->file('image');
//         $imageName = $image->getClientOriginalName();
//         $image->move(public_path('images'), $imageName);
//         $picture->images = $imageName; // Utiliser le bon nom de colonne
//     } else {
//         $picture->images = ""; // ou la valeur par défaut que vous avez définie
//     }

//     // Enregistrer l'enregistrement Picture dans la base de données
//     $picture->save();

//     // Rediriger l'utilisateur vers une autre page
//     return redirect("picture/edit");
// }


    // public function update($id){
    //     $category = Category::find($id);
    //     return view("category/update")->with("category",$category);
    // }
    // public function updateCategory(CategoryRequest $request, $id)
    // {
    //     $update = Category::find($id);
    //     $update->name = $request->input('name');
    //     $update->description = $request->input('description');
    //     $update->save();

    //     return redirect("category/edit");
    // }
    // public function destroyCategory($id)
    // {
    //     $delete = Category::find($id);
    //     $delete->delete($id);
    //     return redirect("/category/edit");
    // }
}
