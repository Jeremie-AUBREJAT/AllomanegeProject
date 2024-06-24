<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Http\Requests\CarouselRequest;
use App\Http\Requests\CarouselUpdateRequest;
use App\Models\Picture;
use App\Models\Category;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Quote;
use Illuminate\Http\Request;

/**
 * Ce contrôleur gère les actions de carousel.
 */
class CarouselController extends Controller
{
    /**
     * Affiche la page d'accueil du front avec les carrousels et les catégories.
     *
     * Cette méthode récupère les carrousels approuvés avec leurs catégories associées,
     * les trie par ID décroissant, en récupère au maximum 3, puis retourne la vue
     * 'home' en passant les données des carrousels et des catégories.
     *
     * @return \Illuminate\View\View La vue de la page d'accueil avec les carrousels et les catégories.
     */
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
    /**
     * Affiche la liste des carrousels approuvés avec leurs catégories et les réservations associées.
     *
     * Cette méthode récupère les carrousels approuvés avec leurs catégories associées,
     * paginés par 25 carrousels par page. Pour chaque carrousel, elle récupère les réservations
     * associées à l'aide de la relation avec le modèle Calendar.
     *
     * @return \Illuminate\View\View La vue 'carousels' avec les carrousels paginés et les catégories.
     */
    public function carouselsFront()
    {
        $carousels = Carousel::with('category')->where('status', 'approved')->paginate(6); // Paginer avec 9 carrousels par page
        $categories = Category::all();
        foreach ($carousels as $carousel) {
            $carousel->reservations = Calendar::where('carousel_id', $carousel->id)->get();
        }
        return view('carousels', compact('carousels', 'categories'));
    }

    /**
     * Affiche les détails d'un carrousel approuvé avec sa catégorie associée.
     *
     * Cette méthode récupère un carrousel approuvé à partir de son ID,
     * avec sa catégorie associée. Si le carrousel n'est pas trouvé, elle
     * retourne une erreur 404. Elle récupère également toutes les catégories
     * disponibles pour affichage.
     *
     * @param int $carouselId L'identifiant du carrousel à afficher.
     * @return \Illuminate\View\View La vue 'details' avec le carrousel et les catégories.
     */
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
    /**
     * Affiche la page d'accueil du back-office pour la gestion des carrousels.
     *
     * Cette méthode récupère les carrousels en fonction du rôle de l'utilisateur connecté :
     * - Pour un administrateur, elle récupère uniquement les carrousels associés à cet administrateur.
     * - Pour un super administrateur, elle récupère tous les carrousels, en les triant par statut puis par nom.
     * - Pour tout autre type d'utilisateur, elle redirige vers la page d'accueil avec un message d'erreur.
     *
     * @return \Illuminate\Contracts\Support\Renderable La vue 'carousel.view' avec les carrousels et les catégories.
     */
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
    /**
     * Affiche tous les carrousels disponibles.
     *
     * Cette méthode récupère tous les carrousels depuis la base de données
     * et les passe à la vue 'view' pour affichage.
     *
     * @return \Illuminate\View\View La vue 'view' avec tous les carrousels.
     */
    public function viewCarousel()
    {
        $carousels = Carousel::all();
        return view('view')->with("carousels", $carousels);
    }

    //Fonction pour afficher le formulaire de création d'un nouveau carousel
    /**
     * Affiche le formulaire de création d'un nouveau carousel.
     *
     * Cette méthode récupère toutes les catégories disponibles depuis la base de données
     * et les passe à la vue 'carousel.create' pour afficher le formulaire de création d'un carousel.
     *
     * @return \Illuminate\View\View La vue 'carousel.create' avec les catégories pour le formulaire.
     */
    public function viewCreateCarousel()
    {
        $categories = Category::all();
        return view('carousel.create')->with("categories", $categories);
    }

    //Fonction pour afficher le formulaire de modification d'un carousel
    /**
     * Affiche le formulaire de modification d'un carousel existant.
     *
     * Cette méthode récupère les détails d'un carousel spécifié par son ID,
     * vérifie les permissions pour accéder à ce carousel, récupère les catégories
     * et les réservations associées à ce carousel, puis passe les données nécessaires
     * à la vue 'carousel.update' pour afficher le formulaire de modification.
     *
     * @param int $id L'identifiant du carousel à mettre à jour.
     * @return \Illuminate\View\View La vue 'carousel.update' avec les données du carousel et les catégories.
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException En cas de carousel non trouvé ou d'accès non autorisé.
     */
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

