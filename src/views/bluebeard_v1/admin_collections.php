<!-- Start Header -->
<?php $this->view("_header", $data) ?>
<!-- End Header -->

<!-- Start breadcrumb area -->
<div class="ht__breadcrumb__area bg-image--4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__inner text-center">
                    <h1 class="breadcrumb-title">Administration</h2>
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
            <form class="addFormTable" action="<?= ROOT ?>admin/createCollection" method="post">
                <h4 class="titleTable">Add new collection</h4>
                <input name="name" placeholder="Name" value="">
                <!-- <a>Image :</a><input type="file" name="image" accept="image/png, image/jpeg" value=""> -->
                <br>
                <input class="submitTable" type="submit" value="Add Collection">
            </form>
            <table>
                <h4 class="titleTable">Collections Table</h4>
                <hr>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['collections'] as $collections) : ?>
                        <tr>
                            <form action="<?= ROOT ?>admin/modifCollection?id=<?= $collections->id_collection ?>" method="post">
                                <td><input name="name" value="<?= $collections->name ?>"></td>
                                <td><?= $collections->image ?></td>
                                <!-- <td><input type="file" name="image" accept="image/png, image/jpeg" value=""></td>                -->
                                <td>
                                <input class="submitTable" type="submit" value="✏️" title="Modifier">
                                    <a href="<?= ROOT ?>admin/deleteCollection?id=<?= $collections->id_collection ?>" title="Supprimer">🗑️</a>
                                </td>
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
    .addFormTable{
        text-align: center;
        font-family: "Poppins", sans-serif;
        color: #333;
    }
    .addFormTable input{
        margin: 30px;
        margin-left: 10px;
        
    }
    .addFormTable .submitTable{
        background-color: transparent;
        border: 0px solid;
        border: 1px solid #333;
    }
    .addFormTable .submitTable:hover{
        border: 1px solid var(--gold);
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
    table input{
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