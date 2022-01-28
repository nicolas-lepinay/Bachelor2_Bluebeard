<!-- Footer Area -->
<?php if(isset($data['option']) && $data['option'] == 'no footer image') : ?>
    <!-- Ne rien afficher -->
<?php else : ?>
    <div>
        <img src="<?= ASSETS . THEME . 'images/footer.png' ?>" alt="">
    </div>
<?php endif; ?>

<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
    <div class="footer-static-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__widget footer__menu">
                        <div class="footer__content">
                            <ul class="mainmenu d-flex justify-content-center">
                                <li><a href="<?= ROOT ?>index">Nouveautés</a></li>
                                <li><a href="<?= ROOT ?>index">Meilleures ventes</a></li>
                                <li><a href="<?= ROOT ?>index">Tous les auteurs</a></li>
                                <li><a href="<?= ROOT ?>index">Favoris</a></li>
                                <li><a href="<?= ROOT ?>index">Blog</a></li>
                                <li><a href="<?= ROOT ?>index">Contact</a></li>
                            </ul>
                            <ul class="social__net social__net--2 d-flex justify-content-center">
                                <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                                <li><a href="#"><i class="bi bi-google"></i></a></li>
                                <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                                <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                                <li><a href="#"><i class="bi bi-youtube"></i></a></li>
                            </ul>
                        </div>

                        <div class="ft__logo">
                            <p>
                                Des livres rigoureusement sélectionnés pour leur qualité, leur rareté et l’exigence de leur exécution. De véritables objets d’art, le plus souvent en édition limitée.
                                Car oui, nous le savons, votre passion est dévorante, et la nôtre aussi. Découvrez dès aujourd’hui nos livres de collections pour démarrer ou enrichir votre bibliothèque.
                                Préparez-vous à être émerveillés !
                            </p>         
                            <a href="<?= ROOT ?>index">
                                <img src="<?= ASSETS . THEME ?>images/logo/logo-footer.png" alt="Bluebeard Logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- //Footer Area -->


</div>
<!-- !Main wrapper -->

<!-- JS Files -->
<script src="<?= ASSETS . THEME ?>js/vendor/jquery.min.js"></script>
<script src="<?= ASSETS . THEME ?>js/popper.min.js"></script>
<script src="<?= ASSETS . THEME ?>js/vendor/bootstrap.min.js"></script>
<script src="<?= ASSETS . THEME ?>js/plugins.js"></script>
<script src="<?= ASSETS . THEME ?>js/active.js"></script>

<style>*{scrollbar-width: thin;}</style>

</body>

</html>