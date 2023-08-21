
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `avatar` (
  `id_avatar` int(11) NOT NULL,
  `figura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `cargo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `cargo`) VALUES
(1, 'Docente'),
(2, 'Estudiante'),
(3, 'Ingeniero'),
(4, 'Visitante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos_laplace`
--

CREATE TABLE `modelos_laplace` (
  `id_planta` int(11) NOT NULL,
  `id_usuarios` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `numerador` varchar(255) NOT NULL,
  `denominador` varchar(255) NOT NULL,
  `descrip` text NOT NULL,
  `puedever` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modelos_laplace`
--

INSERT INTO `modelos_laplace` (`id_planta`, `id_usuarios`, `nombre`, `numerador`, `denominador`, `descrip`, `puedever`) VALUES
(1, 1, 'Motor DC posición', 'K', 'J*L, J*R + b*L, R*b+K**2', '<p>los parámetros que se muestran en el simulador, son las variables internas que afectan directamente el comportamiento del motor, de ello de penderá la función de transferencia y los estados de operación del actuador.\r\n            </p>\r\n            <center>\r\n          <img src=\"http://localhost/nueva/images/cabecera1/explicar/MotorDC.jpg\" class=\"img-fluid\" alt=\"Responsive image\">\r\n          </center>\r\n\r\n            <h3>Velocidad</h3>\r\n            <p>Considerando la tabla anterior, se procede a relacionar las variable del sistema comenzando, por el par motor \\([T]\\) que es igual a la corriente que circula por la armadura \\([i_a]\\) por la Fuerza Electromotriz \\([K_t]\\)  generada por los imanes como se ilustra en la ecuación.</p>\r\n\r\n\r\n            \\begin{equation}\r\n            T=k_t i_a\r\n            \\label{ecu:parmotor}\r\n            \\end{equation}    \r\n\r\n            <p>\r\n            los elementos de la armadura \\([e]\\) con proporcionales a la velocidad angular del eje \\([\\dot \\theta]\\) por un factor constante de Par Motor \\([k_e]\\) como se muestra en la ecuacion:.\r\n\r\n            </p>\r\n            \\begin{equation}\r\n            e=k_e \\dot \\theta\r\n            \\label{ecu:armadura}\r\n            \\end{equation} \r\n\r\n            <p>\r\n            Al usar la segunda ley de newton donde indica \"si se aplica una fuerza a un cuerpo, éste se acelera.\" <tippens2010>, \\( f=ma \\) entonces se puede derivar las ecuacion, esto adicionalmente, permite usar las leyes de voltaje de  Kirchhoff, para construir la relación entre la tensión \\([V]\\) y el ángulo \\([T]\\).\r\n            </p>\r\n\r\n            \\begin{equation}\r\n            \\begin{split}\r\n                j \\ddot \\theta + b \\dot \\theta =& k_i i\\\\\r\n                L \\frac{di}{dt} + Ri=& v - k_e \\dot \\theta\r\n            \\end{split}\r\n            \\label{ecu:derivemotor1}\r\n            \\end{equation} \r\n\r\n\r\n\r\n            <p>Para la facilidad del proyecto y la construcción del modelado, se puede usar la unidades SI, indicando que \\( K_t = K_e  \\)  creando una nueva variable denominada \\(M_k\\) remplazando y haciendo la transformación de Laplace queda la ecuación:\r\n            </p>\r\n            \\begin{equation}\r\n            \\begin{split}\r\n                j \\theta(s) s^2 + b  \\theta(s) s =& M_k i(s)\\\\\r\n                L s i(s) + Ri(s) =& v(s) - M_k s \\theta(s)\r\n            \\end{split}\r\n            \\label{ecu:derivemotor2}\r\n            \\end{equation} \r\n            <p> \r\n            Factorando queda la ecuación: \r\n            </p>\r\n            \\begin{equation}\r\n            \\begin{split}\r\n                \\theta(s) (j  s^2 + b s) =& M_k i(s)\\\\\r\n                i(s)(L s  + R) =& v(s) - M_k s \\theta(s)\r\n            \\end{split}\r\n            \\label{ecu:derivemotor3}\r\n            \\end{equation} \r\n            <p>\r\n            Al despejar \\(i(s)\\) de las dos ecuaciones y remplazarlas, se puede obtener la función de transferencia que relaciona la velocidad angular \\([\\theta]\\) con la fuente de alimentación continua \\([V]\\) tal como se muestra en la ecuacion: .\r\n            </p>\r\n            \\begin{equation}\r\n            \\begin{split}\r\n                \\frac{\\dot \\theta(s)}{v(s)}=\\frac{M_k}{JLs^2 + s(JR+bL)+ Rb+M_k^2}\r\n            \\end{split}\r\n            \\label{ecu:tfmotorv}\r\n            \\end{equation} \r\n\r\n            <h3>Posición</h3>\r\n            <p>\r\n            Como es de saber la velocidad es la derivada de la posición, \\(v(t) = \\frac{dx}{dt}\\), al tener la ecuación de la tranformacion de laplace, que es la velocidad angular del eje del motor, se puede calcular su posición integrando la función de transferencia, quedando la ecuación.\r\n            </p>\r\n            \\begin{equation}\r\n            \\begin{split}\r\n                \\frac{\\theta(s)}{v(s)}=\\frac{M_k}{JLs^3 + s^2(JR+bL)+ s(Rb+M_k^2)}\r\n            \\end{split}\r\n            \\label{ecu:tfmotorp}\r\n            \\end{equation}', 0),
(2, 1, 'Control de Posición Ball of Beam (Viga Bola)', 'm*g*d*K', '(J*L)*(d/a*bb)*(ji/R**2+m), (d/a*bb)*(J*R+b*L),(d/a*bb)*(R*b+K**2),0,0,0', '                <p>El viga bola es un sistema medianamente complejo por su grado de inestabilidad, contemplando el sistema de posición del motor eléctrico es un sistema de orden 5 aproximadamente, pero puede aproximarse en la vida real a un sistema de orden dos usando la región lineal.  el modelo que se contemplara dentro de la plataforma es el que se muestra en la figura, debido a su flexibilidad de implementación en código, la identificación matemática es realizada por <b>Creative Commons Attribution.</b>           <center>           <img src=\"http://localhost/nueva/images/cabecera1/explicar/ballofbeam.png\" class=\"img-fluid\" alt=\"Responsive image\">         </center>    <p>Al analizar el sistema y ver sus comportamientos, cuando se cambia el ángulo $[\\alpha]$, se puede ver una variación que afecta directamente la coordenada de la esfera $[r]$ dentro de la viga, al calcular la segunda derivada de $[r]$, se puede apreciar la aceleración de la esfera, esto permite aplicar las ecuaciones de <b><i>Lagrange</i></b> como se muestra en la ecuacion.</p>   \\begin{equation}     0 = \\left (\\frac{J}{R^2} + m \\right) \\ddot r + mg \\sin {\\alpha} - mr \\dot {\\alpha}^2     \\label{ecu:vigabola1} \\end{equation}   <p>Al encontrar la aproximación lineal del sistema haciendo $\\alpha = 0$, aparece la ecuación, esta permite entender las regiones de trabajo dentro del viga bola, es decir que que la esfera se mantenga en una región de operación determinada.</p>  \\begin{equation} \\left (\\frac {J} {R ^ 2} + m \\right) \\ddot {r} = - mg \\alpha  \\label{ecu:vigabola2} \\end{equation}  <p>para complementar el sistema se debe hacer lineal el valor de $\\alpha$ esto se logra mediante la aproximación de la ecuación:</p>  \\begin{equation} \\alpha = \\frac{d}{L} \\beta  \\label{ecu:vigabola3} \\end{equation}   <p>Remplazando en la ecuación de la descripcion de la esfera, el valor lineal de $\\alpha$, obtenido en la ecuación, se puede obtener la relación de la coordenada de la esfera $r$, con el ángulo del engranaje del servo $\\beta$  como se ilustra a continuacion.</p>  \\begin{equation} \\left(\\frac{J}{R ^ 2} + m \\right) \\ddot{r} = - mg \\frac{d}{L} \\beta  \\label{ecu:vigabola4} \\end{equation}  <p>Al aplicar la transformación de laplace de la ecuación diferencial, se puede construir la función de transferencia, donde la relación entrada-salida sera la coordenada de la esfera $r$ entre el ángulo generado por el servomotor $\\beta$ quedando el sistema como muestra la ecuación:</p>  \\begin{equation} \\frac{R(s)}{\\beta(s)} = - \\frac{mgd} {L \\left(\\frac{J}{R^2} + m \\right)} \\frac{1}{s^2} \\label{ecu:vigabola6} \\end{equation}  <p>En la ecuación siguiente, se puede ver un sistema en el cual el ángulo ya esta determinado por los engranajes de un servomotor, no se contempla la existencia de un motor, sin embargo, al acoplar la  función de transferencia construida en la ecuación del motor, indicando que $\\theta=\\beta$ el sistema completo queda como muestra la ecuación siguiente, empatando la dinámica de viga y bola y el funcionamiento dinámico de un motor de corriente continua.</p>  \\begin{equation} \\frac{R(s)}{V(s)} = - \\frac{mgd (M_k)} {L s^2 \\left(\\frac{J}{R^2} + m \\right)  \\left( JLs^3 + s^2(JR+bL)+ s(Rb+M_k^2) \\right)} \\label{ecu:vigabola7} \\end{equation}  <p>Es importante mencionar, que en la ecuación, en el motor no se esta contemplando ningún tipo de controlador, se recomienda aplicar primero el controlador del motor para luego ejecutar el controlador del viga bola, para simplificar procesos matemáticos que es lo que internamente la plataforma hace para hacer los calculos.</p>', 0),
(3, 1, 'Aero-Pendulo', 'K*L', 'c,mg*L**2', 'El modelo matemático usado para esta representación, fue desarrollada por \\[ \\textbf{Giampero Campa miembro de la IEEE } \\], consiste en dar una demostración lineal del modelo, esta se ajusta a las características de la plataforma, pues es un sistema de segundo orden y adicional a ello se  puede implementar dentro de las librerías construidas dentro del programa.\r\n        <center>\r\n\r\n          <script></script><img src=\"http://localhost/nueva/images/cabecera1/explicar/arpentf.png\" class=\"img-fluid\" alt=\"Responsive image\">\r\n        </center>\r\nla dinámica del comportamiento del péndulo esta dada por la ecuación siguiente, esta involucra los parámetros de fricción peso de las vara y las fuerzas que trabajan en este sistema.\r\n\\begin{equation}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\label{cap4:ecu1}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n    \\begin{split}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n        mL^2 \\ddot \\theta = -mg sen \\theta - c \\dot \\theta + TL\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n    \\end{split}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\end{equation}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nTeniendo en cuenta que $T$ es la fuerza que ejerce la hélice, la descripción de esta, sera proporcional a la cantidad de energía de energía de propulsión $\\mu$ por el el coeficiente de empuje, remplazando esto en la ecuación anterior, se obtiene la solución de la ecuación.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\begin{equation}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\label{cap4:ecu2}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n    \\begin{split}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n        mL^2 \\ddot \\theta = -mg sen \\theta - c \\dot \\theta + TK\\mu\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n    \\end{split}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\end{equation}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nDefiniendo el sistema bajo una región de trabajo lineal diciendo que el valor de los parámetros en estado estacionario esta dado por la ecuación siguiente, se puede llegar a la función de transferencia lineal.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\begin{equation}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\label{cap4:ecu3}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n    \\begin{split}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n        sin \\theta_{ss}= \\frac{K}{mg}\\mu_{ss}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n    \\end{split}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\end{equation}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nLa función de transferencia del sistema, esta dada por la ecuación siguiente, esta se usara dentro de la plataforma para hacer las simulaciones del sistema del aeropendulo \\(\\Theta(s)\\) es el ángulo de salida y \\(W(s)\\) es la energía con la que se alimenta el sistema.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\begin{equation}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\label{cap4:ecu4}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n    \\begin{split}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n        \\frac{\\Theta(s)}{W(s)}=\\frac{KL}{mgL^2+cs}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n    \\end{split}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\\end{equation}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 0),
(4, 1, 'Modelo de segundo orden', 'wn', '1,2*zeta*wn,wn**2', 'Modelo matematico de la forma:\r\n\r\n$$ \\frac{\\omega_n}{s^2+2\\zeta\\omega_n+\\omega_n^2}$$', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` text NOT NULL,
  `fecha_pub` date NOT NULL,
  `id_tema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id_respuestas` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_preguntas` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `fecha_pub` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellido` varchar(128) NOT NULL,
  `clave` text NOT NULL,
  `recordatorio` varchar(128) NOT NULL,
  `id_cargo` varchar(255) NOT NULL,
  `institucion` varchar(255) NOT NULL,
  `coduser` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `correo`, `nombre`, `apellido`, `clave`, `recordatorio`, `id_cargo`, `institucion`, `coduser`) VALUES
(5, 'mrcamssys@gmail.com', 'Carlos Arturo', 'Moreno Susatama', '698d51a19d8a121ce581499d7b701668', '', 'Docente', 'Universidad Pedagógica Nacional de Colombia', '200709033912');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variablestf`
--

CREATE TABLE `variablestf` (
  `id_variables` int(11) NOT NULL,
  `id_modelos` int(11) NOT NULL,
  `variable` varchar(10) CHARACTER SET utf8 COLLATE utf8 NOT NULL,
  `maximo` float NOT NULL,
  `minimo` float NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `pinicial` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

--
-- Volcado de datos para la tabla `variablestf`
--

INSERT INTO `variablestf` (`id_variables`, `id_modelos`, `variable`, `maximo`, `minimo`, `descrip`, `pinicial`) VALUES
(1, 1, 'J', 1, 0.0001, 'MOMENTO DE INERCIA INICIAL DEL MOTOR [kg.m^2]', 0.01),
(2, 1, 'b', 1, 0.0001, 'VISCOCIDAD DE FRICCION DEL MOTOR', 0.1),
(3, 1, 'R', 1, 0.01, 'RESISTENCIA ELECTRICA', 1),
(4, 1, 'L', 1, 0.00001, 'INDUCTANCIA ELECTRICA', 0.5),
(5, 1, 'K', 1, 0.0001, 'TORQUE Y FUERZA DEL MOTOR ', 0.01),
(14, 0, 'mp', 10, -10, 'Control Proporcional Motor', 1),
(15, 0, 'mi', 10, -10, 'Control integral Motor', 0.01),
(16, 0, 'md', 10, -10, 'Control derivativo Motor', 0.01),
(17, 0, 'mf', 1, 0, 'Filtro Control derivativo Motor', 0.01),
(18, 2, 'J', 1, 0.0001, 'momento de inercia inicial del motor [kg.m^2]', 0.44),
(19, 2, 'b', 1, 0.0001, 'viscocidad de friccion del motor', 0.0033),
(20, 2, 'R', 1, 0.01, 'resistencia electrica', 0.015),
(21, 2, 'L', 1, 0.00001, 'inductancia eléctrica', 0.045),
(22, 2, 'K', 1, 0.0001, 'Torque y fuerza del motor', 0.01),
(23, 2, 'g', 10, 8, 'Aceleracion Gravitacional ', -9.8),
(24, 2, 'bb', 6.9, -6.9, 'Angulo de engranaje servomotor [rad]', 1571),
(25, 2, 'y', 1, -1, 'Cordenada de la esfera [met]', 0),
(26, 2, 'a', 6.9, -6.9, 'Coordenada del angulo del haz [rad]', 3.14),
(27, 2, 'd', 0.5, -0.5, 'Desplazamiento del sigueñal en el motor [met]', 0.00000999),
(28, 2, 'm', 1, 0, 'Masa de la esfera [kg]', 0.11),
(29, 2, 'ji', 5, 0, 'Momento inercia esfera ', 0.004),
(30, 3, 'L', 5, 0, 'longitud de la vara [metros]', 0.5),
(31, 3, 'mg', 2, 0, 'Peso del motor [Kg]', 1),
(32, 3, 'K', 1, 0, 'Coheficiente de Empuje', 0.01),
(33, 3, 'c', 2, 0, 'CoHeficiente Friccion', 0.04),
(34, 4, 'wn', 10, -10, 'Frecuencia Natural', 1),
(35, 4, 'zeta', 1, 0, 'Coheficiente de amortiguacion', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id_avatar`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `modelos_laplace`
--
ALTER TABLE `modelos_laplace`
  ADD PRIMARY KEY (`id_planta`),
  ADD KEY `id_usuarios` (`id_usuarios`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_respuestas`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_preguntas` (`id_preguntas`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`) USING BTREE,
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_cargo` (`id_cargo`) USING BTREE;

--
-- Indices de la tabla `variablestf`
--
ALTER TABLE `variablestf`
  ADD PRIMARY KEY (`id_variables`),
  ADD KEY `id_modelos` (`id_modelos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id_avatar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modelos_laplace`
--
ALTER TABLE `modelos_laplace`
  MODIFY `id_planta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuestas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `variablestf`
--
ALTER TABLE `variablestf`
  MODIFY `id_variables` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
