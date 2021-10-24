<div class="modal fade main-modal" id="popup-tarif-pay-fail" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<button type="button" class="btn-close btn-close-white text-white" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="popup__wrp" style="background-color: #151A40; background-image: url('/images/dist/popup-bg/pay-fail.svg'); background-repeat: no-repeat; background-position: center bottom 182px">
				<div class="popup__content align-items-center">

					<button class="btn btn-white btn-icon btn-aura pe-none pay-result-icon">
						<i class="icon"><img src="/images/icons/close-dark.svg"></i>
					</button>
					<div class="popup__title text-white">Платёж отклонен</div>

					<div class="popup__buttons ms-auto ms-lg-0 ml-lg-auto">
						<button class="btn btn-white px-3 ms-auto" onclick="pay(123);">Повторить оплату</button>
					</div>
				</div>
			</div>
			<a href="#" class="btn text-white mb-4 px-4 position-absolute start-0 bottom-0">Служба поддержки</a>
		</div>
	</div>
</div>

<div class="modal fade main-modal" id="popup-tarif-pay-success" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<button type="button" class="btn-close btn-close-white text-white" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="popup__wrp" style="background-color: #A3CC4A; background-image: url('/images/dist/popup-bg/pay-success.svg'); background-repeat: no-repeat; background-position: center bottom 128px">
				<div class="popup__content align-items-center">

					<button class="btn btn-white btn-icon btn-aura pe-none pay-result-icon">
						<i class="icon"><img src="/images/icons/check-green.svg"></i>
					</button>
					<div class="popup__title text-white">Оплата прошла успешно</div>

					<div class="popup__buttons">
						<button class="btn btn-white px-3 text-primary" data-bs-target="#popup-autocall" data-bs-toggle="modal" data-bs-dismiss="modal">Связаться с владельцем</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>