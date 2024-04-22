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
    $carousel = new Carousel;
    $carousel->name = $request->input('name');
    $carousel->size = $request->input('size');
    $carousel->weight = $request->input('weight');
    $carousel->watt_power = $request->input('watt_power');
    $carousel->install_time = $request->input('install_time');
    $carousel->description = $request->input('description');
    $carousel->localization = $request->input('localization');
    $carousel->price = $request->input('price');

    // ajout d une image 
    if ($request->hasFile('imageCreate')) {
        $image = $request->file('imageCreate');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('imageCreate'), $imageName); // Déplacer l'image vers le répertoire public/images
        $carousel->carouselPictureMany()->create(['images' => 'imageCreate/' . $imageName]);
    }
    // Enregistrer le carrousel
    $carousel->category_id = $request->input('category');
    $carousel->save();

    // Créer une instance de Picture associée au Carousel
    // $picture = new Picture();
    // $picture->images = $carousel->image; // Utiliser le nom de l'image du Carousel
    // $picture->carousel_id = $carousel->id; // Associer l'image au Carousel créé
    // $picture->save();
   

    return redirect("/carousel/view");
}

    //Fonction pour modifier un produit
    public function updateCarousel(CarouselRequest $request, $id){
        $carousel = new Carousel;
        $carousel->name = $request->input('name');
        $carousel->size = $request->input('size');
        $carousel->weight = $request->input('weight');
        $carousel->watt_power = $request->input('watt_power');
        $carousel->install_time = $request->input('install_time');
        $carousel->description = $request->input('description');
        $carousel->localization = $request->input('localization');
        $carousel->price = $request->input('price');
      
        $carousel->category_id = $request->input('category');
        $carousel->save();
        
        return redirect("carousel/view");
    }

    //Fonction pour supprimer un produit
    public function destroyCarousel($id){
        $delete = Carousel::find($id);
        $delete->delete($id);
        return redirect("/carousel/view");
    }
}
