<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <!-- Footer -->

<p> &nbsp</p>

    <script src="<?php echo base_url();?>stilos/presentacion/js/reveal.js"></script>
    <script>

      // More info https://github.com/hakimel/reveal.js#configuration
      Reveal.initialize({
        controls: true,
        progress: true,
        center: true,
        hash: true,

        transition: 'convex', // none/fade/slide/convex/concave/zoom

        // More info https://github.com/hakimel/reveal.js#dependencies
        dependencies: [
          { src: '<?php echo base_url();?>stilos/presentacion/plugin/markdown/marked.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
          { src: '<?php echo base_url();?>stilos/presentacion/plugin/markdown/markdown.js', condition: function() { return !!document.querySelector( '[data-markdown]' ); } },
          { src: '<?php echo base_url();?>stilos/presentacion/plugin/highlight/highlight.js', async: true },
          { src: '<?php echo base_url();?>stilos/presentacion/plugin/search/search.js', async: true },
          { src: '<?php echo base_url();?>stilos/presentacion/plugin/zoom-js/zoom.js', async: true },
          { src: '<?php echo base_url();?>stilos/presentacion/plugin/notes/notes.js', async: true }
        ]
      });

    </script>
  </footer>
  <!-- Footer -->

<!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url();?>stilos/muluser/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>stilos/muluser/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
     <script src="<?php echo base_url();?>stilos/login.js"></script> 
  </body>

</html>


