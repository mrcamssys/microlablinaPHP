<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Funciones de Transferencia
        <small>Aeropendulo</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>Mdelsystf">Modelos Matematicos</a>
        </li>
        <li class="breadcrumb-item active">Aeropendulo</li>
      </ol>
     
      <div class="row">  
      <?php echo $menux;  ?>
      <div class="col-lg-9 mb-4">
             <h1>Modelo del Sistema</h1>
             
El modelo matemático usado para esta representación, fue desarrollada por \textbf{Giampero Campa miembro de la IEEE }, consiste en dar una demostración lineal del modelo, esta se ajusta a las características de la plataforma, pues es un sistema de segundo orden y adicional a ello se  puede implementar dentro de las librerías construidas dentro del programa.

        <center>
          <img src="<?php echo base_url();?>images/cabecera1/explicar/arpentf.png" class="img-fluid" alt="Responsive image">
        </center>


la dinámica del comportamiento del péndulo esta dada por la ecuación siguiente, esta involucra los parámetros de fricción peso de las vara y las fuerzas que trabajan en este sistema.

\begin{equation}
\label{cap4:ecu1}
    \begin{split}
        mL^2 \ddot \theta = -mg sen \theta - c \dot \theta + TL
    \end{split}
\end{equation}

Teniendo en cuenta que $T$ es la fuerza que ejerce la hélice, la descripción de esta, sera proporcional a la cantidad de energía de energía de propulsión $\mu$ por el el coeficiente de empuje, remplazando esto en la ecuación anterior, se obtiene la solución de la ecuación.

\begin{equation}
\label{cap4:ecu2}
    \begin{split}
        mL^2 \ddot \theta = -mg sen \theta - c \dot \theta + TK\mu
    \end{split}
\end{equation}
Definiendo el sistema bajo una región de trabajo lineal diciendo que el valor de los parámetros en estado estacionario esta dado por la ecuación siguiente, se puede llegar a la función de transferencia lineal.

\begin{equation}
\label{cap4:ecu3}
    \begin{split}
        sin \theta_{ss}= \frac{K}{mg}\mu_{ss}
    \end{split}
\end{equation}

La función de transferencia del sistema, esta dada por la ecuación siguiente, esta se usara dentro de la plataforma para hacer las simulaciones del sistema del aeropendulo \(\Theta(s)\) es el ángulo de salida y \(W(s)\) es la energía con la que se alimenta el sistema.

\begin{equation}
\label{cap4:ecu4}
    \begin{split}
        \frac{\Theta(s)}{W(s)}=\frac{KL}{mgL^2+cs}
    \end{split}
\end{equation}








      </div>
      </div>

    </div>
    <!-- /.container -->