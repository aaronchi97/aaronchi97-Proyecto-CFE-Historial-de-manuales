<!--el css se encuentra en main.css en la carpeta public/css -->
<nav class="side-menu">

    <ul class="side-menu-list p-0">
        <!-- <li class="red">
            <a href="manuales.php" class="activo">
                
                <img src="../public/images/iconos-cfe/manuales-cfe.svg" class="img-inicio" alt="">
               
                <span class="lbl">MANUALES</span>
            </a>
        </li> -->


        <li class=" with-sub green ">

            <span class="activo">

                <img src="../public/images/iconos-cfe/manuales-cfe.svg" class="img-inicio" alt="">
                <span class="lbl"> MANUALES </span>
            </span>

            <ul>
                <li>
                    <a href="registro_manuales.php" class="">

                        <span class="lbl"> <i class="fa-solid fa-plus"></i> Generar </span>
                    </a>
                </li>
                <li>
                    <a href="manuales.php" class="">

                        <span class="lbl"><i class="fa-solid fa-list-check"></i> Listados </span>
                    </a>
                </li>

                <li>
                    <a href="historial_general_manuales.php" class="">

                        <span class="lbl"><i class="fa-regular fa-floppy-disk"></i> Historial </span>
                    </a>
                </li>

                <li>
                    <a href="estadisticos_manuales.php" class="">

                        <span class="lbl"><i class="fa-solid fa-chart-simple"></i> Estadístico</span>
                    </a>
                </li>

                <li>
                    <a href="estadisticos_manuales.php" class="">

                        <span class="lbl"><i class="fa-solid fa-clipboard-question"></i> Emplazamiento</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class=" with-sub red ">

            <span class="activo">

                <img src="../public/images/iconos-cfe/negativas-cfe.svg" class="img-inicio" alt="">
                <span class="lbl"> NEGATIVAS </span>
            </span>

            <ul>

                <li>
                    <a href="registro_negativas.php" class="">

                        <span class="lbl"> <i class="fa-solid fa-plus"></i> Generar </span>
                    </a>
                </li>
                <li>
                    <a href="negativas.php" class="">

                        <span class="lbl"> <i class="fa-solid fa-list-check"></i> Listado</span>
                    </a>
                </li>

                <li>
                    <a href="historial_general_negativas.php" href="" class="">

                        <span class="lbl"><i class="fa-regular fa-floppy-disk"></i> Historial</span>
                    </a>
                </li>

                <li>
                    <a href="estadisticos_negativas.php" class="">

                        <span class="lbl"> <i class="fa-solid fa-chart-simple"></i> Estadísticos</span>
                    </a>
                </li>
            </ul>
        </li>







        <!-- <li class=" with-sub red">
            
            <a href="negativas.php" class="activo">
                
                <img src="../public/images/iconos-cfe/negativas-cfe.svg" class="img-inicio" alt="">
                
                <span class="lbl">NEGATIVAS</span>
            </a>

        </li> -->





        <!-- CONDICION PARA VISTA DE ROLES -->

        <?php

        if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 4) {
        ?>
            <li class="red">
                <a hidden href="usuario.php" class="activo">
                    <!-- <img src="../public/img-inicio/house.png" class="img-inicio-1" alt=""> -->
                    <img src="  ../public/images/iconos-cfe/usuarios-cfe.svg" class="img-inicio" alt="">
                    <!-- <i class="fas fa-house-user"></i> -->
                    <span class="lbl">USUARIOS</span>
                </a>
            </li>
        <?php

            $mostrarBoton = false;
        } else {
        ?>

            <li class="red">
                <a href="usuario.php" class="activo">
                    <!-- <img src="../public/img-inicio/house.png" class="img-inicio-1" alt=""> -->
                    <img src="  ../public/images/iconos-cfe/usuarios-cfe.svg" class="img-inicio" alt="">
                    <!-- <i class="fas fa-house-user"></i> -->
                    <span class="lbl">USUARIOS</span>
                </a>
            </li>
        <?php

        }
        ?>


        <!-- <li class="grey with-sub">
                    <span>
                        <img src="../public/img-inicio/programar.png" class="img-inicio" alt=""> 
                        <i class="fas fa-sort-amount-up-alt"></i>
                       <span class="lbl">CITAS</span>
                    </span>
                    <ul>
                        <li>
                            <a href="" class="">
                                <i class="fas fa-plus-square icono-submenu"></i>
                                <span class="lbl">Registrar cita</span>
                            </a>
                        </li>
                        <li>
                            <a href="" class="">
                                <i class="fas fa-th-list icono-submenu"></i>
                                <span class="lbl">Lista de citas</span>
                            </a>
                        </li>
                    </ul>
                </li>       -->


        <li class="red">
            <a href="acerca.php" class="activo">
                <img src="../public/images/iconos-cfe/acerca-cfe.svg" class="img-inicio" alt="">
                <!-- <i class="fas fa-exclamation"></i> -->
                <span class="lbl">INICIO</span>
            </a>
        </li>




    </ul>
</nav>