    // create carousel
    /**
     * Crée un nouveau carousel à partir des données fournies dans la requête.
     *
     * Cette méthode récupère les données du formulaire de création de carousel,
     * valide et géocode l'adresse fournie, redimensionne et convertit les images
     * téléchargées en format WebP, associe les images au carousel créé, et enregistre
     * le carousel en base de données avec le statut par défaut "pending".
     * Si l'utilisateur est un super administrateur, le statut est automatiquement
     * défini sur "approved".
     *
     * @param \App\Http\Requests\CarouselRequest $request Les données de la requête validées par CarouselRequest.
     * @return \Illuminate\Http\RedirectResponse Redirige vers la liste des carrousels après création.
     */
    public function createCarousel(CarouselRequest $request)
    {
        // Récupérer l'utilisateur actuellement authentifié
        $user = Auth::user();
        // Vérifier si les champs de latitude et longitude ont été saisis manuellement
        // Vérifier si les champs de latitude et longitude ont été saisis manuellement
    $latitude2 = $request->input('latitude2');
    $longitude2 = $request->input('longitude2');
    $coordinates = null; // Initialisation de la variable $coordinates

    // Vérifier si les champs de latitude et longitude sont vides (ce qui indique qu'il faut géocoder l'adresse)
    if (empty($latitude2) && empty($longitude2)) {
        // Formater l'adresse pour le géocodage
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
            // Si les coordonnées ne sont pas trouvées, préparer les champs pour saisie manuelle
            $showManualCoords = true; // Indiquer qu'il faut afficher les champs de saisie manuelle
            return redirect()->back()->withErrors(['localization' => 'Adresse non valide ou non trouvée.'])->with('showManualCoords', $showManualCoords)->withInput();
        }
    } else {
        // Utiliser les coordonnées manuelles si elles sont disponibles
        $coordinates = [
            'latitude' => $latitude2,
            'longitude' => $longitude2,
        ];
    }

    
        // Ajout d'une ou plusieurs images
        if (!$request->hasFile('imageCreate')) {
            return redirect()->back()->withErrors(['imageCreate' => 'Veuillez télécharger au moins une image.'])->withInput();
        }

        foreach ($request->file('imageCreate') as $image) {
            // Vérifier si le fichier est au format JPEG
            if (!in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg'])) {
                return redirect()->back()->withErrors(['imageCreate' => 'Veuillez télécharger une image au format JPG ou JPEG.'])->withInput();
            }

            // Redimensionner l'image et la convertir en WebP
            $source = imagecreatefromjpeg($image->getPathname());

            // Obtenez les dimensions de l'image d'origine
            $sourceWidth = imagesx($source);
            $sourceHeight = imagesy($source);

            // Définir la hauteur souhaitée à 720 pixels
            $newHeight = 720;

            // Calculer la nouvelle largeur en conservant le ratio d'aspect
            $newWidth = intval($sourceWidth * ($newHeight / $sourceHeight));

            // Créer une nouvelle image redimensionnée
            $resizedImage = imagescale($source, $newWidth, $newHeight);

            // Convertir l'image en format WebP et enregistrer
            imagewebp($resizedImage, public_path('imageCreate/' . $image->getClientOriginalName() . '.webp'), 75);

            // Libérer la mémoire
            imagedestroy($source);
            imagedestroy($resizedImage);
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

        // Créer une Picture associée au Carousel créé pour chaque image
        foreach ($request->file('imageCreate') as $image) {
            $picture = new Picture();
            $picture->images = 'imageCreate/' . $image->getClientOriginalName() . '.webp';
            $picture->carousel_id = $carousel->id; // Associer l'image au Carousel créé
            $picture->save();
        }

        return redirect("/carousel/view");
    }

    /**
     * Formate l'adresse à partir des composants spécifiés.
     *
     * @param string $streetNumber Le numéro de rue.
     * @param string $streetName Le nom de la rue.
     * @param string $postalCode Le code postal.
     * @param string $city La ville.
     * @param string $country Le pays.
     * @return string L'adresse formatée.
     */
    private function formatAddress($streetNumber, $streetName, $postalCode, $city, $country)
    {
        return trim("{$streetNumber} {$streetName}, {$postalCode}, {$city}, {$country}");
    }
    /**
     * Géocode l'adresse en utilisant le service OpenStreetMap Nominatim.
     *
     * @param string $address L'adresse à géocoder.
     * @return array|null Les coordonnées GPS (latitude et longitude) si l'adresse est trouvée, sinon null.
     */
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


    // update carousel

