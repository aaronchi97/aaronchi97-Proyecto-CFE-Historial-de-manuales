/<!--el css se encuentra en main.css en la carpeta public/css -->



<nav class="side-menu">




            
    <ul  class="side-menu-list p-0">

              <!-- CONDICION PARA VISTA DE ROLES -->

         <?php

        if ($_SESSION['rol-sinasu'] == 3 ) { 
            ?>
                <li  class="red">
                    <a hidden href="../SINASU/agencias.php" class="activo">
                        <!-- <img src="../public/img-inicio/house.png" class="img-inicio" alt=""> -->
                        <img src="../../public/images/iconos-sinasu/documentacion.svg" class="img-inicio" alt="">
                        <!-- <i class="fas fa-house-user"></i> -->
                        <span class="lbl">AGENCIAS</span>
                    </a>
                </li>
            <?php

            
  
             } else {
         ?>
        
                <li  class="red">
                    <a href="../SINASU/agencias.php" class="activo">
                        <!-- <img src="../public/img-inicio/house.png" class="img-inicio" alt=""> -->
                        <img src="../../public/images/iconos-sinasu/documentacion.svg" class="img-inicio" alt="">
                        <!-- <i class="fas fa-house-user"></i> -->
                        <span class="lbl">AGENCIAS</span>
                    </a>
                </li>
        <?php
 
            }
        ?>

            
              <!-- ----------------------------------------------------------------- -->

        <?php

        if ($_SESSION['rol-sinasu'] == 3 ) { 
            ?>
                 <li class="red">
                    <a hidden  href="usuario-sinasu.php" class="activo">
                        <!-- <img src="../public/img-inicio/house.png" class="img-inicio-1" alt=""> -->
                        <img src="  ../../public/images/iconos-sinasu/usuarios.svg" class="img-inicio" alt="">
                        <!-- <i class="fas fa-house-user"></i> -->
                        <span class="lbl">USUARIOS</span>
                    </a>
                </li>
            <?php

                $mostrarBoton = false;
  
             } else {
         ?>
        
            <li class="red">
                    <a  href="usuario-sinasu.php" class="activo">
                        <!-- <img src="../public/img-inicio/house.png" class="img-inicio-1" alt=""> -->
                        <img src="  ../../public/images/iconos-sinasu/usuario.svg" class="img-inicio" alt="">
                        <!-- <i class="fas fa-house-user"></i> -->
                        <span class="lbl">USUARIOS</span>
                    </a>
                </li>
        <?php
 
            }
        ?>


 <!-- --------------------------------------------------------------------------------------------------- -->
            
                <?php

        if ($_SESSION['rol-sinasu'] != 3 ) { 
            ?>
                <li  class="red">
                    <a hidden href="../SINASU/agencias_filtros.php" class="activo">
                        <!-- <img src="../public/img-inicio/house.png" class="img-inicio-1" alt=""> -->
                        <img src="  ../../public/images/iconos-sinasu/subir2.svg" class="img-inicio" alt="">
                        <!-- <i class="fas fa-house-user"></i> -->
                        <span class="lbl">SUBIR</span>
                    </a>
                    
                </li>
            <?php

            
  
             } else {
         ?>
        
                <li  class="red">
                    <a href="../SINASU/agencias_filtros.php" class="activo">
                        <!-- <img src="../public/img-inicio/house.png" class="img-inicio-1" alt=""> -->
                        <img src="  ../../public/images/iconos-sinasu/subir2.svg" class="img-inicio" alt="">
                        <!-- <i class="fas fa-house-user"></i> -->
                        <span class="lbl">SUBIR</span>
                    </a>
                </li>
        <?php
 
            }
        ?>




    <!-- --------------------------------------------------------------------------------------------------- -->
            
                <?php

        if ($_SESSION['rol-sinasu'] == 3 ) { 
            ?>
                <li  class="red">
                    <a href="docente.php" class="activo">
                        <!-- <img src="../public/img-inicio/house.png" class="img-inicio-1" alt=""> -->
                        <img src="  ../../public/images/iconos-sinasu/revisar2.svg" class="img-inicio" alt="">
                        <!-- <i class="fas fa-house-user"></i> -->
                        <span class="lbl">MI PROGRESO</span>
                    </a>
                    
                </li>
            <?php

            
  
             } else {
         ?>
        
                 <li  class="red">
                    <a href="docente.php" class="activo">
                        <!-- <img src="../public/img-inicio/house.png" class="img-inicio-1" alt=""> -->
                        <img src="  ../../public/images/iconos-sinasu/revisar.svg" class="img-inicio" alt="">
                        <!-- <i class="fas fa-house-user"></i> -->
                        <span class="lbl">REVISIÓN/STATUS</span>
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
                    <a href="acerca-sinasu.php" class="activo">
                        <img src="../../public/images/iconos-sinasu/inicio.svg" class="img-inicio" alt="">
                        <!-- <i class="fas fa-exclamation"></i> -->
                        <span class="lbl">INICIO</span>
                    </a>
                </li>




            </ul>
        </nav>