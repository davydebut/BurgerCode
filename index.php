        <?php
        include 'partials/header.php';
        ?>
        <div class="container site">

            <h1 class="text-logo"><span class="bi-shop"></span> Burger Code <span class="bi-shop"></span></h1>

            <?php
            require 'admin/database.php';

            echo '<nav class="navbar">
                        <ul class="nav nav-pills" role="tablist">';

            $db = Database::connect();
            $statement = $db->query('SELECT * FROM categories');
            $categories = $statement->fetchAll();
            foreach ($categories as $category) {
                if ($category['id'] == '1') {
                    echo '<li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab' . $category['id'] . '" role="tab">' . $category['name'] . '</a></li>';
                } else {
                    echo '<li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="pill" data-bs-target="#tab' . $category['id'] . '" role="tab">' . $category['name'] . '</a></li>';
                }
            }
            echo    '</ul>';
            ?>
            <form action="index.php" class="d-flex row justify-content-end nav">
                <!-- connexion -->
                <div class="col-md-6">
                    <div class="form-group nav-pills">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link">connexion</a>
                        </li>
                    </div>
                </div>
                <!-- inscription -->
                <div class="col-md-6">
                    <div class="form-group nav-pills">
                        <li class="nav-item" role="presentation">
                            <a href="inscription.php" class="nav-link">inscription</a>
                        </li>
                    </div>
                </div>
            </form>
            <?php
            echo      '</nav>';

            echo '<div class="tab-content">';

            foreach ($categories as $category) {
                if ($category['id'] == '1') {
                    echo '<div class="tab-pane active" id="tab' . $category['id'] . '" role="tabpanel">';
                } else {
                    echo '<div class="tab-pane" id="tab' . $category['id'] . '" role="tabpanel">';
                }

                echo '<div class="row">';

                $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
                $statement->execute(array($category['id']));
                while ($item = $statement->fetch()) {
                    echo '<div class="col-md-6 col-lg-4">
                                <div class="img-thumbnail">
                                    <img src="img/' . $item['image'] . '" class="img-fluid" alt="...">
                                    <div class="price">' . number_format($item['price'], 2, '.', '') . ' €</div>
                                    <div class="caption">
                                        <h4>' . $item['name'] . '</h4>
                                        <p>' . $item['description'] . '</p>
                                        <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
                                    </div>
                                </div>
                            </div>';
                }

                echo    '</div>
                        </div>';
            }
            Database::disconnect();
            echo  '</div>';
            ?>

        </div>
        </body>

        </html>