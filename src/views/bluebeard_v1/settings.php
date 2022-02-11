<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->

<!-- Start breadcrumb area -->
<div class="ht__breadcrumb__area bg-image--5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__inner text-center">
                    <h2 class="breadcrumb-title">Détails du compte</h2>
                    <nav class="breadcrumb-content">
                        <a class="breadcrumb_item" href="<?= ROOT ?>index">Accueil</a>
                        <span class="brd-separator">/</span>
                        <a class="breadcrumb_item" href="<?= ROOT ?>profile">Mon compte</a>
                        <span class="brd-separator">/</span>
                        <span class="breadcrumb_item active">Détails du compte</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End breadcrumb area -->

<div class="container">
    <h1>Paramètres du compte:</h1>
    <br>
    <br>
    <!-- <h3>Pseudo: <?php echo $data['user']->username ?></h3>
    </br>
    <h3>Nom: <?php echo $data['user']->last_name ?></h3>
    </br>
    <h3>Prénom: <?php echo $data['user']->first_name ?></h3>
    </br>
    <h3>Adresse Mail: <?php echo $data['user']->email ?></h3>
    </br>
    <h3>Role: 
        <?php if($data['user']->role==0) : ?>
            Utilisateur
        <?php else : ?>
            Administrateur
        <?php endif; ?>
    </h3>
    </br> -->
    <form method="POST">
        <div class="input__box">
            <label class="mb-1">Nouveau Pseudo</label>
            <div class="d-flex mb-3">
                <a style="padding-right: 15px; cursor: pointer;"><img onclick="edit('new_username')" src="<?= ASSETS . THEME ?>images/icons/edit.png" alt="Edit" height="42" width="42"></a>
                <input type="text" class="form-control" name="new_username" id="new_username" value="<?= $_POST['new_username'] ?? $data['user']->username ?>" >
            </div>
        </div>
        <div class="input__box">
            <label class="mb-1">Nouveau Nom</label>
            <div class="d-flex mb-3">
                <a style="padding-right: 15px; cursor: pointer;"><img onclick="edit('new_first_name')" src="<?= ASSETS . THEME ?>images/icons/edit.png" alt="Edit" height="42" width="42"></a>
                <input type="text" class="form-control" name="new_last_name" id="new_last_name" value="<?= $_POST['new_last_name'] ?? $data['user']->last_name ?>" >
            </div>
        </div>
        <div class="input__box">
            <label class="mb-1">Nouveau Prénom</label>
            <div class="d-flex mb-3">
                <a style="padding-right: 15px; cursor: pointer;"><img onclick="edit('new_last_name')" src="<?= ASSETS . THEME ?>images/icons/edit.png" alt="Edit" height="42" width="42"></a>
                <input type="text" class="form-control" name="new_first_name" id="new_first_name" value="<?= $_POST['new_first_name'] ?? $data['user']->first_name ?>" >
            </div>
        </div>
        <div class="input__box">
            <label class="mb-1">Nouvelle Adresse Mail</label>
            <div class="d-flex mb-3">
                <a style="padding-right: 15px; cursor: pointer;"><img onclick="edit('new_email')" src="<?= ASSETS . THEME ?>images/icons/edit.png" alt="Edit" height="42" width="42"></a>
                <input type="email" class="form-control" name="new_email" id="new_email" value="<?= $_POST['new_email'] ?? $data['user']->email ?>" >
            </div>
        </div>
        <div class="input__box">
            <label class="mb-1">Role</label>
            <input type="text" class="form-control mb-3" placeholder="<?php if($data['user']->role==0) : ?>Utilisateur<?php else : ?>Administrateur<?php endif; ?>" name="role" disabled >
        </div>
        <div>
            <button type="submit" style="color:white" class="btn btn-info">Modifier</button>
        </div>
        <p class="py-2 text-center text-danger">
            <?php check_error() ?>
        </p>
    </form>
    <br>
    <br>
</div>


<!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->

<script>
function edit(elementId) {
    if(document.getElementById(elementId).disabled == false) {
        document.getElementById(elementId).disabled = true;
    } else {
        document.getElementById(elementId).disabled = false;
    }
}
</script>
