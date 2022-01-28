<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->

<!-- Start breadcrumb area -->
<div class="ht__breadcrumb__area bg-image--4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__inner text-center">
                    <h1 class="breadcrumb-title">Connexion</h1>
                    <nav class="breadcrumb-content">
                        <a class="breadcrumb_item" href="index">Accueil</a>
                        <span class="brd-separator">/</span>
                        <span class="breadcrumb_item active">Connexion</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End breadcrumb area -->
<!-- Start My Account Area -->
<section class="my_account_area pt--80 pb--55 bg--white">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-sm-10">
                <div class="my__account__wrapper">
                    <div class="d-flex justify-content-between">
                        <h3 class="account__title">Connexion</h3>
                        <a href="<?= ROOT ?>auth/creer-un-compte">
                            <h3 class="account__title opacity-25">Inscription</h3>
                        </a>
                    </div>
                    <form method="POST">
                        <div class="account__form">
                            <div class="input__box">
                                <label>Adresse email ou nom d'utilisateur <span>*</span></label>
                                <input type="text" name="identifier" value="<?= $_POST['identifier'] ?? "" ?>" required>
                            </div>
                            <div class="input__box">
                                <label>Mot de passe<span>*</span></label>
                                <input type="password" name="password" value="<?= $_POST['password'] ?? "" ?>" required>
                            </div>
                            <div class="form__btn">
                                <button type="submit" >Se connecter</button>
                            <p class="py-2 text-center text-danger" >
                                <?php check_error() ?>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End My Account Area -->

<!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->