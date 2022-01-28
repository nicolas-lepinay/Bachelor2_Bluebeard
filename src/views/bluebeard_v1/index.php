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
                    Depuis 1907, Bluebeard a développé un réseau de 11 librairies en Rhône-Alpes et récemment en région parisienne. 
                    Ses libraires sont reconnues pour leur expertise et leur passion des livres de collection, dans les domaines de la connaissance comme du loisir. 
                    En lançant bluebeard.fr en 1997, Bluebeard a acquis une solide expérience du e-commerce.
                    <br><br>
                    Dans nos librairies situées en Rhône-Alpes, ce sont plus de 180 libraires et papetiers qui vous conseillent et partagent au quotidien leurs coups de coeur. 
                    Sur bluebeard.fr, une équipe de 4 personnes se charge d'animer le site en fonction des actualités du moment et à vous proposer des sélections approuvées par nos libraires ! 
                    Vous pouvez aussi découvrir en un clic leurs derniers coups de coeur, pour trouver le livre qu'il vous faut ou celui qui fera plaisir. 
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Notre Histoire -->


<!-- Start Nouveautés -->
<section class="wn__product__area brown--color pt--80  pb--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center pb--50">
                    <h2 class="title__be--2 ">Nouveautés</h2>
                    <p>Chez Bluebeard, nous sommes toujours à l'affût des perles rares. Découvrez aujourd'hui nos dernières trouvailles.</p>
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
<!-- End Nouveautés -->


<!-- Start Saint-Valentin -->
<section class="wn__product__area brown--color pt--80  pb--30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-center pb--50">
                    <h2 class="title__be--2 ">Saint-Valentin</h2>
                    <p>Découvrez notre sélection idéale de livres de collection pour la Saint-Valentin et offrez un cadeau inoubliable à vos proches.</p>
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
                    <p>Fan de littérature fantastique ? De romans historiques ? Quoi que vous aimiez, vous trouverez <i>le</i> livre que vous cherchiez.</p>
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
                    <p>Découvrez nos récents articles de blogs écrits par des passionnés de littérature.</p>
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