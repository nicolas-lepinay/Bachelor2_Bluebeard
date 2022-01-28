<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->
        

<!-- Start breadcrumb area -->
<div class="ht__breadcrumb__area bg-image--1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__inner text-center">
                    <h1 class="breadcrumb-title">Votre commande</h1>
                    <nav class="breadcrumb-content">
                        <a class="breadcrumb_item" href="<?= ROOT . 'index' ?>">Accueil</a>
                        <span class="brd-separator">/</span>
                        <span class="breadcrumb_item active">Ma commande</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End breadcrumb area -->

<!-- Start Checkout Area -->
<section class="wn__checkout__area section-padding--lg bg__white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- (1) SI L'UTILISATEUR EST CONNECTE : -->
                <?php if(isset($data['user'])) : ?>
                    <div class="wn_checkout_wrap">
                        <div class="checkout_info">
                            <span><?= 'Bienvenue, ' . $data['user']->first_name . '.' ?></span>
                        </div>
                    </div>
                <!-- (2) SI L'UTILISATEUR N'A PAS ENCORE DE COMPTE : -->
                <?php else : ?>
                    <div class="wn_checkout_wrap">
                        <div class="checkout_info">
                            <span>Déjà client ?</span>
                            <a class="showlogin" href="#">Connectez-vous.</a>
                        </div>
                        <div class="checkout_login">
                            <!-- FORMULAIRE DE CONNEXION -->
                            <form class="wn__checkout__form" method="POST" action="<?= ROOT . 'auth/login/' . 'checkout' ?>">
                                <div class="input__box">
                                    <label>Adresse email ou nom d'utilisateur :</label>
                                    <input type="text" name="identifier" value="<?= $_POST['identifier'] ?? "" ?>" required>
                                </div>

                                <div class="input__box">
                                    <label>Mot de passe :</label>
                                    <input type="password" name="password" value="<?= $_POST['password'] ?? "" ?>" required>
                                </div>
                                <div class="form__btn">
                                    <button type="submit" >Se connecter</button>
                                    <p class="py-2 text-danger"> <?php check_error() ?></p>
                                </div>
                            </form>
                            <!-- !FORMULAIRE DE CONNEXION -->
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- !FORMULAIRE DE COMMANDE -->
        <form id="confirm-form" method="POST" action="<?= ROOT . 'checkout/confirm' ?>">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="customer_details">
                        <!-- Affichage des erreurs éventuelles -->
                        <p class="pb-4 text-center text-danger"><?php check_error() ?></p>
                        <!-- !Affichage des erreurs éventuelles -->
                        <h3>Informations de facturation</h3>
                        <div class="customar__field">
                            <div class="input_box">
                                <label>Titre de l'adresse</label>
                                <input type="text" name="billing-title" placeholder="Mon adresse" value="<?= array_reverse($data['addresses'])[0]->title ?? "" ?>">
                            </div>
                            <div class="margin_between">
                                <div class="input_box space_between">
                                    <label>Prénom <span>*</span></label>
                                    <input type="text" name="billing-first_name" placeholder="Barbe" value="<?= array_reverse($data['addresses'])[0]->first_name ?? "" ?>" required>
                                </div>
                                <div class="input_box space_between">
                                    <label>Nom <span>*</span></label>
                                    <input type="text" name="billing-last_name" placeholder="Bleue" value="<?= array_reverse($data['addresses'])[0]->last_name ?? "" ?>" required>
                                </div>
                            </div>
                            <div class="input_box">
                                <label>Adresse <span>*</span></label>
                                <input type="text" name="billing-street" placeholder="6, Chemin de l'Orée du Bois, Paris" value="<?= array_reverse($data['addresses'])[0]->street ?? "" ?>" required>
                            </div>
                            <div class="margin_between">
                                <div class="input_box space_between">
                                    <label>Code postal <span>*</span></label>
                                    <input type="text" name="billing-zipcode" placeholder="75000" value="<?= array_reverse($data['addresses'])[0]->zipcode ?? "" ?>" required>
                                </div>
                                <div class="input_box space_between">
                                    <label>Pays <span>*</span></label>
                                    <select name="billing-country" class="select__option">
                                    <option disabled>Choisissez un pays…</option>
                                        <option value="France" selected>France</option>
                                        <option value="Belgique" >Belgique</option>
                                        <option value="Suisse" >Suisse</option>
                                    </select>
                                </div>
                            </div>
                            <!-- SI L'UTILISATEUR N'A PAS ENCORE DE COMPTE, IL DOIT S'EN CREER UN : -->
                            <?php if(!isset($data['user'])) : ?>
                                <div class="margin_between">
                                    <div class="input_box space_between">
                                        <label>Adresse email <span>*</span></label>
                                        <input type="email" name="signup-email" placeholder="barbe.bleue@royaumedefrance.fr" required>
                                    </div>
                                    <div class="input_box space_between">
                                        <label>Nom d'utilisateur <span>*</span></label>
                                        <input type="text" name="signup-username" placeholder="LaBarbeBleue" required>
                                    </div>
                                </div>
                                <div class="input_box">
                                    <label>Mot de passe <span>*</span></label>
                                    <input type="password" name="signup-password" required>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="customer_details mt--20">
                        <div class="differt__address">
                            <input id="ship_to_same_address" name="shipping-address" value="billing-address" type="radio" checked="true" >
                            <span>L'adresse de livraison est identique.</span>
                        </div>
                        <div class="customar__field differt__form mt--40" style="display: none;">
                        <h3>Informations de livraison</h3>
                        <div id="accordion" class="checkout_accordion mt--30 mb--30" role="tablist">
                            <div class="payment">
                                <input id="add-new-address" name="shipping-address" value="new-address" type="radio" >
                                <div class="che__header" role="tab" id="heading-0">
                                    <label for="add-new-address" class="checkout__title" data-bs-toggle="collapse" href="#collapse-0"
                                    aria-expanded="true" aria-controls="collapse-0">
                                        <span style="font-weight:900;">AJOUTER UNE NOUVELLE ADRESSE</span>
                                    </label>
                                </div>
                                <div id="collapse-0" class="collapse" role="tabpanel" aria-labelledby="heading-0"
                                        data-bs-parent="#accordion">
                                    <div class="payment-body">
                                        <div class="input_box">
                                            <label>Titre de l'adresse</label>
                                            <input type="text" name="shipping-title" placeholder="Mon adresse">
                                        </div>
                                        <div class="margin_between">
                                            <div class="input_box space_between">
                                                <label>Prénom <span>*</span></label>
                                                <input type="text" name="shipping-first_name" placeholder="Barbe">
                                            </div>
                                            <div class="input_box space_between">
                                                <label>Nom <span>*</span></label>
                                                <input type="text" name="shipping-last_name" placeholder="Bleue">
                                            </div>
                                        </div>
                                        <div class="input_box">
                                            <label>Adresse <span>*</span></label>
                                            <input type="text" name="shipping-street" placeholder="6, Chemin de l'Orée du Bois, Paris">
                                        </div>
                                        <div class="margin_between">
                                            <div class="input_box space_between">
                                                <label>Code postal <span>*</span></label>
                                                <input type="text" name="shipping-zipcode" placeholder="75000">
                                            </div>
                                            <div class="input_box space_between">
                                                <label>Pays<span>*</span></label>
                                                <select name="shipping-country" class="select__option">
                                                    <option disabled>Choisissez un pays…</option>
                                                    <option value="France" selected>France</option>
                                                    <option value="Belgique" >Belgique</option>
                                                    <option value="Suisse" >Suisse</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- TOUTES LES ADRESSES DE L'UTILISATEUR -->
                            <?php if(isset($data['addresses'])) : ?>
                                <?php foreach(array_reverse($data['addresses']) as $address) : ?>
                                    <div class="payment">
                                        <input id="<?= 'my-address-' . $address->id_address ?>" name="shipping-address" value="<?= $address->id_address ?>" type="radio" >
                                        <div class="che__header" role="tab" id="heading-<?= $address->id_address ?>">
                                            <label for="<?= 'my-address-' . $address->id_address ?>" class="checkout__title" data-bs-toggle="collapse" href="#collapse-<?= $address->id_address ?>"
                                                aria-expanded="true" aria-controls="collapse-<?= $address->id_address ?>">
                                                <span><?= $address->title ?></span>
                                            </label>
                                        </div>
                                        <div id="collapse-<?= $address->id_address ?>" class="collapse" role="tabpanel" aria-labelledby="heading-<?= $address->id_address ?>"
                                                data-bs-parent="#accordion">
                                            <div class="payment-body">
                                                <p><strong>Destinataire</strong> : <?= $address->first_name . ' ' . $address->last_name ?></p>
                                                <p><strong>Adresse</strong> : <?= $address->street ?></p>
                                                <p><strong>Code postal</strong> : <?= $address->zipcode ?></p>
                                                <p><strong>Pays</strong> : <?= $address->country ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <!-- !TOUTES LES ADRESSES DE L'UTILISATEUR -->
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__order__box">
                        <h3 class="order__title">Votre commande</h3>
                        <ul class="order__total">
                            <li>Produit</li>
                            <li>Total</li>
                        </ul>
                        <ul class="order_product">
                            <?php foreach($data['cart'] as $product) : ?>
                                <li>
                                    <a href="<?= ROOT ?>product/<?= $product->slug ?>" target="_blank">
                                        <?= $product->title . " × " . $product->quantity ?> <span><?= number_format((float)$product->price * $product->quantity, 2, '.', '') ?>€</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <ul class="shipping__method">
                            <?php $total = 0;
                                foreach($data['cart'] as $product) : $total += (float)$product->price * $product->quantity ?>
                            <?php endforeach; ?>
                            <li>Sous-total <span><?= number_format($total, 2, '.', '') ?>€</span></li>
                            <li>Expédition
                                <ul>
                                    <li>
                                        <input type="hidden" id="shipping__fees__value" name="shipping_fees" value="0">
                                        <span id="shipping__fees">GRATUIT</span>
                                    </li>
                                    <!-- <li>
                                        <input name="shipping_method[0]" data-index="0" value="legacy_flat_rate"
                                                checked="checked" type="radio">
                                        <label>GRATUIT</label>
                                    </li> -->
                                    <!-- <li>
                                        <input name="shipping_method[0]" data-index="0" value="legacy_flat_rate"
                                                checked="checked" type="radio">
                                        <label>GRATUIT</label>
                                    </li> -->
                                </ul>
                            </li>
                        </ul>
                        <ul class="total__amount">
                            <li>Total de la commande <span><?= number_format($total, 2, '.', '') ?>€</span></li>
                        </ul>
                    </div>
                    <div id="accordion" class="checkout_accordion mt--30" role="tablist">
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingOne">
                                <a class="checkout__title" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Carte bancaire</span>
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="payment-body"><i>Bientôt disponible.</i>
                                </div>
                            </div>
                        </div>
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingTwo">
                                <a class="collapsed checkout__title" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span>PayPal</span>
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                <div class="payment-body">
                                    <span>Payer avec votre compte PayPal.</span>
                                    <!-- <button type="submit">Confirmer</button> -->
                                    <input id="paypal-raw-data" type="hidden" name="paypal-raw-data">
                                    <div id="paypal-button-container"></div>

                                </div>
                            </div>
                        </div>

                        <!-- <div class="payment">
                            <div class="che__header" role="tab" id="headingThree">
                                <a class="collapsed checkout__title" data-bs-toggle="collapse" href="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    <span>Cash on Delivery</span>
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree"
                                    data-bs-parent="#accordion">
                                <div class="payment-body">Pay with cash upon delivery.</div>
                            </div>
                        </div> -->

                        <!-- <div class="payment">
                            <div class="che__header" role="tab" id="headingFour">
                                <a class="collapsed checkout__title" data-bs-toggle="collapse" href="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                    <span>PayPal <img src="images/icons/payment.png" alt="payment images"> </span>
                                </a>
                            </div>
                            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour"
                                    data-bs-parent="#accordion">
                                <div class="payment-body">Pay with cash upon delivery.</div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </form>
        <!-- !FORMULAIRE DE COMMANDE -->
    </div>
</section>
<!-- End Checkout Area -->


    <!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->

<style>
    input::placeholder {
        opacity: 0.5;
    }
    input::placeholder {
        opacity: 0.5;
    }
    #paypal-button-container {
        left: 0;
        right: 0;
        margin: 30px auto;
        width: 50%;
    }
</style>


<script>
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= number_format($total, 2, '.', '') ?>',
                        currency: 'EUR',
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                document.getElementById("paypal-raw-data").value = JSON.stringify(details);
                document.getElementById("confirm-form").submit();
            })
        },
        onCancel: function(data) {
           window.location.replace('<?= ROOT . "home/failure" ?>');
        }

    }).render('#paypal-button-container');
</script>