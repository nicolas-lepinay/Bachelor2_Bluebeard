<?php 
$isLiked = false;
if(isset($data['wishlist'])) {
    foreach($data['wishlist'] as $liked_product) {
        if($liked_product->product_id == $data['product']->id_product) {
            $isLiked = true;
            break;
        }
    }
}
?>

<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->

<!-- Start breadcrumb area -->
<div class="ht__breadcrumb__area bg-image--<?= $data['product']->collection_id ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__inner text-center">
                    <h2 class="breadcrumb-title"><?= $data['product']->title ?></h2>
                    <h3 class="breadcrumb-title"><?= $data['product']->author ?></h3>
                    <nav class="breadcrumb-content">
                        <a class="breadcrumb_item" href="<?= ROOT ?>index">Accueil</a>
                        <span class="brd-separator">/</span>
                        <span class="breadcrumb_item active"><?= $data['product']->title . " (" . $data['product']->author . ")" ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End breadcrumb area -->

<!-- Start main Content -->
<div class="maincontent bg--white pt--80 pb--55">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-12 col-12">
                <div class="wn__single__product">
                    <div class="row">
                        <div class="col-lg-5 col-12">
                            <div class="wn__fotorama__wrapper">
                                <div class="fotorama wn__fotorama__action" data-nav="thumbs">
                                    <img src="<?= ROOT ?>products/<?= $data['product']->image ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-12 ml-5 px-5">
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="<?= ROOT ?>index">Accueil</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active"><?= $data['product']->title . " (" . $data['product']->author . ")" ?></span>
                            </nav>

                            <div class="product__info__main">
                                <h1><?= $data['product']->title ?></h1>
                                <h1><?= $data['product']->author ?></h1>
                                <div class="price-box">
                                    <span><?= number_format((float)$data['product']->price, 2, '.', '') ?>€</span>
                                </div>
                                <div class="product__overview">
                                    <p><?= $data['product']->description ?></p>

                                    <?php if($data['product']->stock == 1) : ?>
                                        <p class="text-success mt-4">Dernier en stock</p>
                                    <?php elseif($data['product']->stock > 1) : ?>
                                        <p class="text-success mt-4">En stock</p>
                                    <?php else : ?>
                                        <p class="text-danger mt-4">En rupture de stock</p>
                                    <?php endif; ?>

                                </div>
                                <div class="box-tocart d-flex">
                                <?php if($data['product']->stock > 0) : ?>
                                    <!-- Contrôleur : Cart  //  Méthode : add()  //  $redirect : 'cart -->
                                    <form method="POST" action="<?= ROOT . 'cart/add/' . 'cart' ?>">
                                        <span>Quantité :</span>
                                        <input id="qty" class="input-text qty" name="qty" value="1" min="1" max="<?= $data['product']->stock ?>" title="Quantité" type="number">
                                        <input type="hidden" name="id_product" value="<?= $data['product']->id_product ?>" type="number">
                                        <div class="addtocart__actions">
                                                <button class="tocart" type="submit" title="Ajouter au panier">Ajouter au panier</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                                    <div class="product-addto-links clearfix">
                                    <?php if($isLiked) : ?>
                                            <a class="wishlist is-liked" title="Retirer des favoris" data-root="<?= ROOT ?>" data-id="<?= $data['product']->id_product ?>" onClick="addToWishlist(this)"></a>
                                    <?php else : ?>
                                            <a class="wishlist" title="Ajouter aux favoris" data-root="<?= ROOT ?>" data-id="<?= $data['product']->id_product ?>" onClick="addToWishlist(this)"></a>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product__info__detailed">
                    <div class="pro_details_nav nav justify-content-start" role="tablist">
                        <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-details"
                            role="tab">Description</a>
                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-review" role="tab">Avis</a>
                    </div>
                    <div class="tab__container tab-content">
                        <!-- Start Single Tab Content -->
                        <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                            <div class="description__attribute">
                                <p><?= $data['product']->description ?></p>
                            </div>
                        </div>
                        <!-- End Single Tab Content -->
                        <!-- Start Single Tab Content -->
                        <div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
                            <div class="review__attribute">
                                <?php if(isset($data['feedback']) && !empty($data['feedback'])) : ?>
                                    <h1>Avis de nos lecteurs</h1>
                                    <?php foreach($data['feedback'] as $feedback) : ?>
                                        <h2><i><?= $feedback->summary ?></i></h2>
                                        <p><?= $feedback->review ?></p>
                                        <div class="review__ratings__type d-flex">
                                            <div class="review-ratings">
                                                <div class="rating-summary d-flex">
                                                    <span>Histoire</span>
                                                    <ul class="rating d-flex">
                                                        <?php 
                                                            // Etoiles pleines (répétées autant de fois que la note) :
                                                            echo str_repeat('<li><i class="zmdi zmdi-star"></i></li>', $feedback->story_rating);
                                                            // Etoiles vides, répétées autant de fois que (5 - la note) :
                                                            echo str_repeat('<li class="off"><i class="zmdi zmdi-star"></i></li>', (5 - $feedback->story_rating));
                                                        ?>
                                                    </ul>
                                                </div>

                                                <div class="rating-summary d-flex">
                                                    <span>Prix</span>
                                                    <ul class="rating d-flex">
                                                    <?php 
                                                        // Etoiles pleines (répétées autant de fois que la note) :
                                                        echo str_repeat('<li><i class="zmdi zmdi-star"></i></li>', $feedback->price_rating);
                                                        // Etoiles vides, répétées autant de fois que (5 - la note) :
                                                        echo str_repeat('<li class="off"><i class="zmdi zmdi-star"></i></li>', (5 - $feedback->price_rating));
                                                    ?>
                                                    </ul>
                                                </div>
                                                <div class="rating-summary d-flex">
                                                    <span>Qualité</span>
                                                    <ul class="rating d-flex">
                                                    <?php 
                                                        // Etoiles pleines (répétées autant de fois que la note) :
                                                        echo str_repeat('<li><i class="zmdi zmdi-star"></i></li>', $feedback->quality_rating);
                                                        // Etoiles vides, répétées autant de fois que (5 - la note) :
                                                        echo str_repeat('<li class="off"><i class="zmdi zmdi-star"></i></li>', (5 - $feedback->quality_rating));
                                                    ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="review-content">
                                                <p>Publié par <?= $feedback->username ?></p>
                                                <p>Le <?= date_format(date_create_from_format('Y-m-d H:i:s', $feedback->createdAt), 'jS F Y') ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <h2>Aucun avis n'a été publié.</h2>
                                <?php endif; ?>
                            </div>

                            <?php if(isset($data['user'])) : ?>
                                <form class="review-fieldset" method="POST" action="<?= ROOT . 'product/feedback/' . $data['product']->slug ?>">
                                    <h3><?= "Laisser un avis pour <b><i>" . $data['product']->title . "</i></b> de " . $data['product']->author ?></h3>
                                    <div class="review-field-ratings">
                                        <div class="product-review-table">
                                            <div class="review-field-rating d-flex">
                                                <span>Histoire</span>
                                                <div class="stars__rating">
                                                    <input type="radio" name="rating-story" id="star5-story" value="5" >
                                                    <label for="star5-story"></label>

                                                    <input type="radio" name="rating-story" id="star4-story" value="4" >
                                                    <label for="star4-story"></label>

                                                    <input type="radio" name="rating-story" id="star3-story" value="3" checked >
                                                    <label for="star3-story"></label>

                                                    <input type="radio" name="rating-story" id="star2-story" value="2" >
                                                    <label for="star2-story"></label>

                                                    <input type="radio" name="rating-story" id="star1-story" value="1" >
                                                    <label for="star1-story"></label>
                                                </div>
                                            </div>

                                            <div class="review-field-rating d-flex">
                                                <span>Prix</span>
                                                <div class="stars__rating">
                                                    <input type="radio" name="rating-price" id="star5-price" value="5" >
                                                    <label for="star5-price"></label>

                                                    <input type="radio" name="rating-price" id="star4-price" value="4" >
                                                    <label for="star4-price"></label>

                                                    <input type="radio" name="rating-price" id="star3-price" value="3" checked >
                                                    <label for="star3-price"></label>

                                                    <input type="radio" name="rating-price" id="star2-price" value="2" >
                                                    <label for="star2-price"></label>

                                                    <input type="radio" name="rating-price" id="star1-price" value="2" >
                                                    <label for="star1-price"></label>
                                                </div>
                                            </div>
                                            <div class="review-field-rating d-flex">
                                                <span>Qualité</span>
                                                <div class="stars__rating">
                                                    <input type="radio" name="rating-quality" id="star5-quality" value="5" >
                                                    <label for="star5-quality"></label>

                                                    <input type="radio" name="rating-quality" id="star4-quality" value="4" >
                                                    <label for="star4-quality"></label>

                                                    <input type="radio" name="rating-quality" id="star3-quality" value="3" checked >
                                                    <label for="star3-quality"></label>

                                                    <input type="radio" name="rating-quality" id="star2-quality" value="2" >
                                                    <label for="star2-quality"></label>

                                                    <input type="radio" name="rating-quality" id="star1-quality" value="1" >
                                                    <label for="star1-quality"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review_form_field">
                                        <!-- <div class="input__box">
                                            <span>Nom d"utilisateur</span>
                                            <input id="nickname_field" type="text" name="nickname">
                                        </div> -->
                                        <div class="input__box">
                                            <span>Résumé</span>
                                            <input id="summery_field" type="text" name="summary">
                                        </div>
                                        <div class="input__box">
                                            <span>Avis détaillé</span>
                                            <textarea name="review"></textarea>
                                        </div>
                                        <input type="hidden" name="product_id" value="<?= $data['product']->id_product ?>">
                                        <div class="review-form-actions">
                                            <button type="submit">Publier</button>
                                        </div>
                                    </div>
                                </form>
                            <?php else : ?>
                                <h2>Connectez-vous pour publier un avis.</h2>
                            <?php endif; ?>
                        </div>
                        <!-- End Single Tab Content -->
                    </div>
                </div>

                <!-- Start 'Vous aimerez aussi' -->
                <section class="wn__product__area brown--color pt--80  pb--30">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__title text-center">
                                    <h2 class="title__be--2 ">Vous aimerez aussi...</h2>
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
                                            $subdata['redirect'] = 'cart';
                                        ?>
                                        <?php $this->view("_product-card", $subdata) ?>
                                    </div>
                                    <!-- !Carte d'un produit -->
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <!-- !Chargement de la liste des produits -->
                        </div>
                        <!-- End Single Tab Content -->
                    </div>
                </section>
                <!-- End 'Vous aimerez aussi' -->

                <!-- Start Collections -->
                <section class="wn__product__area brown--color pt--80 pb--30 custom-wrapper">
                    <div class="container">
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

            </div>
        </div>
    </div>
</div>
<!-- End main Content -->

<!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->
    