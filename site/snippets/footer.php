
	<footer class="<?php echo $footerClass ?>">
		<div class="container">
			<ul>
				<li><a href="<? echo $site->instagramUrl() ?>">Instagram</a></li>
				<li><a href="<? echo $site->facebookUrl() ?>">Facebook</a></li>
				<li><a href="#">Careers</a></li>
				<li class="placeholder-li"></li>
				<li><a href="<?= url() ?>/about#contact">Contact</a></li>
				<li><a href="#">Privacy Policy</a></li>
				<li><a href="#">Terms of Use</a></li>
				<li class="q-footer-title">Q Mixers</li>
			</ul>
		</div>
	</footer>

  </div><!--close .barba-container-->
  </div><!--close #barba-wrapper-->
  </div><!--close .content-->
  </div><!--close .page-->

  <?= js('assets/js/main.js') ?>
</body>
</html>