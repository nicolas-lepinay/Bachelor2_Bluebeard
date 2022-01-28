<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->

<!-- Start breadcrumb area -->
<div class="ht__breadcrumb__area bg-image--4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__inner text-center">
                    <h1 class="breadcrumb-title">Administration</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End breadcrumb area -->

<div class="container">
    <strong class="label switcher-label">
        <?php if(isset($data['user'])) : ?>
            <div class="adminMenu">
                <a href="<?= ROOT ?>admin">Utilisateurs</a>
                <a href="<?= ROOT ?>admin/collectionPage">Collections</a>
                <a href="<?= ROOT ?>admin/productPage">Produits</a>
            </div>
            <table class="adminTable">
                <h4 class="titleTable">Users Table</h4>
                <hr>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Birthdate</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['allUsers'] as $users) : ?>
                        <tr>
                            <form action="<?= ROOT ?>admin/modifUser?uuid=<?= $users->uuid ?>" method="post">
                                <td><input name="firstName" value="<?= $users->first_name ?>"></td>
                                <td><input name="lastName" value="<?= $users->last_name ?>"></td>
                                <td><input name="username" value="<?= $users->username ?>"></td>
                                <td><?= $users->email ?></td>
                                <td><?= $users->createdAt ?></td>
                                <td><?= $users->birthdate ?></td>
                                <td><?= $users->role ?></td>
                                <?php if( $users->role == 0) : ?>
                                    <td>
                                    <input class="submitTable" type="submit" value="✏️" title="Modifier">
                                        <a href="<?= ROOT ?>admin/deleteUser?uuid=<?= $users->uuid ?>" title="Supprimer" >🗑️</a>
                                    </td>
                                <?php else : ?>
                                    <td></td>
                                <?php endif; ?>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </strong>
</div>

<style>
    .adminMenu{
        text-align: center;
    }
    .adminMenu a{
        margin: 30px;
    }
    .titleTable{
        text-align: center;
        margin: 20px;
        margin-top: 40px;
    }
    table{
        margin-bottom: 200px;
    }
    thead {
        background-color: #333;
        color: #FDFDFD;
    }
    tr:nth-child(even) {
        background-color: #eee;
    }
    tbody {
        
        background-color: #DDD;
    }
    td, th{
        font-family: "Poppins", sans-serif;
        padding: 5px;
    }
    input{
        background-color: transparent;
        border: 0px solid;
        font-family: "Poppins", sans-serif;
        color: #333;
    }
    .submitTable:hover{
        color: var(--gold);
    }
</style>


<!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->