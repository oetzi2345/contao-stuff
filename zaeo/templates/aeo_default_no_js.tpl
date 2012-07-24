<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
	<?php if ($this->headline): ?>

	<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
	<?php endif; ?>
	<?php if ($this->isHuman): ?>
	<div class="mod_aeo success">
		<p><?php echo $this->success; ?></p>
		<p><a href="<?php echo $this->backLink; ?>"><?php echo $this->backLabel; ?></a></p>
	</div>
	<?php else: ?>
	<div class="mod_aeo question">
		<form class="<?php echo $this->formId; ?>" action="<?php echo $this->action; ?>" method="post">	
			<input type="hidden" name="FORM_SUBMIT" value="<?php echo $this->formId; ?>">
			<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
			<input type="hidden" name="n" value="<?php echo $this->n; ?>">
			<input type="hidden" name="d" value="<?php echo $this->d; ?>">
			<input type="hidden" name="t" value="<?php echo $this->t; ?>">
			<fieldset>
				<legend><?php echo $this->captchaDetails; ?></legend>
			  <?php echo $this->captcha->generateWithError(); ?> <label for="ctrl_captcha"><?php echo $this->captcha->generateQuestion(); ?><span class="mandatory">*</span></label>
				<div class="submit_container">
				  <input type="submit" class="submit" value="<?php echo $this->buttonLabel; ?>">
				</div>
			</fieldset>
		</form>
	</div>
	<?php if (strlen($this->info) > 0): ?>
	<div class="mod_aeo info">
		<?php echo $this->info; ?>
	</div>
	<?php endif; ?>
	<?php endif; ?>
</div>