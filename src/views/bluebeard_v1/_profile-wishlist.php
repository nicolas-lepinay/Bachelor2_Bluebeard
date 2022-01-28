<div class="wishlist-area section-padding--lg bg__white">
    <div class="blog-page px-4">
        <div class="page__header">
            <h2>Mes favoris</h2>
        </div>
                        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <div class="wishlist-table wnro__table table-responsive">
                        <?php if(is_array($data['wishlist']) && !empty($data['wishlist'])) : ?>
                            <table class="wishlist__table">
                                <thead>
                                <tr>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name"><span class="nobr">Titre</span></th>
                                    <th class="product-stock-status"><span class="nobr"> Stock</span></th>
                                    <th class="product-price"><span class="nobr"> Prix </span></th>
                                    <!-- <th class="product-add-to-cart"></th> -->
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data['wishlist'] as $product) : ?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="<?= ROOT . 'product/' . $product->slug ?>" target="_blank"><img src="<?= ROOT . 'products/' . $product->image ?>" alt=""></a></td>
                                            <td class="product-name"><a href="<?= ROOT . 'product/' . $product->slug ?>" target="_blank" ><span class="book__title"><?= $product->title ?></span></a></td>
                                            <td class="product-stock-status">
                                                <?php if($product->stock == 1) : ?>
                                                    <span class="text-warning">Dernier en stock</span>
                                                <?php elseif($product->stock == 0) : ?>
                                                    <span class="text-danger">Rupture de stock</span>
                                                <?php else : ?>
                                                    <span class="text-success">En stock</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="product-price"><span class="nobr"><?= number_format((float)$product->price, 2, '.', '') ?>€</span></td>
                                            <!-- <td class="product-add-to-cart"><a href="#"> Add to Cart</a></td> -->
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <h2>Vous n'avez aucun favoris.</h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .wishlist-area {
        padding-top: 0;
    }
    .order-date {
        text-transform: capitalize;
    }
    .book__title {
        transition: 300ms;
    }
    .book__title:hover {
        color: var(--gold);
    }
    .product-thumbnail a img {
        padding-left: 30px;
        width: 100px;
    }
    .wishlist__table td,
    .wishlist__table th {
        text-align: center; 
        vertical-align: middle;
    }

    .wishlist__table thead {
        background-color: rgb(249, 250, 252);
    }
    .wishlist__table td.product-name {
        padding: 0 20px;
    }
    .wishlist__table th,
    .wishlist__table td {
        padding: 15px 30px;
    }
</style>