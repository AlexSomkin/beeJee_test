      <div class="footer">
      </div>
    </div> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
    <?php
        foreach ($js as $path) {
            echo '<script src="/assets/js/'.$path.'.js"></script>';
        }
    ?>
  </body>
</html>