    /**
     * Met à jour les informations d'un carousel existant.
     *
     * Cette méthode récupère et valide les données de mise à jour du carousel,
     * incluant les changements d'adresse et les images, en fonction des
     * autorisations de l'utilisateur. Les images sont redimensionnées et
     * converties en format WebP avant d'être enregistrées. Les images existantes
     * peuvent être supprimées ou mises à jour, selon les modifications fournies.
     *
     * @param \App\Http\Requests\CarouselUpdateRequest $request Les données validées de la requête de mise à jour du carousel.
     * @param int $id L'identifiant du carousel à mettre à jour.
     * @return \Illuminate\Http\RedirectResponse Redirige vers la liste des carrousels après la mise à jour.
     */
    public function updateCarousel(CarouselUpdateRequest $request, $id)
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
            // Récupérer le carousel
            $carousel = Carousel::findOrFail($id);
            // Récupérer les images associées au carousel
            $pictures = $carousel->carouselPictureMany;
            // S'assurer qu'il reste au moins une image dans le carousel
            $remainingImagesCount = $pictures->count() - count($deleteImageIds);
            if ($remainingImagesCount < 1) {
                // S'il ne reste pas assez d'images, afficher un message d'erreur et rediriger
                return redirect()->back()->withErrors(['error' => 'Vous devez conserver au moins une photo.']);
            }
            foreach ($deleteImageIds as $imageId) {
                // Vérifier si l'image à supprimer appartient au carousel
                $pictureToDelete = $pictures->where('id', $imageId)->first();
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
        if ($request->hasFile('imageUpdate')) {
            $imagesToUpdate = $request->file('imageUpdate');
            foreach ($imagesToUpdate as $key => $newImage) {
                // Vérifier si une image a été fournie
                if ($newImage !== null) {
                    // Vérifier si le fichier est au format JPEG
                    if (!in_array($newImage->getClientOriginalExtension(), ['jpg', 'jpeg'])) {
                        return redirect()->back()->withErrors(['imageUpdate' => 'Veuillez télécharger une image au format JPG ou JPEG.'])->withInput();
                    }

                    // Supprimer le fichier physique de l'image existante
                    if (file_exists(public_path($request->input('current_image')[$key]))) {
                        unlink(public_path($request->input('current_image')[$key]));
                    }

                    // Redimensionner l'image et la convertir en WebP
                    $source = imagecreatefromjpeg($newImage->getPathname());

                    // Obtenez les dimensions de l'image d'origine
                    $sourceWidth = imagesx($source);
                    $sourceHeight = imagesy($source);

                    // Définir la hauteur souhaitée à 720 pixels
                    $newHeight = 720;

                    // Calculer la nouvelle largeur en conservant le ratio d'aspect
                    $newWidth = intval($sourceWidth * ($newHeight / $sourceHeight));

                    // Créer une nouvelle image redimensionnée
                    $resizedImage = imagescale($source, $newWidth, $newHeight);

                    // Nom de fichier sans l'extension
                    $filename = pathinfo($newImage->getClientOriginalName(), PATHINFO_FILENAME);

                    // Chemin de sauvegarde
                    $webpPath = 'imageCreate/' . $filename . '.webp';

                    // Convertir l'image en format WebP et enregistrer
                    imagewebp($resizedImage, public_path($webpPath), 75);

                    // Libérer la mémoire
                    imagedestroy($source);
                    imagedestroy($resizedImage);

                    // Mettre à jour le chemin de l'image dans la base de données
                    $carousel->carouselPictureMany[$key]->update([
                        'images' => $webpPath
                    ]);
                }
            }
        }

        // Ajouter une nouvelle image si une est fournie
        if ($request->hasFile('imageCreate')) {
            $newImages = $request->file('imageCreate');
            foreach ($newImages as $newImage) {
                if ($newImage !== null) {
                    // Vérifier si le fichier est au format JPEG
                    if (!in_array($newImage->getClientOriginalExtension(), ['jpg', 'jpeg'])) {
                        return redirect()->back()->withErrors(['imageCreate' => 'Veuillez télécharger une image au format JPG ou JPEG.'])->withInput();
                    }

                    // Redimensionner l'image et la convertir en WebP
                    $source = imagecreatefromjpeg($newImage->getPathname());

                    // Obtenez les dimensions de l'image d'origine
                    $sourceWidth = imagesx($source);
                    $sourceHeight = imagesy($source);

                    // Définir la hauteur souhaitée à 720 pixels
                    $newHeight = 720;

                    // Calculer la nouvelle largeur en conservant le ratio d'aspect
                    $newWidth = intval($sourceWidth * ($newHeight / $sourceHeight));

                    // Créer une nouvelle image redimensionnée
                    $resizedImage = imagescale($source, $newWidth, $newHeight);

                    // Nom de fichier sans l'extension
                    $filename = pathinfo($newImage->getClientOriginalName(), PATHINFO_FILENAME);

                    // Chemin de sauvegarde
                    $webpPath = 'imageCreate/' . $filename . '.webp';

                    // Convertir l'image en format WebP et enregistrer
                    imagewebp($resizedImage, public_path($webpPath), 75);

                    // Libérer la mémoire
                    imagedestroy($source);
                    imagedestroy($resizedImage);

                    // Enregistrer la nouvelle image dans la base de données
                    $picture = new Picture();
                    $picture->images = $webpPath;
                    $carousel->carouselPictureMany()->save($picture);
                }
            }
        }


        // Rediriger vers la page de visualisation du carrousel après la mise à jour
        return redirect("/carousel/view");
    }

    //supprimer un carousel

    /**
     * Supprime un carousel spécifique ainsi que toutes ses images associées.
     *
     * Cette méthode permet de supprimer un carousel et toutes ses images
     * de la base de données et du stockage physique. Elle vérifie d'abord
     * les permissions de l'utilisateur avant de procéder à la suppression.
     *
     * @param int $id L'identifiant du carousel à supprimer.
     * @return \Illuminate\Http\RedirectResponse Redirige vers la liste des carrousels après la suppression.
     */



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
