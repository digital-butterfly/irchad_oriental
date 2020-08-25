@extends('front-office.layouts.master')

@section('content')

<!-- START FAQ-HEADER -->
<section class="bg-pages-title">
    <div class="home-bg-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center text-white">
                    <h1 class="text-white">F.A.Q</h1>
                    {{-- <p class="mt-3 mb-0 text-uppercase">get in touch with us</p> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END FAQ-HEADER -->


<!-- START FAQ  -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="typography mt-4">
                    <div class="mt-4">
                        <h4 class="dispaly-4">Questions fréquemment posées</h4>
                        <hr/>
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Qui peut soumissionner un projet ?
                                    </button>
                                </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    Tous les jeunes âgés entre 18 et 35 ans, en recherche active d’un emploi et qui ne pratiquent aucune activité dans le secteur public ou privé. Les porteurs de projets doivent obligatoirement résider au sein de la Province de Al Hoceima.
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Qui sont les candidats prioritaires ?
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    La priorité est attribué aux jeunes titulaires d’un diplôme universitaire ou de l’Office de la Formation Professionnelle et de la Promotion du Travail (OFPPT), aux jeunes ayant une expérience antérieure dans un domaine particulier et n’ayant jamais bénéficié des avantages du programme de l’INDH.
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Un projet validé est-il éditable ?
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    Oui. Vous pouvez compléter votre dossier ou le modifier tout en étant accompagné par nos experts et nos mentors.
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Qu’est-ce qui est considéré comme un projet innovant ?
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                    L’innovation est toute chose nouvellement introduite. Toutes les innovations sont considérées (technologie, concept, procédé, commercialisation etc.)
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Comment se fait la sélection des projets ?
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                <div class="card-body">
                                    Une fois que vous avez rempli le formulaire d’inscription, vos données sont vérifiées par nos équipes. Lorsque vos données seront validées, vous serez convié à l’une de nos plateformes physiques pour un entretien. Si toutes vos informations sont cohérentes avec votre profil et vos idées, des informations d’accès à notre plateforme virtuelle vous seront envoyées. Félicitation, votre projet est désormais sélectionné.
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingSix">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Les porteurs de projets doivent-ils contribuer financièrement au projet ?
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                <div class="card-body">
                                    Les porteurs de projets doivent contribuer à hauteur de 25% du coût total du projet sous forme de contribution en nature ou en argent.
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingSeven">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    A combien s’élève la contribution financière par IRCHAD et l’INDH ?
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                <div class="card-body">
                                    La contribution financière de IRCHAD et de l’INDH se limite à 100 000 Dirhams lorsque le porteur de projet est une seule personne. Dans le cas où le projet est fondé par deux personnes ou plus, la contribution s’élève jusqu’à 200 000 Dirhams. Chaque projet doit contribuer à la création d’au moins 5 emplois.
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingEight">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    Dois-je céder des parts sociales à IRCHAD et à l’INDH suite à leur contribution au financement du projet ?
                                    </button>
                                </h2>
                                </div>
                                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                                <div class="card-body">
                                    Aucunement. IRCHAD et l’INDH sont des organismes à but non lucratif et dont la finalité est le dynamisme de la croissance.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                     <div class="mt-5">
                        <h4 class="dispaly-4">Heading</h4>
                        <hr/>
                        <h1 class="mt-4">Large and long example Heading 1</h1>
                        <h2 class="mt-4">Large and long example Heading 2</h2>
                        <h3 class="mt-4">Large and long example Heading 3</h3>
                        <h4 class="mt-4">Large and long example Heading 4</h4>
                        <h5 class="mt-4">Large and long example Heading 5</h5>
                        <h6 class="mt-4">Large and long example Heading 6</h6>
                    </div>

                    <div class="mt-5">
                        <h4>Paragraph</h4>
                        <hr/>

                        <p class="mt-5 text-muted"><span class="desc-dropcaps mr-4">D</span>onsequences extremely painful Nor again there anyone who pursues desires obtain pain of itself because pain because occasionally circumstances occur tha in which toil and procure some great pleasure take a trivial examples which ever undertakes laborious physical exercise except obtain some advantage from But who has any right pleasur that produces resultant passage Lorem pleasure.</p>

                        <p class="mt-4 text-muted">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been industrys standard dummy text ever since the 1500s when unknown printer took galley scrambled make a type specimen book It has survived not only five centuries but also the leap into for lorem ipsum will uncover many web sites still in their infancy electronic typesetting remaining Internet tend to repeat predefined chunks as necessary essentially unchanged.
                        </p>

                    </div>

                    <div class="mt-5">
                        <h4>List Types</h4>
                        <hr/>

                        <div class="mt-5">
                            <h4>Ordered List</h4>
                            <ol>
                                <li class="text-muted mt-3"> Phasellus consectetuer vestibulum elit</li>
                                <li class="text-muted mt-3"> Vonummy imperdiet feugiat pede Sed lectus</li>
                                <li class="text-muted mt-3"> Curabitur ullamcorper ultricies nisi dui.</li>
                                <li class="text-muted mt-3"> Vonummy imperdiet feugiat pede Sed lectus</li>
                                <li class="text-muted mt-3"> Curabitur ullamcorper ultricies nisi dui.</li>
                            </ol>
                        </div>

                        <div class="mt-5">
                            <h4>Unordered List</h4>
                            <ul>
                                <li class="text-muted mt-3"> Donec vitae sapien libero venenatis faucibus</li>
                                <li class="text-muted mt-3"> Maecenas malesuada Praesent congue massa.</li>
                                <li class="text-muted mt-3"> Vorbi metus Phasellus blandit leo ut odio. </li>
                                <li class="text-muted mt-3"> Donec vitae sapien libero venenatis faucibus</li>
                                <li class="text-muted mt-3"> Maecenas malesuada Praesent congue massa.</li>
                            </ul>
                        </div>

                        <div class="mt-5">
                            <h4>Inline text elements </h4>

                            <div class="p-3">
                                <p class="text-muted">You can use the mark tag to
                                    <mark>highlight</mark> text.</p>
                                <p class="text-muted"><del>This line of text is meant to be treated as deleted text.</del></p>
                                <p class="text-muted"><s>This line of text is meant to be treated as no longer accurate.</s></p>
                                <p class="text-muted"><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
                                <p class="text-muted"><u>This line of text will render as underlined</u></p>
                                <p class="text-muted"><small>This line of text is meant to be treated as fine print.</small></p>
                                <p class="text-muted"><strong>This line rendered as bold text.</strong></p>
                                <p class="text-muted mb-0"><em>This line rendered as italicized text.</em></p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h4>Blockquote</h4>
                        <hr/>

                        <p class="mt-5 text-muted">Which saying through shrinking from toil and pain These cases are perfectly simple and easy to distinguish In a free hour when our power of choice is untrammelled and when nothing prevents our being able do what we like best every pleasure welcomed avoided</p>

                        <blockquote class="blockquote p-4 bg-light mt-4">
                            <p class="f-17 mb-0">Neque porro quisquam dolorem ipsum quia dolor amet consectetur adipisci velit sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                            <footer class="blockquote-footer mt-3">Someone famous in Source Title</footer>
                        </blockquote>

                        <p class="mt-4 text-muted">Tempore soluta nobis est eligendi optio cumque nihil impedit quo minus maxime placeat facere possimus omnis voluptas assumenda in omnis dolor repellendus temporibus autem quibusdam officiis debitis theys tha rerum necessitatibus saepe eveniet voluptates repudiandae molestiae recusandae reiciendis voluptatibus maiores doloribus asperiores repellat</p>
                    </div>

                </div> --}}
            </div>

            {{-- <div class="col-lg-4">
                <div class="left-standard-box mt-4">
                    <div class="search bg-light mt-4">

                        <div class="left-blog-title-heading">
                            <div class="left-blog-icon">
                                <i class="mdi mdi-adjust"></i>
                            </div>
                            <p class="left-blog-title mb-0">Find Us</p>
                        </div>
                        <div class="text-center mt-3 p-4">

                            <div class="search-form">
                                <form action="#">
                                    <div class="form-group">
                                        <input placeholder="Search Keywords" type="text">
                                        <i class="mdi mdi-magnify f-20"></i>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="about-box bg-light mt-5">
                        <div class="left-blog-title-heading">
                            <div class="left-blog-icon">
                                <i class="mdi mdi-adjust"></i>
                            </div>
                            <p class="left-blog-title mb-0">About Us</p>
                        </div>

                        <div class="text-center mt-3 p-4">
                            <div class="about-img-left">
                                <img src="images/blog-standard/left-about-img.jpg" class="img-fluid rounded" alt="">
                            </div>
                            <h6 class="mt-4">Michael Rodz</h6>
                            <p class="line-height_1_8 f-14 mt-4 text-muted">But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences or one who avoids a pain that produces no resultant pleasure</p>
                        </div>
                    </div>

                    <div class="social-links bg-light mt-5">
                        <div class="left-blog-title-heading">
                            <div class="left-blog-icon">
                                <i class="mdi mdi-adjust"></i>
                            </div>
                            <p class="left-blog-title mb-0">Social Links</p>
                        </div>

                        <div class="text-center mt-3 p-4">
                            <div class="left-Links-icon text-center">
                                <ul class="list-inline links-social">
                                    <li class="list-inline-item">
                                        <a href="#" class="rounded">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#" class="rounded">
                                            <i class="mdi mdi-twitter"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#" class="rounded">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a href="#" class="rounded">
                                            <i class="mdi mdi-vimeo"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="recent-post bg-light mt-5">
                        <div class="left-blog-title-heading">
                            <div class="left-blog-icon">
                                <i class="mdi mdi-adjust"></i>
                            </div>
                            <p class="left-blog-title mb-0">Recent Post</p>
                        </div>

                        <div class="text-center mt-3 p-4">
                            <div class="owl-carousel owl-theme" id="owl-demo">
                                <div class="item">
                                    <div class="recent-post-img">
                                        <img src="images/blog-standard/img-1.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="recent-post-img">
                                        <img src="images/blog-standard/img-2.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="recent-post-img">
                                        <img src="images/blog-standard/img-3.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="recent-post-img">
                                        <img src="images/blog-standard/img-1.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="recent-post-img">
                                        <img src="images/blog-standard/img-2.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="recent-post-img">
                                        <img src="images/blog-standard/img-3.jpg" class="img-fluid" alt="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="recent-post bg-light mt-5">
                        <div class="left-blog-title-heading">
                            <div class="left-blog-icon">
                                <i class="mdi mdi-adjust"></i>
                            </div>
                            <p class="left-blog-title mb-0 ">Categories</p>
                        </div>

                        <div class="mt-3 p-4">
                            <ul class="list-unstyled">
                                <li><a href="" class="blog-tag f-15">#Journey</a><span class="f-13 recent-post-count">40</span></li>

                                <li class="mt-3"><a href="" class="blog-tag f-15">#Photography</a><span class="f-13 recent-post-count">11</span></li>

                                <li class="mt-3"><a href="" class="blog-tag f-15">#Lifestyle</a><span class="f-13 recent-post-count">09</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="tag-could bg-light mt-5">
                        <div class="left-blog-title-heading">
                            <div class="left-blog-icon">
                                <i class="mdi mdi-adjust"></i>
                            </div>
                            <p class="left-blog-title mb-0">Tag Could</p>
                        </div>

                        <div class="mt-3 p-4">
                            <div class="tags">
                                <a href="#" class="f-12">#Advertisement</a>
                                <a href="#" class="f-12">#Blog</a>
                                <a href="#" class="f-12">#Fashion</a>
                                <a href="#" class="f-12">#Inspiration</a>
                                <a href="#" class="f-12">#Smart Quotes</a>
                                <a href="#" class="f-12">#Conceptual</a>
                                <a href="#" class="f-12">#Artistry</a>
                                <a href="#" class="f-12">#Unique</a>
                            </div>
                        </div>

                    </div>

                    <div class="recent-post bg-light mt-5">
                        <div class="left-blog-title-heading">
                            <div class="left-blog-icon">
                                <i class="mdi mdi-adjust"></i>
                            </div>
                            <p class="left-blog-title mb-0">News letter</p>
                        </div>

                        <div class="mt-3 p-4">
                            <p>Get the latest news and offers.</p>
                            <div class="search-form">
                                <form action="#">
                                    <input placeholder="Enter Email Address" type="text">
                                    <i class="mdi mdi-email f-20"></i>
                                    <button type="submit" class="btn btn-sm btn-custom w-100 mt-3">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- END FAQ -->

@endsection
