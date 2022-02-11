<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->


<!-- Start breadcrumb area -->
<div class="ht__breadcrumb__area bg-image--1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__inner text-center">
                    <h1 class="breadcrumb-title">Mon compte</h1>
                    <nav class="breadcrumb-content">
                        <a class="breadcrumb_item" href="<?= ROOT ?>index">Accueil</a>
                        <span class="brd-separator">/</span>
                        <a class="breadcrumb_item" href="<?= ROOT ?>profile">Mon Compte</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End breadcrumb area -->

<!-- Start Profile Area -->
<div class="page-blog bg--white section-padding--lg blog-sidebar right-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12 order-1 order-lg-1 md-mt-40 sm-mt-40">
                <div class="wn__sidebar">
                    <!-- Start Single Widget -->
                    <aside class="widget category_widget">
                        <h3 class="widget-title">Mon compte</h3>
                        <ul>
                            <?php if($data['user']->role > 0) : ?>
                                <li><a href="<?= ROOT . 'admin' ?>"><strong>Administrateur</strong></a></li>
                            <?php endif; ?>
                            <li><a href="<?= ROOT . 'profile/mes-commandes' ?>">Mes commandes</a></li>
                            <li><a href="<?= ROOT . 'profile/mes-favoris' ?>">Mes favoris</a></li>
                            <!-- <li><a href="<?= ROOT . 'settings' ?>">Paramètres du compte</a></li> -->
                            <li><a href="<?= ROOT ?>logout">Déconnexion</a></li>
                        </ul>
                    </aside>
                    <!-- End Single Widget -->
                </div>
            </div>
            <div class="col-lg-9 col-12 order-2 order-lg-2">
                <?php if($data['page_title'] == 'Mon compte') : ?>
                    <div class="blog-page">
                        <div class="page__header">
                            <h2><?php echo "Bienvenue, " . $data['user']->first_name ?></h2>
                        </div>
                    </div>
                
                <?php elseif($data['page_title'] == 'Mes commandes') : ?>
                    <?php $this->view('_profile-orders', $data) ?>
                <?php elseif($data['page_title'] == 'Mes favoris') : ?>
                    <?php $this->view('_profile-wishlist', $data) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- End Profile Area -->

<!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->