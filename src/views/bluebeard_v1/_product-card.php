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


<!-- Start Single Product Card -->
<div class="product__thumb">
    <a class="first__img" href="<?= ROOT ?>product/<?= $data['product']->slug ?>">
        <img src="<?= ROOT . 'products/' . $data['product']->image ?>" alt="<?= $data['product']->title ?>">
    </a>
    <?php if($data['product']->stock == 0) : ?>
        <div class="hot__box">
            <span class="hot-label">Rupture</span>
        </div>
    <?php endif; ?>
</div>
<div class="product__content">
    <h4><?= $data['product']->title ?></h4>
    <h4><?= $data['product']->author ?></h4>
    <ul class="price d-flex">
        <li><?= number_format((float)$data['product']->price, 2, '.', '') ?>€</li>
    </ul>
    <div class="action d-flex justify-content-center">
        <div class="actions_inner">
            <ul class="add_to_links">
                <?php if($data['product']->stock > 0) : ?>
                    <li>
                        <!-- Contrôleur : Cart  //  Méthode : add()  //  $redirect : $data['redirect'] ou 'home' -->
                        <form method ="POST" action="<?= ROOT . 'cart/add/' . $data['redirect'] ?? 'home' ?>">
                            <input type="hidden" name="id_product" value="<?= $data['product']->id_product ?>" type="number">
                            <a class="cart" title="Ajouter au panier">
                                <button type="submit" style="background-color: transparent; border:none">
                                    <i class="fa fa-shopping-bag"></i>
                                </button>
                            </a>
                        </form>
                    </li>
                <?php endif; ?>

                <?php if($isLiked) : ?>
                    <li>
                        <a class="wishlist is-liked" title="Retirer des favoris" data-root="<?= ROOT ?>" data-id="<?= $data['product']->id_product ?>" onClick="addToWishlist(this)">
                            <i class="fa fa-heart"></i>
                        </a>
                    </li>
                <?php else : ?>
                    <li>
                        <a class="wishlist" title="Ajouter aux favoris" data-root="<?= ROOT ?>" data-id="<?= $data['product']->id_product ?>" onClick="addToWishlist(this)">
                            <i class="fa fa-heart"></i>
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <?php
                        $json_product = json_encode(['id' => $data['product']->id_product, 'title' => str_replace("'", "’", $data['product']->title), 'author' => str_replace("'", "’", $data['product']->author), 'price' => $data['product']->price, 'description' => str_replace("'", "’", $data['product']->description), 'image' => $data['product']->image, 'stock' => $data['product']->stock ]);
                    ?>
                    <a data-bs-toggle="modal" 
                        title="Aperçu"
                        class="quickview modal-view detail-link" 
                        href="#productmodal"
                        onclick='sendDataToModal(<?= $json_product ?>);'>
                        <i class="fa fa-search"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Single Product Card -->

<script>
    // function addToWishlist() {
    //     var ajax = new XMLHttpRequest();

    //     ajax.addEventListener('readystatechange', function(){
    //         if(ajax.readyState == 4 && ajax.status == 200) {
    //             console.log(ajax.responseText);
    //         }
    //     });
    //     ajax.open("POST", "<?= ROOT . 'product/wishlist/' . $data['product']->id_product ?>", true);
    //     ajax.send();
    // }
</script>

