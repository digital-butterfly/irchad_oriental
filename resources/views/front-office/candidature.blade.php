@extends('front-office.layouts.master')

@section('content')

<style>
.home-bg-overlay {
    z-index: 0;
}
/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    /*CSS counters to number the steps*/
    counter-reset: step;
    text-align: center;
    width: 800px;
    margin: 0 auto;
    position: relative;
    bottom: -292px;
}

#progressbar li {
    list-style-type: none;
    color: white;
    text-transform: uppercase;
    font-size: 9px;
    width: 33.33%;
    float: left;
    position: relative;
    letter-spacing: 1px;
}

#progressbar li:before {
    content: counter(step);
    counter-increment: step;
    width: 24px;
    height: 24px;
    line-height: 26px;
    display: block;
    font-size: 12px;
    color: #333;
    background: white;
    border-radius: 25px;
    margin: 0 auto 10px auto;
}

/*progressbar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: white;
    position: absolute;
    left: -50%;
    top: 9px;
    z-index: -1; /*put it behind the numbers*/
}

#progressbar li:first-child:after {
    /*connector not needed before the first step*/
    content: none;
}

/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #1bbc9b;
    color: white;
}

/*Hide all steps except first step*/
#contact-form fieldset:not(:first-of-type) {
    display: none;
}

.custom-form input:-webkit-calendar-picker-indicator { /* display: none */ }

.custom-form input[type=date]::-webkit-inner-spin-button, 
.custom-form input[type=date]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
    /* position: relative; */
    /* top : 7px; */
}

.custom-form .form-control, .custom-form #contact-form select.form-control {
    border: none;
    border-bottom: 1px solid #c1c1c1;
}

.contact-details .contact-details-header {
    text-align: center;
}

.logical-fields {
    display: none;
}
</style>

