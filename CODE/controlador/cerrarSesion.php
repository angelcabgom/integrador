    <?php

    session_start();

    unset($_SESSION['id']);
    unset($_SESSION['userType']);

    if (session_destroy()) {
        header("Location: ../vista/paginaPrincipal.php");
    } else {
        echo "Location: ../vista/paginaPrincipal.php?mensaje=errorCierreSesion";
    }

    ?>