<!doctype html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $data['page_title'] ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= ASSETS . THEME ?>images/favicon.ico">
    <link rel="apple-touch-icon" href="<?= ASSETS . THEME ?>images/icon.png">

    <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= ASSETS . THEME ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ASSETS . THEME ?>css/plugins.css">
    <link rel="stylesheet" href="<?= ASSETS . THEME ?>css/style.css">
    
    <!-- Custom css -->
    <link rel="stylesheet" href="<?= ASSETS . THEME ?>css/custom.css">

    <!-- Modernizer JS -->
    <script src="<?= ASSETS . THEME ?>js/vendor/modernizr-3.5.0.min.js"></script>
    
    <!-- PayPal -->
    <script src="https://www.paypal.com/sdk/js?client-id=<?= PAYPAL_CLIENT_ID . "&currency=EUR" . "&disable-funding=card" ?>"></script>

</head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
    <!-- Header -->
    <header id="wn__header" class="header__area header__absolute sticky__header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">

                <div class="">
                    <nav class="mainmenu__nav">
                        <ul class="meninmenu d-flex justify-content-start">

                            <li class="drop">
                                <span class="hamburger-icon" ></span>
                                <div class="megamenu mega03">
                                    <ul class="item item03">
                                        <li class="title">Collections</li>
                                        <li><a href="<?= ROOT . 'catalogue' ?>"><strong>Tous nos livres</strong></a></li>
                                        <!-- Chargement de la liste des collections -->
                                        <?php if(is_array($data['collections'])) : ?>
                                            <?php foreach($data['collections'] as $collection) : ?>
                                                <li><a href="<?= ROOT . 'catalogue/' .  $collection->slug ?>"><?= $collection->name ?></a></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <!-- !Chargement de la liste des collections -->
                                    </ul>
                                    <ul class="item item03">
                                        <li class="title">Auteurs</li>
                                        <li><a href="<?= ROOT . 'catalogue/author/rowling' ?>">J.K. Rowling</a></li>
                                        <li><a href="<?= ROOT . 'catalogue/author/tolkien' ?>">J.R.R. Tolkien</a></li>
                                        <li><a href="<?= ROOT . 'catalogue/author/lewis' ?>">C.S. Lewis</a></li>
                                        <li><a href="<?= ROOT . 'catalogue/author/lovecraft' ?>">H.P. Lovecraft</a></li>
                                        <li><a href="<?= ROOT . 'catalogue/author/sabuda' ?>">Robert Sabuda</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </nav>
                </div>
                
                <div class="">
                    <div class="logo">
                        <a href="<?= ROOT ?>index">
                            <img src="<?= ASSETS . THEME ?>images/logo/logo.png" alt="Bluebeard">
                        </a>
                    </div>
                </div>
                
                <div class="">
                    <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                        <!-- Search Icon  -->
                        <li class="shop_search">
                            <a class="search__active" href="#" title="Barre de recherche"></a>
                        </li>
                        <!-- Search Icon  -->

                        <!-- Wishlist  -->

                        <li class="wishlist">
                            <?php if(isset($data['user']) && isset($data['wishlist'])) : ?>
                                <a href="<?= ROOT . 'profile/mes-favoris'?>" title="Mes favoris"></a>
                            <?php else : ?>
                                <a title="Connectez-vous pour accéder à vos favoris"></a>
                            <?php endif; ?>
                        </li>
                        <!-- !Wishlist  -->

                        <!-- Cart  -->
                        <li class="shopcart">
                            <a class="cartbox_active" href="#" title="Mon panier">
                                <?php if(isset($data['cart'])) : ?>
                                    <span class="product_qun"><?= count($data['cart']) ?></span>
                                <?php endif; ?>
                            </a>
                            <!-- Start Shopping Cart -->
                            <div class="block-minicart minicart__active">
                                <div class="minicart-content-wrapper">
                                    <div class="micart__close">
                                        <span>Fermer</span>
                                    </div>

                                    <!-- Chargement du panier -->
                                    <?php if(isset($data['cart'])) : ?>
                                    <div class="single__items">
                                        <div class="miniproduct">
                                            <?php foreach($data['cart'] as $product) : ?>
                                                <div class="item01 d-flex mt--20">
                                                    <div class="thumb">
                                                        <a href="product-details.html">
                                                            <img src="<?= ROOT ?>products/<?= $product->image ?>" alt="Image">
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h6><a href="product-details.html"><?= $product->title ?></a></h6>
                                                        <span class="price"><?= number_format((float)$product->price, 2, '.', '') ?>€</span>
                                                        <div class="product_price d-flex justify-content-between">
                                                            <span class="qun">Quantité : <?= $product->quantity ?></span>
                                                            <ul class="d-flex justify-content-end">
                                                                <!-- <li><a href="#"><i class="zmdi zmdi-settings"></i></a>
                                                                </li> -->
                                                                <li><a href="<?= ROOT ?>cart/remove/<?= $product->id_product ?>"><i class="zmdi zmdi-delete"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <!-- !Chargement du panier -->
                                    <div class="mini_action cart">
                                        <a class="cart__btn" href="<?= ROOT ?>cart">Voir le panier</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Shopping Cart -->
                        </li>
                        <!-- !Cart  -->
                        
                        <!-- Profile  -->
                        <li class="setting__bar__icon">
                            <a class="setting__active" href="#" title="Mon compte" ></a>
                            <div class="searchbar__content setting__block">
                                <div class="content-inner">
                                    <div class="switcher-currency">
                                        <strong class="label switcher-label">
                                            <?php if(isset($data['user'])) : ?>
                                                <span><a href="<?= ROOT ?>profile"><?php echo "Bonjour, " . $data['user']->first_name ?></a></span>
                                            <?php else : ?>
                                                <span>Mon compte</span>
                                            <?php endif; ?>
                                        </strong>
                                        <div class="switcher-options">
                                            <div class="switcher-currency-trigger">
                                                <div class="setting__menu">
                                                    <?php if(isset($data['user'])) : ?>
                                                        <span><a href="<?= ROOT ?>profile/mes-commandes">Mes commandes</a></span>
                                                        <span><a href="<?= ROOT ?>profile/mes-favoris">Mes favoris</a></span>
                                                        <span><a href="<?= ROOT ?>auth/se-deconnecter">Déconnexion</a></span>
                                                    <?php else : ?>
                                                        <span><a href="<?= ROOT ?>auth/se-connecter">Connexion</a></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- !Profile  -->
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- //Header -->

    <!-- Start Search Popup -->
    <div class="brown--color box-search-content search_active block-bg close__top">
        <form method="GET" action="<?= ROOT . 'catalogue/search' ?>" id="search_mini_form" class="minisearch">
            <div class="field__search">
                <input type="text" name="keywords" placeholder="Cherchez un livre...">
                <div class="action">
                    <a><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>Fermer</span>
        </div>
    </div>
    <!-- End Search Popup -->

    

<style>
    .header__area .mainmenu__nav li.drop > span {
        align-self: center;
        background: center / contain no-repeat url("<?= ASSETS . THEME ?>images/icons/hamburger-menu-transparent.png");
        height: 60px;
        width: 60px;
    }
    .is-sticky.header__area .mainmenu__nav li.drop > span {
        align-self: center;
        background: center / contain no-repeat url("<?= ASSETS . THEME ?>images/icons/hamburger-menu.png");
        height: 50px;
        width: 50px;
    }
</style>

    
