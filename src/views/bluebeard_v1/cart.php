<!-- Header -->
<?php $this->view("_header", $data) ?>
<!-- !Header -->

<!-- SI UN PANIER EXISTE : -->

<?php if(isset($data['cart'])) : ?>
    <!-- Breadcrumb area -->
    <div class="ht__breadcrumb__area bg-image--1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__inner text-center">
                        <h1 class="breadcrumb-title">Votre panier</h1>
                        <nav class="breadcrumb-content">
                            <a class="breadcrumb_item" href="<?= ROOT ?>index">Accueil</a>
                            <span class="brd-separator">/</span>
                            <span class="breadcrumb_item active">Mon panier</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- !Breadcrumb area -->
    <!-- Cart-main-area -->
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    <form method="POST" action="<?= ROOT . 'cart/update' ?>">
                        <div class="table-content wnro__table table-responsive">
                            <table>
                                <thead>
                                <tr class="title-top">
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">Livre</th>
                                    <th class="product-price">Prix</th>
                                    <th class="product-quantity">Quantité</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove "><span class="invisible">Supprimer</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($data['cart'] as $product) : ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="<?= ROOT ?>product/<?= $product->slug ?>">
                                                <img class="w-50" src="<?= ROOT ?>products/<?= $product->image ?>" alt="Image">
                                            </a>
                                        </td>
                                        <td class="product-name"><a href="<?= ROOT ?>product/<?= $product->slug ?>"><?= $product->title . "<br>" . "(" . $product->author . ")" ?></a></td>
                                        <td class="product-price"><span class="amount"><?= number_format((float)$product->price, 2, '.', '') ?>€</span></td>
                                        <td class="product-quantity"><input name="<?= $product->id_product ?>" value="<?= $product->quantity ?>" min="1" max="<?= $product->stock ?>" type="number"></td>
                                        <td class="product-subtotal"><?= number_format((float)$product->price * $product->quantity, 2, '.', '') ?>€</td>
                                        <td class="product-remove"><a href="<?= ROOT ?>cart/remove/<?= $product->id_product ?>">✖</a></td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                <li>
                                    <button type="submit" formaction="<?= ROOT . 'cart/update' ?>" style="background-color: transparent; border: none">
                                        <a>Mettre à jour</a>
                                    </button>
                                </li>

                                <li>
                                    <a href="<?= ROOT . 'checkout' ?>">Commander</a>
                                </li>          
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-6">
                    <div class="cartbox__total__area">
                        <div class="cartbox-total d-flex justify-content-between">
                            <ul class="cart__total__list">
                                <li>Sous-total</li>
                                <li>Frais de port</li>
                            </ul>

                            <?php $total = 0;
                                foreach($data['cart'] as $product) : $total += (float)$product->price * $product->quantity ?>
                            <?php endforeach; ?>
                            <ul class="cart__total__tk">
                                <li><?= number_format($total, 2, '.', '') ?>€</li>
                                <li>GRATUIT</li>
                            </ul>
                        </div>
                        <div class="cart__total__amount">
                            <span>Total</span>
                            <span><?= number_format($total, 2, '.', '') ?>€</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- !Cart-main-area -->

<!-- SI LE PANIER EST VIDE : -->

<?php else : ?>
    <div>
        <img src="<?= ASSETS . THEME . 'images/bg/empty-cart-black.webp' ?>" style="width:100%" alt="">
        <div class="text__box container position-absolute">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <p>Votre panier est vide...</p>
                <a href="<?= ROOT . "catalogue" ?>">Parcourir</a>
            </div>
        </div>
    </div>

    <!-- Start Loading Screen -->
    <?php $this->view("_loading") ?>
    <!-- End Loading Screen -->
<?php endif; ?>

<!-- Footer -->
<?php 
    $data['option'] = 'no footer image';
    $this->view("_footer", $data) 
    ?>
<!-- !Footer -->

<style>
    .text__box {
        margin-top: 500px;
        top: 0;
        right: 50vw;
        width: 50%;
    }
    .text__box p {
        color: rgba(60, 60, 60);
        font-family: 'Bluu Next';
        font-size: 50px;
        font-weight: 800;
        line-height: 1.2;
        padding: 20px 60px;
    }
    .text__box a {
        background-color: rgba(60, 60, 60);
        border-radius: 100px;
        color: white;
        margin: 50px 0;
        padding: 10px 35px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        width: 150px;
    }

    @media only screen and (max-width: 1300px) {
        .text__box {
            margin-top: 300px;
        }
        .text__box p {
            font-size: 30px;
    }
    @media only screen and (max-width: 900px) {
        .text__box {
            margin-top: 200px;
        }
        .text__box p {
            font-size: 20px;
        }
    }
    @media only screen and (max-width: 690px) {
        .text__box {
            margin-top: 100px;
        }
        .text__box p {
            font-size: 20px;
        }
    }
    @media only screen and (max-width: 540px) {
        .text__box a {
            display: none;
        }
    }
}
</style>