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

<!-- Start Single Product -->
<div class="list__view mt--40">
    <div class="thumb">
        <a class="first__img" href="<?= ROOT ?>product/<?= $data['product']->slug ?>">
            <img src="<?= ROOT . 'products/' . $data['product']->image ?>" alt="<?= $data['product']->title ?>">
        </a>
        <?php if($data['product']->stock == 0) : ?>
            <div class="hot__box">
                <span class="hot-label">Rupture</span>
            </div>
        <?php endif; ?>
    </div>

    <div class="content">
        <h2><a href="<?= ROOT ?>product/<?= $data['product']->slug ?>"><?= $data['product']->title ?></a></h2>
        <h2><a><?= $data['product']->author ?></a></h2>
        <ul class="price__box">
            <li><?= number_format((float)$data['product']->price, 2, '.', '') ?>€</li>
        </ul>
        <p><?= substr($data['product']->description, 0, 300) . "..." ?></p>
        <ul class="cart__action d-flex">
            <li class="cart">
                <!-- Contrôleur : Cart  //  Méthode : add()  //  $redirect : $data['redirect'] ou 'catalogue' -->
                <form method="POST" action="<?= ROOT . 'cart/add/' . $data['redirect'] ?? 'catalogue'; ?>">
                    <input type="hidden" name="id_product" value="<?= $data['product']->id_product ?>" type="number">
                    <?php if($data['product']->stock > 0) : ?>
                        <div class="addtocart-btn m-0">
                            <button class="tocart" type="submit" title="Ajouter au panier" style="background-color: transparent; border: none; color: white"> 
                                <a>Ajouter au panier</a>
                            </button>
                        </div>
                    <?php endif; ?>
                </form>
            </li>
            <?php if($isLiked) : ?>
                <li class="wishlist is-liked" title="Retirer des favoris" data-root="<?= ROOT ?>" data-id="<?= $data['product']->id_product ?>" onClick="addToWishlist(this)">
                    <a></a>
                </li>
            <?php else : ?>
                <li class="wishlist" title="Ajouter aux favoris" data-root="<?= ROOT ?>" data-id="<?= $data['product']->id_product ?>" onClick="addToWishlist(this)">
                    <a></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<style>
    .thumb .hot__box {
        background: crimson none repeat scroll 0 0;
        color: #fff;
        display: inline-block;
        font-size: 10px;
        font-weight: 600;
        left: 0;
        line-height: 15px;
        min-width: 55px;
        padding: 4px 10px;
        position: absolute;
        text-align: center;
        text-transform: uppercase;
        top: 0px;
        z-index: 3;
    }
    .thumb .hot__box::after {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: transparent transparent transparent crimson;
        border-image: none;
        border-style: solid;
        border-width: 6px;
        content: "";
        margin-top: -6px;
        position: absolute;
        right: -11px;
        top: 50%;
    }
</style>

<!-- End Single Product -->