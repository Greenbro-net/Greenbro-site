<?php

echo
"<header class=\"header\" id=\"header\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-2 col-md-2 col-sm-12  header__logo\">
                    <a href=\"../index.php\">GreenBro</a>
                    
                    <div id=\"burger-menu-button\">
                        <div id=\"line-1\"></div>
                        <div id=\"line-2\"></div>
                        <div id=\"line-3\"></div>
                    </div>
                    
                </div>
                <div class=\"col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 navigation\" >
                    <nav>";

require_once "sidebar.php";

echo
"</nav>
                </div>
            </div>
            
        <div id=\"burger-menu\">
        <ul>
            <li><a href=\"foods.php\">Продукти</a></li>
            <li><a href=\"clothes.php\">Одяг</a></li>
            <li><a href=\"goods.php\">Речі</a></li>
            <li><a href=\"books.php\">Література</a></li>
            <li><a href=\"recipe.php\">Рецепти</a></li>
            <li><a href=\"other.php\"> Інше</a></li>
        </ul>
    </div>
    </header> ";