<!-- START CONTACT-HEADER -->
<section class="bg-pages-title">
    <div class="home-bg-overlay">
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Informations Personnelles</li>
            <li>Informations Professionelles</li>
            <li>Informations sur le Projet</li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center text-white">
                    <h1 class="text-white">Soumissionner un Projet</h1>
                    {{-- <p class="mt-3 mb-0 text-uppercase">get in touch with us</p> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CONTACT-HEADER -->

<!-- START CONTACT -->
<section class="section pt-0 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-details bg-white p-5 mt-3">
                    <div class="custom-form">
                        <div id="message"></div>
                        <form method="post" action="php/contact.php" name="contact-form" id="contact-form">

                            <!-- STEP 1 -->
                            <fieldset>
                                <div class="contact-details-header">
                                    <div class="contact-icon">
                                        <i class="pe-7s-id text-custom"></i>
                                    </div>
                                    <h3>Informations personnelles</h3>
                                    <p class="text-muted mt-3">Renseignez vos informations personnelles.</p>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <select name="civility" id="civility" class="form-control">
                                                <option value="" selected disabled>Votre civilité...</option>
                                                <option value="">Mr</option>
                                                <option value="">Mme</option>
                                                <option value="">Mlle</option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <input name="last name" id="sarname" type="text" class="form-control" placeholder="Votre prénom...">
                                        </div>
                                    </div>
    
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <input name="last name" id="sarname" type="text" class="form-control" placeholder="Votre nom de famille...">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Votre numéro de CIN...">
                                        </div>
                                    </div>
    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input name="number" id="number" type="date" class="form-control" placeholder="Votre date de naissance...">
                                        </div>
                                    </div>
    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <select name="marital-status" id="marital-status" class="form-control">
                                                <option value="" selected disabled>Votre situation familiale...</option>
                                                <option value="">Célibataire</option>
                                                <option value="">Marié(e)</option>
                                                <option value="">Divorcé(e)</option>
                                                <option value="">Veuf(e)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row mt-4">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Votre adresse...">
                                        </div>
                                    </div>
    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <select name="township" id="township" class="form-control">
                                                <option value="" selected disabled>Votre commune...</option>
                                                <optgroup label="Municipalités">
                                                    <option value="">Al Hoceïma</option>
                                                    <option value="">Bni Bouayach</option>
                                                    <option value="">Imzouren</option>
                                                    <option value="">Targuist</option>
                                                    <option value="">Ajdir</option>
                                                </optgroup>
                                                <optgroup label="Cercle de Bni Boufrah">
                                                    <option value="">Bni Boufrah</option>
                                                    <option value="">Senada</option>
                                                    <option value="">Bni Gmil Maksouline</option>
                                                    <option value="">Bni Gmil</option>
                                                </optgroup>
                                                <optgroup label="Cercle de Bni Ouriaghel">
                                                    <option value="">Bni Ouriaghel</option>
                                                    <option value="">Arbaa Taourirt</option>
                                                    <option value="">Chakrane</option>
                                                    <option value="">Nekkour</option>
                                                    <option value="">Tifarouine</option>
                                                    <option value="">Bni Hadifa</option>
                                                    <option value="">Zaouïat Sidi Abdelkader</option>
                                                    <option value="">Beni Abadallah</option>
                                                    <option value="">Aït Youssef Ou Ali</option>
                                                    <option value="">Louta</option>
                                                    <option value="">Imrabten</option>
                                                    <option value="">Izzemouren</option>
                                                    <option value="">Aït Kamra</option>
                                                    <option value="">Rouadi</option>
                                                </optgroup>
                                                <optgroup label="Cercle de Targuist">
                                                    <option value="">Bni Ammart</option>
                                                    <option value="">Sidi Bouzineb</option>
                                                    <option value="">Sidi Boutmim</option>
                                                    <option value="">Zarkt</option>
                                                    <option value="">Beni Bchir</option>
                                                    <option value="">Bni Bounsar</option>
                                                    <option value="">Bni Ahmed Imoukzan</option>
                                                </optgroup>
                                                <optgroup label="Cercle de Ketama">
                                                    <option value="">Ketama</option>
                                                    <option value="">Tamsaout</option>
                                                    <option value="">Issaguen</option>
                                                    <option value="">Moulay Ahmed Chérif</option>
                                                    <option value="">Bni Bouchibet</option>
                                                    <option value="">Abdelghaya Souahel</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row mt-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Votre email...">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Votre téléphone...">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select name="reduced-mobility" id="reduced-mobility" class="form-control">
                                                <option value="" selected disabled>Êtes-vous une personne à mobilité réduite?</option>
                                                <option value="">Non</option>
                                                <option value="">Handicap auditif</option>
                                                <option value="">Handicap vocal</option>
                                                <option value="">Handicap moteur</option>
                                                <option value="">Handicap visuel</option>
                                                <option value="">Handicap mental</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4 text-center">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">Je certifie l'exactitude des données renseignées et j'accepte les <a href="#">termes et conditions</a>.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4 text-center">
                                    <div class="col-lg-12">
                                        <input type="button" name="next" class="submitBnt btn btn-custom next" value="Suivant">
                                        <div id="simple-msg"></div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- STEP 2 -->
                            <fieldset>
                                <div class="contact-details-header">
                                    <div class="contact-icon">
                                        <i class="pe-7s-study text-custom"></i>
                                    </div>
                                    <h3>Informations professionnelles</h3>
                                    <p class="text-muted mt-3">Renseignez vos informations professionnelles.</p>
                                </div>

                                <div class="fields-section">
                                    <h4 class="mt-4">Formation</h4>
                                    <h5><small class="text-muted">Renseignez vos diplômes</small></h5>
    
                                    <div class="row source-field">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="Type de diplôme...">
                                            </div>
                                        </div>
    
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="Année d'obtention...">
                                            </div>
                                        </div>
        
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="last name" id="sarname" type="text" class="form-control" placeholder="Spécialité...">
                                            </div>
                                        </div>
        
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="last name" id="sarname" type="text" class="form-control" placeholder="Option...">
                                            </div>
                                        </div>
    
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="last name" id="sarname" type="text" class="form-control" placeholder="Établissement...">
                                            </div>
                                        </div>
    
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input type="button" name="add-field" class="submitBnt btn btn-custom add-field" value="+">
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="dynamic-fields">
                                        <!-- Dynamic fielfd will be cloned here -->
                                    </div>
                                </div>

                                <div class="fields-section">
                                    <h4 class="mt-5">Experience Professionnelle</h4>
                                    <h5><small class="text-muted">Renseignez vos experiences professionnelles</small></h5>
    
                                    <div class="row source-field">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="Du...">
                                            </div>
                                        </div>
    
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="Au...">
                                            </div>
                                        </div>
        
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="last name" id="sarname" type="text" class="form-control" placeholder="Poste...">
                                            </div>
                                        </div>
        
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="last name" id="sarname" type="text" class="form-control" placeholder="Organisme...">
                                            </div>
                                        </div>
    
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input name="last name" id="sarname" type="text" class="form-control" placeholder="Mission...">
                                            </div>
                                        </div>
    
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input type="button" name="add-field" class="submitBnt btn btn-custom add-field" value="+">
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="dynamic-fields">
                                        <!-- Dynamic fielfd will be cloned here -->
                                    </div>
                                </div>

                                {{-- <div class="fields-section">
                                    <h4 class="mt-5">Langues</h4>
                                    <h5><small class="text-muted">Renseignez les langues que vous parlez</small></h5>
    
                                    <div class="row source-field">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="Langue...">
                                            </div>
                                        </div>
    
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="Niveau...">
                                            </div>
                                        </div>
    
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input type="button" name="add-field" class="submitBnt btn btn-custom add-field" value="+">
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="dynamic-fields">
                                        <!-- Dynamic fielfd will be cloned here -->
                                    </div>
                                </div> --}}

                                <div class="row mt-4 text-center">
                                    <div class="col-lg-12">
                                        <input type="button" name="previous" class="submitBnt btn btn-custom previous" value="Précédent">
                                        <input type="button" name="next" class="submitBnt btn btn-custom next" value="Suivant">
                                        <div id="simple-msg"></div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- STEP 3 -->
                            <fieldset>
                                <div class="contact-details-header">
                                    <div class="contact-icon">
                                        <i class="pe-7s-portfolio text-custom"></i>
                                    </div>
                                    <h3>Informations sur le projet</h3>
                                    <p class="text-muted mt-3">Renseignez les détails de votre projet.</p>
                                </div>

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input name="name" id="name" type="text" class="form-control" placeholder="Titre de votre projet...">
                                        </div>
                                    </div>
    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input name="last name" id="sarname" type="text" class="form-control" placeholder="Secteur d'activité...">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Effectif du projet...">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select name="state-aid" id="state-aid" class="form-control dynamic-parent">
                                                <option value="" selected disabled>Avez-vous déjà bénéficié d'une aide étatique?</option>
                                                <option value="0">Non, je n'ai jamais bénéficié d'une aide étatique.</option>
                                                <option value="1">Oui, j'ai déjà bénéficié d'une aide étatique.</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Si oui, laquelle?">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <select name="civility" id="civility" class="form-control logical-parent">
                                                <option value="" selected disabled>Avez-vous déjà créé une entreprise pour votre projet?</option>
                                                <option value="1">Oui, j'ai déjà créé une entreprise pour mon projet.</option>
                                                <option value="0">Non, je n'est pas encore créé une entreprise pour mon projet.</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="logical-fields">
                                    <div class="row mt-4">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Forme de l'entreprise...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Dénomination de l'entreprise...">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Date de création de l'entreprise...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Adresse de l'entreprise...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Email de l'entreprise...">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="email" id="email" type="email" class="form-control" placeholder="Téléphone de l'entreprise...">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4 text-center">
                                    <div class="col-lg-12">
                                        <input type="button" name="previous" class="submitBnt btn btn-custom previous" value="Précédent">
                                        <input type="submit" id="submit" name="submit" class="submitBnt btn btn-custom" value="Envoyer">
                                        <div id="simple-msg"></div>
                                    </div>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CONTACT -->

<!-- START CONTACT-FORM -->
{{-- <section class="section pt-0 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Formulaire de Contact</h3>
                <div class="custom-form mt-5">
                    <div id="message"></div>
                    <form method="post" action="php/contact.php" name="contact-form" id="contact-form">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="name" id="name" type="text" class="form-control" placeholder="Votre prénom...">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="last name" id="sarname" type="text" class="form-control" placeholder="Votre nom de famille...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Votre email...">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="number" id="number" type="number" class="form-control" placeholder="Votre téléphone...">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea name="comments" id="comments" rows="7" class="form-control" placeholder="Votre message..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <input type="submit" id="submit" name="send" class="submitBnt btn btn-custom" value="Envoyer Message">
                                <div id="simple-msg"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section> --}}
<!-- END CONTACT-FORM -->

@endsection

@section('custom-js')
    
<script>

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
/* var left, opacity, scale; */ //fieldset properties which we will animate
/* var animating; */ //flag to prevent quick multi-click glitches

$(".next").click(function(){
	/* if(animating) return false;
	animating = true; */
	
	current_fs = $(this).parents().eq(2);
	next_fs = $(this).parents().eq(2).next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
    //show the next fieldset
    current_fs.hide();
	next_fs.show(); 
	//hide the current fieldset with style
	/* current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	}); */
});

$(".previous").click(function(){
	/* if(animating) return false;
	animating = true; */
	
	current_fs = $(this).parents().eq(2);
	previous_fs = $(this).parents().eq(2).prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
    //show the previous fieldset
    current_fs.hide();
	previous_fs.show(); 
	//hide the current fieldset with style
	/* current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	}); */
});

$("#submit").click(function(){
	return false;
})

//----------------------------

var fsElement, dfElement, dfCounter;

//Clone the degree field and show it
$('body').on('click', '.add-field', function() {
    fsElement = $(this).closest('.fields-section');
    dfElement = fsElement.find('.source-field');
    dfCounter = dfElement.length;
    if (dfCounter < 5) {
        dfElement.last().clone().appendTo(fsElement.find('.dynamic-fields:first')).find("input[type='text']").val('');
        $(this).removeClass('add-field').addClass('remove-degree').val('-');
        if (dfCounter >= 5) {
            $(this).prop('disabled', true);
        }
        attach_delete();
    }
    else {
        $(this).prop('disabled', true);
    }
});

//Attach functionality to delete buttons
function attach_delete(){
    $('body').off('click', '.remove-degree');
    $('body').on('click', '.remove-degree', function() {
        fsElement = $(this).closest('.fields-section');
        $(this).closest('.source-field').remove();
        dfCounter = fsElement.find('.source-field').length;
        if (dfCounter < 5) {
            fsElement.find('.add-field').prop('disabled', false);
        }
    });
}

//----------------------------

$('select.logical-parent').on('change', function() {
    var choice = this.value == 1 ? $(this).closest('.row').nextAll('.logical-fields:first').show() : $(this).closest('.row').nextAll('.logical-fields:first').hide();
});

$('select.dynamic-parent').on('change', function() {
    var choice = this.value == 1 ? $(this).closest('.row').find('input').last().show() : $(this).closest('.row').find('input').last().hide();
});

</script>

@endsection