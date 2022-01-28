<div id="quickview-wrapper">
    <!-- Modal -->
    <div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal__container" role="document">
            <div class="modal-content">
                <div class="modal-header modal__header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-product">
                        <!-- Start product images -->
                        <div class="product-images">
                            <div class="main-image images">
                                <img id="quickview-modal-image" src="<?= ROOT . 'products/' ?>" alt="Image">
                            </div>
                        </div>
                        <!-- end product images -->
                        <div class="product-info">
                            <h1 id="quickview-modal-title">Untitled</h1>
                            <h1 id="quickview-modal-author">Unknown</h1>
                            <div class="price-box-3">
                                <div class="s-price-box">
                                    <span class="new-price" id="quickview-modal-price">0.00€</span>
                                </div>
                            </div>
                            <div class="quick-desc" id="quickview-modal-description">
                                Aucune information n'est disponible.
                            </div>

                            <!-- Contrôleur : Cart  //  Méthode : add()  //  $redirect : $data['redirect'] ou 'cart' -->
                            <form method="POST" action="<?= ROOT . 'cart/add/' . $data['redirect'] ?? 'cart' ?>">
                                <input id="quickview-modal-id" type="hidden" name="id_product" type="number">
                                <div class="addtocart-btn">
                                    <button class="tocart" type="submit" title="Ajouter au panier" style="background-color: transparent; border: none; color: white"> 
                                        <a>Ajouter au panier</a>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const sendDataToModal = ({ id, title, author, price, description, image, stock }) => {
        $('#quickview-modal-id').val(id);
        $('#quickview-modal-title').text(title);
        $('#quickview-modal-author').text(author);
        $('#quickview-modal-price').text(parseFloat(price).toFixed(2) + "€");
        $('#quickview-modal-description').text(description.slice(0, 300) + " ...");
        $('#quickview-modal-image').attr('src', "<?php echo ROOT . 'products/' ?>" + image);

        if(stock == 0) {
            $('button.tocart').prop('disabled', true);
            $('button.tocart > a').text("Rupture");
        }
    }
</script>