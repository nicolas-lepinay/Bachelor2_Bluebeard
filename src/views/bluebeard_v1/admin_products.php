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

<strong class="label switcher-label">
<?php if(isset($data['user'])) : ?>
    <div class="adminMenu">
        <a href="<?= ROOT ?>admin">Utilisateurs</a>
        <a href="<?= ROOT ?>admin/collectionPage">Collections</a>
        <a href="<?= ROOT ?>admin/productPage">Produits</a>
    </div>
    <form class="addFormTable" action="<?= ROOT ?>admin/createProduct" method="post">
        <h4 class="titleTable">Add new product</h4>
        <input name="title" placeholder="Titre" value="">
        <input name="author" placeholder="Auteur" value="">
        <input name="description" placeholder="Description" value="">
        <input name="price" placeholder="Prix" value="">
        <input name="stock" placeholder="Stock" value="">
        <input name="weight" placeholder="Poids" value="">
        <br>
        <!-- <a>Image :</a><input type="file" name="image" accept="image/png, image/jpeg" value=""> -->
        <input name="collectionId" placeholder="Id Collection" value="">
        <br>
        <input class="submitTable" type="submit" value="Add Product">
    </form>
    <table>
            <h4 class="titleTable">Product Table</h4>
            <hr>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Weigth</th>
                    <th>Image</th>
                    <!-- <th></th> -->
                    <th>Id Collection</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['products'] as $products) : ?>
                    <tr>
                        <form action="<?= ROOT ?>admin/modifProduct?id=<?= $products->id_product ?>" method="post">
                            <td><input name="title" value="<?= $products->title ?>"></td>
                            <td><input name="author" value="<?= $products->author ?>"></td> 
                            <td><input name="description" value="<?= $products->description ?>"></td> 
                            <td><input name="price" value="<?= $products->price ?>"></td>
                            <td><input name="stock" value="<?= $products->stock ?>"></td>
                            <td><input name="weight" value="<?= $products->weight ?>"></td>
                            <td><?= $products->image ?></td>
                            <!-- <td><input type="file" name="image" accept="image/png, image/jpeg" value=""></td> -->
                            <td><input name="collectionId" value="<?= $products->collection_id ?>"></td> 
                            <td><?= $products->createdAt ?></td>    
                            <td>
                                <input class="submitTable" type="submit" value="✏️" title="Modifier">
                                <a href="<?= ROOT ?>admin/deleteProduct?id=<?= $products->id_product ?>" title="Supprimer" >🗑️</a>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</strong>
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
            margin-bottom: 30px;
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
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    </style>

<!-- Start Footer -->
<?php $this->view("_footer") ?>
<!-- End Footer -->