    <!-- CONTACT FORM -->
    
    <footer id="footer"> 
    
      <div class="container text-center">
        <h1 class="display-5">Become a Sponsor</h1>
        <p class="lead">KLRN can tailor a package to fit your marketing needs. Whether it's on-air messaging, event sponsorship, or something in between, we'll find a way for you to connect with our viewers.</p>
        <p>
          <!--<span class="lead">(210) 270-9000</span>-->   
          <span class="lead">Melissa May, APR</span><br>
          Corporate Relations<br>
		  (210) 208-8403<br>
          mmay@klrn.org<br>
        </p>
      </div>

      <?php if ($sent) echo $response; ?>      
      <img  src="<?php echo $root ?>/assets/img/loader.svg" id="submit_loader" class="loader d-none"> 
      
      <?php if (!$sent) : ?>          
      <form id="contact_us" method="post" 
        action="<?php echo $protocol . htmlspecialchars($_SERVER['HTTP_HOST']
                .$_SERVER['REQUEST_URI'].'#contact_us'); ?>"
      >

        <?php echo $error_message; ?>
        
        <div class="form-group">
          <label for="first_name">Name</label>
          <input type="text" class="form-control" name="first_name" placeholder="Name" value="<?php echo $name; ?>">
        </div>        
        <div class="form-group last_name">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control" name="last_name" placeholder="Last Name">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
          <label for="email_verification">Verify email</label>
          <input type="email" class="form-control" name="email_verification" placeholder="Verify email" value="<?php echo $email_verify; ?>">
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" name="message" rows="5" placeholder="Message"><?php echo $message; ?></textarea>
        </div>        
        <button id="contact_us_submit" type="submit" class="ghost btn btn-primary">Submit</button>
      </form>
      <?php endif; ?>      
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php if ($page == 'examples/') echo '<script src="https://www.youtube.com/player_api"></script>'; ?>
    <script src="<?php echo $root; ?>/assets/js/scripts.js"></script>
  </body>
</html>