<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->

<!-- Start Slider area -->
<div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
    <!-- Start Single Slide -->
    <div class="slide animation__style10 bg-image--alice fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <!-- <h2>Buy <span>your </span></h2>
                            <h2>favourite <span>Book </span></h2>
                            <h2>from <span>Here </span></h2>
                            <a class="shopbtn" href="#">shop now</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->

    <!-- Start Single Slide -->
    <div class="slide animation__style10 bg-image--beast fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <!-- <h2>Buy <span>your </span></h2>
                            <h2>favourite <span>Book </span></h2>
                            <h2>from <span>Here </span></h2>
                            <a class="shopbtn" href="#">shop now</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->

    <!-- Start Single Slide -->
    <div class="slide animation__style10 bg-image--peter fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <!-- <h2>Buy <span>your </span></h2>
                            <h2>favourite <span>Book </span></h2>
                            <h2>from <span>Here </span></h2>
                            <a class="shopbtn" href="#">shop now</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->

</div>
<!-- End Slider area -->

<!-- Modal after checkout -->
<?php if(isset($data['checkout_message'])) : ?>
    <?php $this->view("_success-modal", $data) ?>
<?php endif; ?>
<!-- End Modal after checkout -->

<!-- Start Notre Histoire -->
<section class="pt--80 pb --30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title notre-histoire text-center">
                    <h2 class="title__be--2 ">Notre Histoire</h2>
                    <p>
                    Depuis 1907, Bluebeard a d??velopp?? un r??seau de 11 librairies en Rh??ne-Alpes et r??cemment en r??gion parisienne. 
                    Ses libraires sont reconnues pour leur expertise et leur passion des livres de collection, dans les domaines de la connaissance comme du loisir. 
                    En lan??ant bluebeard.fr en 1997, Bluebeard a acquis une solide exp??rience du e-commerce.
                    <br><br>
                    Dans nos librairies situ??es en Rh??ne-Alpes, ce sont plus de 180 libraires et papetiers qui vous conseillent et partagent au quotidien leurs coups de coeur. 
                    Sur bluebeard.fr, une ??quipe de 4 personnes se charge d'animer le site en fonction des actualit??s du moment et ?? vous proposer des s??lections approuv??es par nos libraires ! 
                    Vous pouvez aussi d??couvrir en un clic leurs derniers coups de coeur, pour trouver le livre qu'il vous faut ou celui qui fera plaisir. 
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Notre Histoire -->


<!-- Start Nouveaut??s -->
<section class="wn__product__area brown--color pt--80  pb--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center pb--50">
                    <h2 class="title__be--2 ">Nouveaut??s</h2>
                    <p>Chez Bluebeard, nous sommes toujours ?? l'aff??t des perles rares. D??couvrez aujourd'hui nos derni??res trouvailles.</p>
                </div>
            </div>
        </div>
        <!-- Start Single Tab Content -->
        <div class="furniture--4 border--round arrows_style owl-carousel owl-theme mt--10">
            <!-- Chargement de la liste des produits -->
            <?php if(is_array($data['products'])) : ?>
                <?php shuffle($data['products']) ?>
                <?php foreach(($data['products']) as $product) : ?>
                    <!-- Carte d'un produit -->
                    <div class="product product__style--3">
                        <?php 
                            $subdata['product'] = $product; 
                            $subdata['wishlist'] = $data['wishlist']; 
                            $subdata['redirect'] = 'home';
                        ?>
                        <?php $this->view("_product-card", $subdata) ?>
                    </div>
                    <!-- !Carte d'un produit -->
                <?php endforeach; ?>
            <?php endif; ?>
            <!-- !Chargement de la liste des produits -->
        </div>

        <!-- DEUXIEME RANGEE -->

        <div class="second__row__of__books">
            <div class="furniture--4 border--round arrows_style owl-carousel owl-theme mt--40">
                <!-- Chargement de la liste des produits (bis) -->
                <?php if(is_array($data['products'])) : ?>
                    <?php shuffle($data['products']) ?>
                    <?php foreach($data['products'] as $product) : ?>
                        <!-- Carte d'un produit -->
                        <div class="product product__style--3">
                            <?php 
                                $subdata['product'] = $product; 
                                $subdata['wishlist'] = $data['wishlist']; 
                                $subdata['redirect'] = 'home';
                            ?>
                            <?php $this->view("_product-card", $subdata) ?>
                        </div>
                        <!-- !Carte d'un produit -->
                    <?php endforeach; ?>
                <?php endif; ?>
                <!-- !Chargement de la liste des produits -->
            </div>
        </div>
        <!-- End Single Tab Content -->
    </div>
</section>
<!-- End Nouveaut??s -->


