<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->

<!-- Start breadcrumb area -->
<div class="ht__breadcrumb__area bg-image--1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__inner text-center">
                    <h1 class="breadcrumb-title">Page introuvable</h1>
                    <nav class="breadcrumb-content">
                        <a class="breadcrumb_item" href="<?= ROOT ?>index">Accueil</a>
                        <span class="brd-separator">/</span>
                        <span class="breadcrumb_item active">Page introuvable</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End breadcrumb area -->

<!-- Start Error Area -->
<section class="page_error section-padding--lg bg--white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error__inner text-center">
                    <div class="error__content">
                        <h2>Page introuvable</h2>
                        <p>Ooops...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Error Area -->

<!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->
