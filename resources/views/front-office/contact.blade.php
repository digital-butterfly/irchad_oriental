@extends('front-office.layouts.master')

@section('content')

    <section class="banner_area">
        <div class="container-fluid mx-auto">
            <div class="row">
                <div class="col-md-5"><h1>Contactez-Nous</h1>
                    <p>Pour toute demande, questionnement ou suggestion,
                        n'hésitez pas à utiliser le formulaire de contact ci-dessous,
                        l’équipe IRCHAD vous répondra dans les meilleurs délais.</p>

                </div>

            </div>
        </div>
    </section>
    <section style="margin-bottom: 164px;" class="secound-section light section-divider">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="color: #0961AA">Contactez Nous</h3>
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

                            <div class="row">
                                <div class="col text-center">
                                    <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary" value="Envoyer un Message">
                                    <div id="simple-msg"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
