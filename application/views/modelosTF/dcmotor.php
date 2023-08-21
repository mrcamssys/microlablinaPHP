<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Funciones de Transferencia
        <small>Motor de Corriente Continua</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>">Pagina Principal</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>Mdelsystf">Modelos Matematicos</a>
        </li>
        <li class="breadcrumb-item active">Teoria Motor DC</li>
      </ol>
     
      <div class="row">  
      <?php echo $menux;  ?>
      <div class="col-lg-9 mb-4">
             <h1>Modelo del Sistema</h1>
             <p>los parámetros que se muestran en la tabla, son las variables internas que afectan directamente el comportamiento del motor, de ello de penderá la función de transferencia y los estados de operación del actuador.
            </p>
            <center>
          <img src="<?php echo base_url();?>images/cabecera1/explicar/MotorDC.jpg" class="img-fluid" alt="Responsive image">
          </center>

            <h3>Velocidad</h3>
            <p>Considerando la tabla anterior, se procede a relacionar las variable del sistema comenzando, por el par motor \([T]\) que es igual a la corriente que circula por la armadura \([i_a]\) por la Fuerza Electromotriz \([K_t]\)  generada por los imanes como se ilustra en la ecuación.</p>


            \begin{equation}
            T=k_t i_a
            \label{ecu:parmotor}
            \end{equation}    

            <p>
            los elementos de la armadura \([e]\) con proporcionales a la velocidad angular del eje \([\dot \theta]\) por un factor constante de Par Motor \([k_e]\) como se muestra en la ecuacion:.

            </p>
            \begin{equation}
            e=k_e \dot \theta
            \label{ecu:armadura}
            \end{equation} 

            <p>
            Al usar la segunda ley de newton donde indica "si se aplica una fuerza a un cuerpo, éste se acelera." <tippens2010>, \( f=ma \) entonces se puede derivar las ecuacion, esto adicionalmente, permite usar las leyes de voltaje de  Kirchhoff, para construir la relación entre la tensión \([V]\) y el ángulo \([T]\).
            </p>

            \begin{equation}
            \begin{split}
                j \ddot \theta + b \dot \theta =& k_i i\\
                L \frac{di}{dt} + Ri=& v - k_e \dot \theta
            \end{split}
            \label{ecu:derivemotor1}
            \end{equation} 



            <p>Para la facilidad del proyecto y la construcción del modelado, se puede usar la unidades SI, indicando que \( K_t = K_e  \)  creando una nueva variable denominada \(M_k\) remplazando y haciendo la transformación de Laplace queda la ecuación:
            </p>
            \begin{equation}
            \begin{split}
                j \theta(s) s^2 + b  \theta(s) s =& M_k i(s)\\
                L s i(s) + Ri(s) =& v(s) - M_k s \theta(s)
            \end{split}
            \label{ecu:derivemotor2}
            \end{equation} 
            <p> 
            Factorando queda la ecuación: 
            </p>
            \begin{equation}
            \begin{split}
                \theta(s) (j  s^2 + b s) =& M_k i(s)\\
                i(s)(L s  + R) =& v(s) - M_k s \theta(s)
            \end{split}
            \label{ecu:derivemotor3}
            \end{equation} 
            <p>
            Al despejar \(i(s)\) de las dos ecuaciones y remplazarlas, se puede obtener la función de transferencia que relaciona la velocidad angular \([\theta]\) con la fuente de alimentación continua \([V]\) tal como se muestra en la ecuacion: .
            </p>
            \begin{equation}
            \begin{split}
                \frac{\dot \theta(s)}{v(s)}=\frac{M_k}{JLs^2 + s(JR+bL)+ Rb+M_k^2}
            \end{split}
            \label{ecu:tfmotorv}
            \end{equation} 

            <h3>Posición</h3>
            <p>
            Como es de saber la velocidad es la derivada de la posición, \(v(t) = \frac{dx}{dt}\), al tener la ecuación de la tranformacion de laplace, que es la velocidad angular del eje del motor, se puede calcular su posición integrando la función de transferencia, quedando la ecuación.
            </p>
            \begin{equation}
            \begin{split}
                \frac{\theta(s)}{v(s)}=\frac{M_k}{JLs^3 + s^2(JR+bL)+ s(Rb+M_k^2)}
            \end{split}
            \label{ecu:tfmotorp}
            \end{equation} 
      </div>
      </div>

    </div>
    <!-- /.container -->