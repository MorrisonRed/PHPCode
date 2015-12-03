<!--Layout HEADER-->
<?php include '/Views/Shared/Layout_Header.php';?>

<div id="content_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="well">
                    <ul class="list-unstyled">
                    <?php
                    foreach($posts as $post){
                        echo "<li>";
                        echo "<a href=\"/store/productsearch.php\">".$post['title'].'</a>';
                        echo "</li>";
                    }
                    ?>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="well">
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                        praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias
                        excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui
                        officia deserunt mollitia animi.
                </div>
            </div>
        </div>
    </div>
</div>

<!--Layout FOOTER-->
<?php include '/Views/Shared/Layout_Footer.php';?>
