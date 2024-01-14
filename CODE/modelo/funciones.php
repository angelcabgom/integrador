    <?php

    // recoge un array con las direcciones a las hojas de estilos tanto
    // comunes como dinamicas 
    function incluirEstilos($styles)
    {
        foreach ($styles as $stylesheet) {
            echo "<link rel=stylesheet type=text/css href='$stylesheet'>";
        }
    }


    ?>