<?php

namespace App\Http\Controllers;
use App\Models\Carousel;
use App\Http\Requests\CarouselRequest;
use App\Models\Picture;
use App\Models\Category;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Quote;
use Illuminate\Http\Request;

class CarouselController extends Controller
{   
    // methodes Front
    public function homeFront()
{   
    $carousels = Carousel::with('category')
                    ->where('status', 'approved')
                    ->orderBy('id', 'desc')
                    ->take(3)
                    ->get();
    $categories = Category::all();
    return view('home', compact('carousels', 'categories'));

    }
    public function carouselsFront()
    {
        $carousels = Carousel::with('category')->where('status', 'approved')->get();
        $categories = Category::all();
        return view('carousels', compact('carousels', 'categories'));
    }
    public function detailsFront($carouselId)
{
    // Récupérer le carrousel par son ID avec sa catégorie associée
    $carousel = Carousel::with('category')->where('status', 'approved')->find($carouselId);
    
    // Vérifier si le carousel a été trouvé
    if (!$carousel) {
        // Rediriger ou gérer le cas où le carousel n'est pas trouvé
        abort(404);
    }

    // Récupérer toutes les catégories
    $categories = Category::all();
    $carouselJson = base64_encode($carousel);
    // Retourner la vue avec le carrousel et les catégories
    return view('/details/details', compact('carousel', 'categories'))->with('carouselJson', $carouselJson);
}


    // methodes Back
    public function home()
    {
        // Récupérer l'ID de l'utilisateur actuellement authentifié
        $userId = Auth::id();
    
        // Récupérer le rôle de l'utilisateur à partir de la session
        $userRole = Auth::user()->role;
    
        // Vérifier le rôle de l'utilisateur
        if ($userRole === 'Admin') {
            // Si l'utilisateur est un administrateur, récupérer uniquement ses carrousels
            $carousels = Carousel::where('user_id', $userId)->with('category')->get();
        } elseif ($userRole === 'Super_admin') {
            // Si l'utilisateur est un super administrateur, récupérer tous les carrousels
            $carousels = Carousel::with('category')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END, name")
            ->get();
        } else {
            // Pour tout autre type d'utilisateur, rediriger ou retourner une vue d'erreur
            return redirect()->route('home')->with('error', 'Accès non autorisé');
        }
    
        // Récupérer toutes les catégories
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
        $statusValues = config('enums.status');
        // Récupérer le carousel à mettre à jour
        $carousel = Carousel::find($id);

        // Vérifier si le carousel existe
        if (!$carousel) {
            abort(404); // Retourner une erreur 404 si le carousel n'existe pas
        }

        // Vérifier si l'utilisateur est un administrateur
        if (Auth::user()->role === 'Admin') {
            // Vérifier si l'utilisateur est autorisé à accéder à ce carousel
            if ($carousel->user_id != Auth::id()) {
                abort(404);
            }
        }

    // Récupérer toutes les catégories
    $categories = Category::all();
    $reservations = Calendar::where('carousel_id', $id)->get();
    return view('carousel.update')->with(["carousel" => $carousel, "categories" => $categories, $statusValues, "statusValues" => $statusValues, "reservations" => $reservations,]);
}


