<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->

<!-- Start breadcrumb area -->
<div class="ht__breadcrumb__area bg-image--1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__inner text-center">
                    <h2 class="breadcrumb-title"><?= $data['page_title'] ?></h2>
                    <nav class="breadcrumb-content">
                        <a class="breadcrumb_item" href="<?= ROOT ?>index">Accueil</a>
                        <span class="brd-separator">/</span>
                        <span class="breadcrumb_item active"><?= $data['page_title'] ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End breadcrumb area -->

<!-- Start Shop Page -->
<div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 order-1 md-mt-40 sm-mt-40">
                <div class="shop__sidebar">
                <aside class="widget__categories products--cat">
                        <h3 class="widget__title"><?= $data['page_title'] ?></h3>
                        <ul>
                            <li>
                                <a href="<?= ROOT . 'catalogue' ?>"><strong>Tous nos livres</strong></a>
                            </li>
                            <!-- Chargement de la liste des collections -->
                            <?php if(is_array($data['collections'])) : ?>
                                <?php foreach($data['collections'] as $collection) : ?>
                                    <li>
                                        <a href="<?= ROOT . 'catalogue/' .  $collection->slug ?>"><?= $collection->name ?></a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <!-- !Chargement de la liste des collections -->
                        </ul>
                    </aside>
                    <aside class="widget__categories pro--range">
                        <h3 class="widget__title">Filtrer par prix</h3>
                        <div class="content-shopby">
                            <div class="price_filter s-filter clear">
                                <form action="#" method="GET">
                                    <div id="slider-range"></div>
                                    <div class="slider__range--output">
                                        <div class="price__output--wrap">
                                            <div class="price--output">
                                                <span>Prix :</span><input type="text" id="amount" readonly="">
                                            </div>
                                            <div class="price--filter">
                                                <a href="#">Filtrer</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </aside>
                    <!-- <aside class="widget__categories products--tag">
                        <h3 class="widget__title">Product Tags</h3>
                        <ul>
                            <li><a href="#">Biography</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Cookbooks</a></li>
                            <li><a href="#">Health & Fitness</a></li>
                            <li><a href="#">History</a></li>
                            <li><a href="#">Mystery</a></li>
                            <li><a href="#">Inspiration</a></li>
                            <li><a href="#">Religion</a></li>
                            <li><a href="#">Fiction</a></li>
                            <li><a href="#">Fantasy</a></li>
                            <li><a href="#">Music</a></li>
                            <li><a href="#">Toys</a></li>
                            <li><a href="#">Hoodies</a></li>
                        </ul>
                    </aside> -->
                </div>
            </div>
            <div class="col-lg-9 col-12 order-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                            <div class="shop__list nav justify-content-center" role="tablist">
                                <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-grid" role="tab">
                                    <i class="fa fa-th"></i>
                                </a>
                                <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-list" role="tab">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- VUE EN LIGNE -->
                <div class="tab__container tab-content">
                    <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                        <div class="row">
                            <!-- Start Single Product -->
                            <?php if(is_array($data['products']) && !empty($data['products'])) : ?>
                                <?php foreach($data['products'] as $product) : ?>
                                    <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                        <?php 
                                            $subdata['product'] = $product; 
                                            $subdata['wishlist'] = $data['wishlist'] ?? []; 
                                            $subdata['redirect'] = 'catalogue';
                                        ?>
                                        <?php $this->view("_product-card", $subdata) ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h2>Aucun résultat.</h2>
                            <?php endif; ?>
                            <!-- End Single Product -->
                        </div>
                    </div>

                    <!-- VUE EN COLONNE (LISTE) -->
                    <div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
                        <div class="list__view__wrapper">
                            <!-- Start Single Product (list view) -->
                            <?php if(is_array($data['products']) && !empty($data['products'])) : ?>
                                <?php foreach($data['products'] as $product) : ?>
                                    <?php 
                                        $subdata['product'] = $product; 
                                        $subdata['wishlist'] = $data['wishlist'] ?? []; 
                                        $subdata['redirect'] = 'catalogue';
                                    ?>
                                    <?php $this->view("_product-list", $subdata) ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h2>Aucun résultat.</h2>
                            <?php endif; ?>
                            <!-- End Single Product (list view) -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Shop Page -->

<?php 
    $data['redirect'] = 'catalogue';
    $this->view("_quickview", $data);
?>

<!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->
