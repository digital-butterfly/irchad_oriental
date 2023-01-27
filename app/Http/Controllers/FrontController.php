<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Models\Profile;
use App\Models\Entreprise;
use App\Models\PorteurProjet;
use App\Models\Projet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index()
    {

        if (session()->get('locale') === 'ar') {

            return view('front-office.index_ar');
        } else {
            return view('front-office.index');
        }
    }

    public function soumissionProjet()
    {
        return view('frontend.soumission-projet');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    //    public function login()
    //    {
    //        return view('auth.login');
    //    }

    public function dummyForm()
    {
        return view('frontend.form');
    }

    public function action(Request $request)
    {
        $nom = $request->nom;
        $prenom = $request->prenom;
        $agecalculated = Carbon::parse($request->date_naissnace)->diffInYears(Carbon::now());
        $placeOfBirth = $request->lieu_naissance;
        $date_naissnace = Carbon::parse($request->date_naissnace);
        $province_commune = $request->province_commune;
        $phone = $request->phone;
        $age = $agecalculated;
        $email = $request->email;

        $nationalité = $request->nationalité;
        $niveau_etude = $request->niveau_etude;
        $dipolome_obtenu = $request->dipolome_obtenu;
        $profession = $request->profession;
        $cin = $request->cin;
        $ice = $request->ice;
        $caprevisionnel = $request->caprevisionnel;
        $annee_experience = $request->annee_experience;
        $incident_paiement = $request->incident_paiement;
        $entreprise = $request->entreprise;
        $forme_juridique = $request->forme_juridique;
        $province_comune_entreprise = $request->province_comune_entreprise;
        $objet_sociale = $request->objet_sociale;
        $type_financement = $request->type_financement;
        $financement = $request->financement;
        $intitule_projet = $request->intitule_projet;
        $secteur_activite = $request->secteur_activite;
        $nb_emplois_estimatif = $request->nb_emplois_estimatif;
        $province_implantation = $request->province_implantation;
        $programme_estimatif = $request->programme_estimatif;
        $nbr_emplois_estimatif = $request->nbr_emplois_estimatif;
        $description = $request->description;

        $data = array_filter($request->all(), function ($el) {
            return $el !== null;
        });

        $porteur = PorteurProjet::create([
            'nom' => $nom,
            'prenom' => $prenom,
            'cin' => $cin,
            'date_naissance' => $date_naissnace,
            'lieu_naissance' => $placeOfBirth,
            'province_commune' => $province_commune,
            'nationalité' => $nationalité,
            'téléphone' => $phone,
            'email' => $email,
            'age' => $age,
        ]);

        Profile::create([
            'niveau_etude' => $data['niveau_etude'],

            'profession' => $data['profession'],
            'nb_annee_experiance' => $data['annee_experience'],

            'porteur_projet_id' => $porteur['id']
        ]);


        if ($entreprise == '1') {

            if (empty($data['type_financement'])) {
                $data['type_financement'] = null;
            }

            Entreprise::create([
                'date_creation' => Carbon::parse($data['date_creation'])->format('Y-m-d'),
                'forme_juridique' =>  $forme_juridique,
                'province_commune' =>  $province_comune_entreprise,
                'objet_social' =>  $objet_sociale,
                'ice' =>  $ice,
                'financement' => intval($data['financement']),
                'type_financement' => $type_financement,
                'porteur_projet_id' => $porteur['id']
            ]);
        }

        Projet::create([
            'intitule' => $intitule_projet,
            'secteur_activite' => $secteur_activite,
            'province_implantation' => $province_implantation,
            'programme_estimatif' => $programme_estimatif,
            'caprevisionnel' => $caprevisionnel,
            'nb_emplois_estimatif' => $nb_emplois_estimatif,
            'description' => $description,
            'porteur_projet_id' => $porteur['id']
        ]);

        $data_send = [
            'nom' => $request->nom,
            'prenom' => $request->nom
        ];

        Mail::send('frontend.mail-template', $data_send, function ($message) use ($request) {

            $message->to($request->email, $request->nom)->subject('Validation de candidature projet mouwakabat intelaka');
            $message->from('contact@mouwakabatintelaka.ma', 'MOUWAKABAT INTELAKA');
        });

        return redirect()->route("accueil", "fr")
            ->with('success', 'Félicitations Vos informations ont bien été retenues merci');
    }




    public function action2(Request $request2)
    {



        DB::table('contact_individu')->insert([
            "nom" => $request2->nom,
            "prenom" => $request2->prenom,
            "email" => $request2->email,
            "telephone" => $request2->telephone,
            "experience_pro" => $request2->experience_pro,
            "apropos_projet" => $request2->apropos_projet
        ]);

        return redirect()->route("accueil", "fr");
    }
}