    //Fonction pour ajouter un nouveau carousel
//     public function createCarousel(CarouselRequest $request)
// {
//     // Récupérer l'utilisateur actuellement authentifié
//     $user = Auth::user();

//     // Créer une instance de Carousel
//     $carousel = new Carousel;
//     $carousel->name = $request->input('name');
//     $carousel->size = $request->input('size');
//     $carousel->weight = $request->input('weight');
//     $carousel->watt_power = $request->input('watt_power');
//     $carousel->install_time = $request->input('install_time');
//     $carousel->description = $request->input('description');
//     $carousel->localization = $request->input('localization');
//     $carousel->price = $request->input('price');
    
//     // Associer le carousel à l'utilisateur actuellement authentifié
//     $carousel->user()->associate($user);

//     // Définir le statut du Carousel sur "pending" par défaut
//     $carousel->status = 'pending';

//     // Si l'utilisateur est un Super_admin, définir le statut sur "approved" par défaut
//     if (Auth::user()->role === 'Super_admin') {
//         $carousel->status = 'approved';
//     }
    
//     // Enregistrer le Carousel
//     $carousel->category_id = $request->input('category');
//     $carousel->save();
    
//     // ajout d'une ou plusieurs images 
//     if ($request->hasFile('imageCreate')) {
//         foreach ($request->file('imageCreate') as $image) {
//             $imageName = $image->getClientOriginalName();
//             $image->move(public_path('imageCreate'), $imageName); // Déplacer l'image vers le répertoire public/images
    
//             // Créer une Picture associée au Carousel créé pour chaque image
//             $picture = new Picture();
//             $picture->images = 'imageCreate/' . $imageName;
//             $picture->carousel_id = $carousel->id; // Associer l'image au Carousel créé
//             $picture->save();
//         }
//     }
    
//     return redirect("/carousel/view");
// }
// test pour ajouter un nouveau carousel avec geoloc
public function createCarousel(CarouselRequest $request)
{
    // Récupérer l'utilisateur actuellement authentifié
    $user = Auth::user();

    // Formater l'adresse
    $address = $this->formatAddress(
        $request->input('street_number'),
        $request->input('street_name'),
        $request->input('postal_code'),
        $request->input('city'),
        $request->input('country')
    );

    // Géocoder l'adresse pour obtenir les coordonnées GPS
    $coordinates = $this->geocodeAddress($address);

    if (!$coordinates) {
        return redirect()->back()->withErrors(['localization' => 'Adresse non valide ou non trouvée.']);
    }

    // Créer une instance de Carousel
    $carousel = new Carousel;
    $carousel->name = $request->input('name');
    $carousel->length = $request->input('length');
    $carousel->width = $request->input('width');
    $carousel->weight = $request->input('weight');
    $carousel->watt_power = $request->input('watt_power');
    $carousel->install_time = $request->input('install_time');
    $carousel->description = $request->input('description');
    $carousel->street_number = $request->input('street_number');
    $carousel->street_name = $request->input('street_name');
    $carousel->postal_code = $request->input('postal_code');
    $carousel->city = $request->input('city');
    $carousel->country = $request->input('country');
    $carousel->latitude = $coordinates['latitude'];
    $carousel->longitude = $coordinates['longitude'];
    $carousel->price = $request->input('price');
    
    // Associer le carousel à l'utilisateur actuellement authentifié
    $carousel->user()->associate($user);

    // Définir le statut du Carousel sur "pending" par défaut
    $carousel->status = 'pending';

    // Si l'utilisateur est un Super_admin, définir le statut sur "approved" par défaut
    if (Auth::user()->role === 'Super_admin') {
        $carousel->status = 'approved';
    }
    
    // Enregistrer le Carousel
    $carousel->category_id = $request->input('category');
    $carousel->save();
    
    // Ajout d'une ou plusieurs images 
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

private function formatAddress($streetNumber, $streetName, $postalCode, $city, $country)
{
    return trim("{$streetNumber} {$streetName}, {$postalCode}, {$city}, {$country}");
}

private function geocodeAddress($address)
{
    // Utiliser Nominatim pour géocoder l'adresse
    $response = Http::get('https://nominatim.openstreetmap.org/search', [
        'q' => $address,
        'format' => 'json',
        'limit' => 1,
    ]);

    if ($response->successful() && !empty($response[0])) {
        return [
            'latitude' => $response[0]['lat'],
            'longitude' => $response[0]['lon'],
        ];
    }

    return null;
}

// public function updateCarousel(CarouselRequest $request, $id)
// {
//     // Récupérer le carousel à mettre à jour
//     $carousel = Carousel::findOrFail($id);
    
//     // Vérifier si l'utilisateur est un administrateur
//     if (Auth::user()->role === 'Admin') {
//         // Vérifier si l'utilisateur est autorisé à modifier ce carousel
//         if ($carousel->user_id != Auth::id()) {
//             abort(404);
//         }
//     }

//     // Mettre à jour les autres champs du carousel
//     $carousel->update([
//         'name' => $request->input('name'),
//         'size' => $request->input('size'),
//         'weight' => $request->input('weight'),
//         'watt_power' => $request->input('watt_power'),
//         'install_time' => $request->input('install_time'),
//         'description' => $request->input('description'),
//         'localization' => $request->input('localization'),
//         'price' => $request->input('price'),
//         'category_id' => $request->input('category'),
//         // 'status' => $request->input('status'),

//     ]);
//     if (Auth::user()->role === 'Super_admin') {
//         $carousel->update([
//             'status' => $request->input('status')
//         ]);
//     }
    
//     // Supprimer une image spécifique si nécessaire
//     if ($request->has('delete_image_id')) {
//         $deleteImageIds = $request->input('delete_image_id');
//         foreach ($deleteImageIds as $imageId) {
//             $pictureToDelete = Picture::find($imageId);
//             if ($pictureToDelete) {
//                 // Supprimer l'image de la base de données
//                 $pictureToDelete->delete();
//                 // Supprimer le fichier physique de l'image
//                 if (file_exists(public_path($pictureToDelete->images))) {
//                     unlink(public_path($pictureToDelete->images));
//                 }
//             }
//         }
//     }

//     // Remplacer une image existante par une nouvelle si une est fournie
//     if ($request->hasFile('imageUpdate')) {
//         $imagesToUpdate = $request->file('imageUpdate');
//         foreach ($imagesToUpdate as $key => $newImage) {
//             // Vérifier si une image a été fournie
//             if ($newImage !== null) {
//                 // Supprimer le fichier physique de l'image existante
//                 if (file_exists(public_path($request->input('current_image')[$key]))) {
//                     unlink(public_path($request->input('current_image')[$key]));
//                 }
//                 // Déplacer la nouvelle image vers le répertoire public/images
//                 $imageName = $newImage->getClientOriginalName();
//                 $newImage->move(public_path('imageCreate'), $imageName);
//                 // Mettre à jour le chemin de l'image dans la base de données
//                 $carousel->carouselPictureMany[$key]->update([
//                     'images' => 'imageCreate/' . $imageName
//                 ]);
//             }
//         }
//     }

//     // Ajouter une nouvelle image si une est fournie
//     if ($request->hasFile('newImages')) {
//         $newImages = $request->file('newImages');
//         foreach ($newImages as $newImage) {
//             // Vérifier si une image a été fournie
//             if ($newImage !== null) {
//                 // Enregistrer la nouvelle image dans la base de données
//                 $picture = new Picture();
//                 $imageName = $newImage->getClientOriginalName();
//                 $newImage->move(public_path('imageCreate'), $imageName);
//                 $picture->images = 'imageCreate/' . $imageName;
//                 $carousel->carouselPictureMany()->save($picture);
//             }
//         }
//     }

//     // Rediriger vers la page de visualisation du carrousel après la mise à jour
//     return redirect("/carousel/view");
// }

// test update avec geoloc
public function updateCarousel(CarouselRequest $request, $id)
{
    // Récupérer le carousel à mettre à jour
    $carousel = Carousel::findOrFail($id);

    // Vérifier si l'utilisateur est un administrateur
    if (Auth::user()->role === 'Admin') {
        // Vérifier si l'utilisateur est autorisé à modifier ce carousel
        if ($carousel->user_id != Auth::id()) {
            abort(404);
        }
    }

    // Préparer les données à mettre à jour
    $updatedData = [
        'name' => $request->input('name'),
        'length' => $request->input('length'),
        'width' => $request->input('width'),
        'weight' => $request->input('weight'),
        'watt_power' => $request->input('watt_power'),
        'install_time' => $request->input('install_time'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'category_id' => $request->input('category')
    ];

    // Si l'utilisateur est un Super_admin, ajouter le statut aux données mises à jour
    if (Auth::user()->role === 'Super_admin') {
        $updatedData['status'] = $request->input('status');
    }

    // Vérifier les changements d'adresse
    $addressFields = ['street_number', 'street_name', 'postal_code', 'city', 'country'];
    $addressChanged = false;
    foreach ($addressFields as $field) {
        if ($carousel->$field !== $request->input($field)) {
            $addressChanged = true;
            $updatedData[$field] = $request->input($field);
        }
    }

    // Refaire une requête de géocodage si l'adresse a changé
    if ($addressChanged) {
        $address = implode(', ', array_filter([
            $request->input('street_number'),
            $request->input('street_name'),
            $request->input('postal_code'),
            $request->input('city'),
            $request->input('country')
        ]));

        $geocodeResult = $this->geocodeAddress($address);

        if ($geocodeResult) {
            $updatedData['latitude'] = $geocodeResult['latitude'];
            $updatedData['longitude'] = $geocodeResult['longitude'];
        }
    }

    // Mettre à jour les champs du carousel
    $carousel->update($updatedData);

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
    if ($request->hasFile('imageCreate')) {
        $newImages = $request->file('imageCreate');
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



    

public function destroyCarousel($id)
{
    // Utilisez findOrFail() pour récupérer un seul objet Carousel par son ID
    $carousel = Carousel::findOrFail($id);

    // Vérifier si l'utilisateur est un administrateur
    if (Auth::user()->role === 'Admin') {
        // Vérifier si l'utilisateur est autorisé à supprimer ce carousel
        if ($carousel->user_id != Auth::id()) {
            abort(404);
        }
    }

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