<!-- Start Saint-Valentin -->
<section class="wn__product__area brown--color pt--80  pb--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center pb--50">
                    <h2 class="title__be--2 ">Saint-Valentin</h2>
                    <p>D??couvrez notre s??lection id??ale de livres de collection pour la Saint-Valentin et offrez un cadeau inoubliable ?? vos proches.</p>
                </div>
            </div>
        </div>
        <!-- Start Single Tab Content -->
        <div class="furniture--4 border--round arrows_style owl-carousel owl-theme mt--10">
            <!-- Chargement de la liste des produits -->
            <?php if(is_array($data['products'])) : ?>
                <?php shuffle($data['products']) ?>
                <?php foreach($data['products'] as $product) : ?>
                    <!-- Affichage uniquement des livres de la collection 'Romance' (id = 4) -->
                    <?php if($product->collection_id == 4) : ?>
                        <!-- Carte d'un produit -->
                        <div class="product product__style--3">
                            <?php 
                                $subdata['product'] = $product; 
                                $subdata['wishlist'] = $data['wishlist']; 
                                $subdata['redirect'] = 'home';
                            ?>
                            <?php $this->view("_product-card", $subdata) ?>
                        </div>
                    <!-- !Carte d'un produit -->
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <!-- !Chargement de la liste des produits -->
        </div>
        <!-- End Single Tab Content -->
    </div>
</section>
<!-- End Saint-Valentin -->


<!-- Start Collections -->
<section class="wn__product__area brown--color pt--80 pb--30custom-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <div class="section__title text-center pb--50">
                    <h2 class="title__be--2 ">Collections</h2>
                    <p>Fan de litt??rature fantastique ? De romans historiques ? Quoi que vous aimiez, vous trouverez <i>le</i> livre que vous cherchiez.</p>
                </div>
            </div>
        </div>
        <!-- Start Single Tab Content -->
        <div class="furniture--3 border--round arrows_style owl-carousel owl-theme mt--10">
            <!-- Chargement de la liste des produits -->
            <?php if(is_array($data['collections'])) : ?>
                <?php shuffle($data['collections']) ?>
                <?php foreach($data['collections'] as $collection) : ?>
                    <!-- Illustration d'une collection -->
                        <a href="<?= ROOT . 'catalogue/' .  $collection->slug ?>">
                            <img src="<?= ASSETS . THEME . 'images/collections/' . $collection->image ?>" >
                        </a>
                    <!-- !Illustration d'une collection -->
                <?php endforeach; ?>
            <?php endif; ?>
            <!-- !Chargement de la liste des produits -->
        </div>
        <!-- End Single Tab Content -->
    </div>
</section>
<!-- End Collections -->


<!-- Start Blogs -->
<!-- <section class="wn__recent__post ptb--80 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center">
                    <h2 class="title__be--2">Blog</h2>
                    <p>D??couvrez nos r??cents articles de blogs ??crits par des passionn??s de litt??rature.</p>
                </div>
            </div>
        </div>
        <div class="row mt--50">
            <div class="col-md-6 col-lg-4 col-sm-12">
                <div class="post__itam box--shadow--9">
                    <div class="content">
                        <h3><a href="blog-details.html">International activities of the Frankfurt Book </a></h3>
                        <p>We are proud to announce the very first the edition of the frankfurt news.We are
                            proud to announce the very first of edition of the fault frankfurt news for us.</p>
                        <div class="post__time">
                            <span class="day">Dec 06, 18</span>
                            <div class="post-meta">
                                <ul>
                                    <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                                    <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-sm-12">
                <div class="post__itam box--shadow--9">
                    <div class="content">
                        <h3><a href="blog-details.html">Reading has a signficant info number of benefits</a>
                        </h3>
                        <p>Find all the information you need to ensure your experience.Find all the information
                            you need to ensure your experience . Find all the information you of.</p>
                        <div class="post__time">
                            <span class="day">Mar 08, 18</span>
                            <div class="post-meta">
                                <ul>
                                    <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                                    <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-sm-12">
                <div class="post__itam box--shadow--9">
                    <div class="content">
                        <h3><a href="blog-details.html">The London Book Fair is to be packed with exciting </a>
                        </h3>
                        <p>The London Book Fair is the global area inon marketplace for rights negotiation.The
                            year London Book Fair is the global area inon forg marketplace for rights.</p>
                        <div class="post__time">
                            <span class="day">Nov 11, 18</span>
                            <div class="post-meta">
                                <ul>
                                    <li><a href="#"><i class="bi bi-love"></i>72</a></li>
                                    <li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- End Blogs -->


<!-- Start Quickview Modal -->
<?php 
    $data['redirect'] = 'home';
    $this->view("_quickview", $data);
?>
<!-- End Quickview Modal -->


<!-- Start Loading Screen -->
<?php $this->view("_loading") ?>
<!-- End Loading Screen -->


<!-- Separator -->
<div style="height:300px;">
</div>
<!-- !Separator -->

<!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->


<style>
@media only screen and (max-width: 575px) {
    .second__row__of__books {
        display: none!important;
    }
}
</style>