<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Funciones de Transferencia
        <small>Ball Of Beam (Viga Bola)</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>Mdelsystf">Modelos Matematicos</a>
        </li>
        <li class="breadcrumb-item active">Ball Of Beam (Viga Bola)</li>
      </ol>
     
      <div class="row">  
      <?php echo $menux;  ?>
      <div class="col-lg-9 mb-4">
             <h1>Modelo del Sistema</h1>
             

<p>El viga bola es un sistema medianamente complejo por su grado de inestabilidad, contemplando el sistema de posición del motor eléctrico es un sistema de orden 5 aproximadamente, pero puede aproximarse en la vida real a un sistema de orden dos usando la región lineal.

el modelo que se contemplara dentro de la plataforma es el que se muestra en la figura, debido a su flexibilidad de implementación en código, la identificación matemática es realizada por <b>Creative Commons Attribution.</b>


        <center>
          <img src="<?php echo base_url();?>images/cabecera1/explicar/ballofbeam.png" class="img-fluid" alt="Responsive image">
        </center>



<p>Al analizar el sistema y ver sus comportamientos, cuando se cambia el ángulo $[\alpha]$, se puede ver una variación que afecta directamente la coordenada de la esfera $[r]$ dentro de la viga, al calcular la segunda derivada de $[r]$, se puede apreciar la aceleración de la esfera, esto permite aplicar las ecuaciones de <b><i>Lagrange</i></b> como se muestra en la ecuacion.</p> 

\begin{equation}
    0 = \left (\frac{J}{R^2} + m \right) \ddot r + mg \sin {\alpha} - mr \dot {\alpha}^2
    \label{ecu:vigabola1}
\end{equation}


<p>Al encontrar la aproximación lineal del sistema haciendo $\alpha = 0$, aparece la ecuación, esta permite entender las regiones de trabajo dentro del viga bola, es decir que que la esfera se mantenga en una región de operación determinada.</p>

\begin{equation}
\left (\frac {J} {R ^ 2} + m \right) \ddot {r} = - mg \alpha 
\label{ecu:vigabola2}
\end{equation}

<p>para complementar el sistema se debe hacer lineal el valor de $\alpha$ esto se logra mediante la aproximación de la ecuación:</p>

\begin{equation}
\alpha = \frac{d}{L} \beta 
\label{ecu:vigabola3}
\end{equation}


<p>Remplazando en la ecuación de la descripcion de la esfera, el valor lineal de $\alpha$, obtenido en la ecuación, se puede obtener la relación de la coordenada de la esfera $r$, con el ángulo del engranaje del servo $\beta$  como se ilustra a continuacion.</p>

\begin{equation}
\left(\frac{J}{R ^ 2} + m \right) \ddot{r} = - mg \frac{d}{L} \beta 
\label{ecu:vigabola4}
\end{equation}

<p>Al aplicar la transformación de laplace de la ecuación diferencial, se puede construir la función de transferencia, donde la relación entrada-salida sera la coordenada de la esfera $r$ entre el ángulo generado por el servomotor $\beta$ quedando el sistema como muestra la ecuación:</p>

\begin{equation}
\frac{R(s)}{\beta(s)} = - \frac{mgd} {L \left(\frac{J}{R^2} + m \right)} \frac{1}{s^2}
\label{ecu:vigabola6}
\end{equation}

<p>En la ecuación siguiente, se puede ver un sistema en el cual el ángulo ya esta determinado por los engranajes de un servomotor, no se contempla la existencia de un motor, sin embargo, al acoplar la  función de transferencia construida en la ecuación del motor, indicando que $\theta=\beta$ el sistema completo queda como muestra la ecuación siguiente, empatando la dinámica de viga y bola y el funcionamiento dinámico de un motor de corriente continua.</p>

\begin{equation}
\frac{R(s)}{V(s)} = - \frac{mgd (M_k)} {L s^2 \left(\frac{J}{R^2} + m \right)  \left( JLs^3 + s^2(JR+bL)+ s(Rb+M_k^2) \right)}
\label{ecu:vigabola7}
\end{equation}

<p>Es importante mencionar, que en la ecuación, en el motor no se esta contemplando ningún tipo de controlador, se recomienda aplicar primero el controlador del motor para luego ejecutar el controlador del viga bola, para simplificar procesos matemáticos que es lo que internamente la plataforma hace para hacer los calculos.</p>



      </div>
      </div>

    </div>
    <!-- /.container -->