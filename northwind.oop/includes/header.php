<?php

?>
<header>
    <div class="jumbotron">
        <div class="container">
            <h1>
                <a href="/" style="text-decoration:none;color:inherit;" target="_parent">
                    <span style="font-family:Cinzel;">North</span>
                    <span style="font-family:Courgette;margin-left:-12px;">Wind</span>
                </a>
                Demo Store
            </h1>
            <h3>
                <?php
                if(isset($pageTitle))
                    echo $pageTitle;
                else
                    echo 'Welcome To The NorthWind Store!';
                ?>
            </h3>
        </div>
    </div>
</header>