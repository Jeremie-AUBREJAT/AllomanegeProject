<?php

namespace App\Http\Controllers;
use App\Models\Carousel;
use App\Http\Requests\CarouselRequest;
use App\Models\Picture;
use App\Models\Category;
use App\Models\Quote;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function home()
    {
        $carousels = Carousel::with('category')->get();
        $categories = Category::all();
        return view('carousel.view', compact('carousels', 'categories'));
    }
    
    //Fonction pour afficher les carousels
    public function viewCarousel(){
        $carousels = Carousel::all();
        return view('view')->with("carousels", $carousels);
    }

    //Fonction pour afficher le formulaire de création d'un nouveau carousel
    public function viewCreateCarousel(){
        $categories = Category::all();
        return view('carousel.create')->with("categories", $categories);
    }

    //Fonction pour afficher le formulaire de modification d'un carousel
    public function viewUpdateForm($id)
    {
        $carousel = Carousel::find($id);
        $categories = Category::all();
        return view('carousel.update')->with(["carousel" => $carousel, "categories"=>$categories]);
    }

    //Fonction pour ajouter un nouveau carousel
    public function createCarousel(CarouselRequest $request)
    {
        // Créer une instance de Carousel
        // Créer une instance de Carousel et définir ses propriétés
        $carousel = new Carousel;
        $carousel->name = $request->input('name');
        $carousel->size = $request->input('size');
        $carousel->weight = $request->input('weight');
        $carousel->watt_power = $request->input('watt_power');
        $carousel->install_time = $request->input('install_time');
        $carousel->description = $request->input('description');
        $carousel->localization = $request->input('localization');
        $carousel->price = $request->input('price');
        
        // Enregistrer le Carousel
        $carousel->category_id = $request->input('category');
        $carousel->save();
        
        // ajout d'une ou plusieurs images 
        if ($request->hasFile('imageCreate')) {
            foreach ($request->file('imageCreate') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('imageCreate'), $imageName); // Déplacer l'image vers le répertoire public/images
        
                // Créer une Picture associée au Carousel créé pour chaque image
                $picture = new Picture();
                $picture->images = 'imageCreate/' . $imageName;
                $picture->carousel_id = $carousel->id; // Associer l'image au Carousel créé
                $picture->save();
            }
        }
        
        return redirect("/carousel/view");
    }

    //Fonction pour modifier un carousel sans modif des images
    // public function updateCarousel(CarouselRequest $request, $id){
    //     $carousel = new Carousel;
    //     $carousel->name = $request->input('name');
    //     $carousel->size = $request->input('size');
    //     $carousel->weight = $request->input('weight');
    //     $carousel->watt_power = $request->input('watt_power');
    //     $carousel->install_time = $request->input('install_time');
    //     $carousel->description = $request->input('description');
    //     $carousel->localization = $request->input('localization');
    //     $carousel->price = $request->input('price');
      
    //     $carousel->category_id = $request->input('category');
    //     $carousel->save();

        
        
    //     return redirect("carousel/view");
    // }

    // public function destroyCarousel($id){
    //     $carousel = Carousel::find($id);
    
    //     if ($carousel) {
    //         $carousel->delete();
    //     }
    
    //     return redirect("/carousel/view");
    // }
    public function updateCarousel(CarouselRequest $request, $id)
{
    // Récupérer le carousel à mettre à jour
    $carousel = Carousel::find($id);

    // Mettre à jour les autres champs du carousel
    $carousel->name = $request->input('name');
    $carousel->size = $request->input('size');
    $carousel->weight = $request->input('weight');
    $carousel->watt_power = $request->input('watt_power');
    $carousel->install_time = $request->input('install_time');
    $carousel->description = $request->input('description');
    $carousel->localization = $request->input('localization');
    $carousel->price = $request->input('price');
    $carousel->category_id = $request->input('category');

    // Sauvegarder les modifications du carousel
    $carousel->save();

    // Supprimer une image spécifique si nécessaire
    if ($request->has('delete_image_id')) {
        $deleteImageIds = $request->input('delete_image_id');
        foreach ($deleteImageIds as $imageId) {
            $pictureToDelete = Picture::find($imageId);
            if ($pictureToDelete) {
                // Supprimer l'image de la base de données
                $pictureToDelete->delete();
                // Supprimer le fichier physique de l'image
                if (file_exists(public_path($pictureToDelete->images))) {
                    unlink(public_path($pictureToDelete->images));
                }
            }
        }
    }

    // Remplacer une image existante par une nouvelle si une est fournie
    if ($request->hasFile('imageUpdate')) {
        $imagesToUpdate = $request->file('imageUpdate');
        foreach ($imagesToUpdate as $key => $newImage) {
            // Vérifier si une image a été fournie
            if ($newImage !== null) {
                // Supprimer le fichier physique de l'image existante
                if (file_exists(public_path($request->input('current_image')[$key]))) {
                    unlink(public_path($request->input('current_image')[$key]));
                }
                // Déplacer la nouvelle image vers le répertoire public/images
                $imageName = $newImage->getClientOriginalName();
                $newImage->move(public_path('imageCreate'), $imageName);
                // Mettre à jour le chemin de l'image dans la base de données
                $carousel->carouselPictureMany[$key]->images = 'imageCreate/' . $imageName;
                $carousel->carouselPictureMany[$key]->save();
            }
        }
    }

    // Rediriger vers la page de visualisation du carrousel après la mise à jour
    return redirect("/carousel/view");
}



    public function destroyCarousel($id){
        // Utilisez find() pour récupérer un seul objet Carousel par son ID
        $carousel = Carousel::find($id);
        if ($carousel) {
            $carousel->delete(); // Utilisez delete() sur l'instance de Carousel
        }
        return redirect("/carousel/view");
    }
}