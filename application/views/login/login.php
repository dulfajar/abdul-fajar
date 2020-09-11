<?php require_once(APPPATH.'views/include/headlogin.php'); ?>
<body>
<div class="form-signin text-center">

  <div class="modal-dialog">
    <div class="col-lg-8 col-sm-8 col-12 main-section ">
      <div class="modal-content">
        <div class="col-lg-12 col-sm-12 col-12 pull-center user-img">
          <img >
        </div>
        <div class="col-lg-12 col-sm-12 col-12 user-name">
		
		<?php echo form_open('login/ath'); ?>

          <h1>User Login</h1>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 form-input">
          <form>
            <div class="form-group">
              <input name="username" type="text" class="form-control" placeholder="Nama Pengguna" required>
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-success">Login</button>
          </form>
        </div>
        <div class="col-lg-12 col-sm-12 col-12 link-part">
            <h4>PT.Jalin Pembayaran Nusantara</h4>
        </div> 
      </div>
    </div>
    
  </div>

</div>

<!-- 	
<br><br><br><br><br><br>
	<br>
	<div class="container">
	<div>
			<h2 class="form-signin-heading"> </h2><br>
			<div class="form-signin pull-center">
			<form>
				<input name="username" type="text" class="form-control" placeholder="Nama Pengguna" required autofocus><br>
				<input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
			</div>
			<br/><br/><br/>
		</form>
	</div>
	</div>
 -->

</body>
</html>
