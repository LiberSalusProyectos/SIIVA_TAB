<?php session_start(); ?>
<meta charset="utf-8" />
	<nav class="navbar custom-navbar-gray">
        <form class="form-inline">
            <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="custom-dark-blue-color">
                    <i class="fas fa-bars custom-hamburger"></i>
                </span>
            </button>
            <span class="navbar-text text-info ml-3">
                <?php echo $_SESSION['username']." / ".$_SESSION['email']; ?>
            </span>
        </form>
        <?php if (substr_compare(basename($_SERVER['REQUEST_URI']), "patient_pass.php", 0, 15) === 0 || substr_compare(basename($_SERVER['REQUEST_URI']), "register_patient.php", 0, 15) === 0) {?>
            <nav class="navbar">
                <form class="form-inline" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
                    <input class="form-control mr-sm-2 custom-search-bar" type="search" placeholder="" name="search"
                        aria-label="Search"></input>
                    <button class="btn my-2 my-sm-0" type="submit">
                        <span class="custom-dark-blue-color">
                            <i class="fas fa-search custom-search-icon"></i>
                        </span>
                    </button>
                </form>
            </nav>
        <?php }?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register_patient.php">PACIENTES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">CERRAR SESIÓN</a>
                </li>
            </ul>
        </div>
    </nav>