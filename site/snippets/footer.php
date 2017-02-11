
	<footer class="<?php echo $footerClass ?>">
		<div class="container">
			<a href="<? echo $site->instagramUrl() ?>">Instagram</a>
			<a href="<? echo $site->facebookUrl() ?>">Facebook</a>
			<a href="<? echo $site->twitterUrl() ?>">Twitter</a>
		</div>
	</footer>

  </div><!--close .barba-container-->
  </div><!--close #barba-wrapper-->
  </div><!--close .content-->
  </div><!--close .page-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <?= js('assets/js/barbra.min.js') ?>
  <?= js('assets/js/main.js') ?>
</body>
</html>