<div class="wishlist-area section-padding--lg bg__white">
    <div class="blog-page px-4">
        <div class="page__header">
            <h2>Mes commandes</h2>
        </div>
                        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <div class="wishlist-table wnro__table table-responsive">
                        <?php if(is_array($data['orders']) && !empty($data['orders'])) : ?>
                            <?php foreach($data['orders'] as $order) : ?>
                                <table class="orders__table mb-5">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="product-thumbnail">Commande #<?= $order[0]->order_id ?> </th>
                                            <th colspan="1"  class="product-price"><span class="amount"> <?= number_format((float)$order[0]->total, 2, '.', '') ?>€</span></th>
                                            <th colspan="1" class="product-stock-stauts"><span class="order-date"><?= date_format(date_create_from_format('Y-m-d H:i:s', $order[0]->createdAt), 'jS F Y') ?></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($order as $product) : ?>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="<?= ROOT . 'product/' . $product->slug ?>" target="_blank"><img src="<?= ROOT . 'products/' . $product->image ?>" alt=""></a>
                                                </td>
                                                <td class="product-name"><a href="<?= ROOT . 'product/' . $product->slug ?>" target="_blank" ><span class="book__title"><?= $product->title ?></span></a></td>
                                                <td class="product-stock-status"><span><?= $product->author ?></span></td>
                                                <td class="product-price"><span class="nobr"><?= number_format((float)$product->price, 2, '.', '') ?>€</span></td>
                                                <td class="product-add-to-cart"><?= ' × ' . $product->quantity ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <h2>Vous n'avez aucune commande.</h2>
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
</style>