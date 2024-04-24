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
    // methodes Front
    public function homeFront()
    {
        $carousels = Carousel::with('category')->get();
        $categories = Category::all();
        return view('home', compact('carousels', 'categories'));
    }
    public function carouselsFront()
    {
        $carousels = Carousel::with('category')->get();
        $categories = Category::all();
        return view('carousels', compact('carousels', 'categories'));
    }
    public function detailsFront($carouselId)
{
    // Récupérer le carrousel par son ID avec sa catégorie associée
    $carousel = Carousel::with('category')->find($carouselId);
    
    // Récupérer toutes les catégories
    $categories = Category::all();
    
    // Retourner la vue avec le carrousel et les catégories
    return view('/details/details', compact('carousel', 'categories'));
}

    // methodes Back
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

    public function updateCarousel(CarouselRequest $request, $id)
    {
        // Récupérer le carousel à mettre à jour
        $carousel = Carousel::find($id);
    
        // Mettre à jour les autres champs du carousel
        $carousel->update([
            'name' => $request->input('name'),
            'size' => $request->input('size'),
            'weight' => $request->input('weight'),
            'watt_power' => $request->input('watt_power'),
            'install_time' => $request->input('install_time'),
            'description' => $request->input('description'),
            'localization' => $request->input('localization'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category'),
        ]);
    
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
                    $carousel->carouselPictureMany[$key]->update([
                        'images' => 'imageCreate/' . $imageName
                    ]);
                }
            }
        }
    
        // Ajouter une nouvelle image si une est fournie
        if ($request->hasFile('newImages')) {
            $newImages = $request->file('newImages');
            foreach ($newImages as $newImage) {
                // Vérifier si une image a été fournie
                if ($newImage !== null) {
                    // Enregistrer la nouvelle image dans la base de données
                    $picture = new Picture();
                    $imageName = $newImage->getClientOriginalName();
                    $newImage->move(public_path('imageCreate'), $imageName);
                    $picture->images = 'imageCreate/' . $imageName;
                    $carousel->carouselPictureMany()->save($picture);
                }
            }
        }
    
        // Rediriger vers la page de visualisation du carrousel après la mise à jour
        return redirect("/carousel/view");
    }
    


    public function destroyCarousel($id){
        // Utilisez findOrFail() pour récupérer un seul objet Carousel par son ID
        $carousel = Carousel::findOrFail($id);
    
        // Récupérer toutes les images associées au carousel
        $carouselPictures = $carousel->carouselPictureMany;
    
        // Parcourir et supprimer les images associées
        foreach ($carouselPictures as $picture) {
            // Supprimer l'image de la base de données
            $picture->delete();
    
            // Supprimer le fichier physique de l'image
            if (file_exists(public_path($picture->images))) {
                unlink(public_path($picture->images));
            }
        }
    
        // Supprimer le carousel lui-même
        $carousel->delete();
    
        return redirect("/carousel/view");
    }
    
}