
	<footer class="<?php echo $footerClass ?>">
		<div class="container">
			<ul>
				<li><a target="_blank" href="<? echo $site->instagramUrl() ?>" title="Instagram">Instagram</a></li>
				<li><a target="_blank" href="<? echo $site->facebookUrl() ?>" title="Facebook">Facebook</a></li>
				<li>
					<a target="_blank" href="<? if ($site->document($site->careerspdf())) : ?><?= $site->document($site->careerspdf())->url() ?><? endif; ?>" title="Careers">
						Careers
					</a>
				</li>
				<li class="placeholder-li"></li>
				<li><a href="<?= url() ?>/about" title="About Us">About Us</a></li>
				<li>
					<a target="_blank" href="<? if ($site->document($site->privacypdf())) : ?><?= $site->document($site->privacypdf())->url() ?><? endif; ?>" title="Privacy Policy">
						Privacy Policy
					</a>
				</li>
				<li>
					<a target="_blank" href="<? if ($site->document($site->termspdf())) : ?><?= $site->document($site->termspdf())->url() ?><? endif; ?>" title="Terms of Use">
						Terms of Use
					</a>
				</li>
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