
<div class="modal fade main-modal" id="popup-tarif-max-1" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="popup__wrp">
				<div class="popup__content">
					<div class="popup__title">На тарифе бесплатный "Старт" лимит связи с владельцами исчерпан</div>
					<div class="popup__text text-center">Чтобы связываться с собственниками без ограничений перейтите на тариф "Максимальный".</div>
					<div class="row gx-4 gy-2 row-cols-1 row-cols-md-2 mb-4">
						<div class="col">
							<div class="row gx-3 align-items-center">
								<div class="col-auto">
									<button class="btn btn-primary btn-icon btn-aura pe-none">
										<i class="icon"><img src="/images/icons/activity-white.svg"></i>
									</button>
								</div>
								<div class="col">
									<div class="fs-14">Автоматический подбор подходящих вариантов</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row gx-3 align-items-center">
								<div class="col-auto">
									<button class="btn btn-primary btn-icon btn-aura pe-none">
										<i class="icon"><img src="/images/icons/call-white.svg"></i>
									</button>
								</div>
								<div class="col">
									<div class="fs-14">Безграничный доступ и связь с владельцами</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row gx-3 align-items-center">
								<div class="col-auto">
									<button class="btn btn-primary btn-icon btn-aura pe-none">
										<i class="icon"><img src="/images/icons/paper-white.svg"></i>
									</button>
								</div>
								<div class="col">
									<div class="fs-14">Образцы договоров найма</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row gx-3 align-items-center">
								<div class="col-auto">
									<button class="btn btn-primary btn-icon btn-aura pe-none">
										<i class="icon"><img src="/images/icons/shield-white.svg"></i>
									</button>
								</div>
								<div class="col">
									<div class="fs-14">Гарантия заселения</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row gx-3 align-items-center">
								<div class="col-auto">
									<button class="btn btn-primary btn-icon btn-aura pe-none">
										<i class="icon"><img src="/images/icons/rouble-white.svg"></i>
									</button>
								</div>
								<div class="col">
									<div class="fs-14">Торг уместен</div>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="row gx-3 align-items-center">
								<div class="col-auto">
									<button class="btn btn-primary btn-icon btn-aura pe-none">
										<i class="icon"><img src="/images/icons/operator-white.svg"></i>
									</button>
								</div>
								<div class="col">
									<div class="fs-14">Поддержка 24/7</div>
								</div>
							</div>
						</div>
					</div>
					<div class="popup__buttons">
						<p class="fs-14 text-center">В отличие от риелторов мы не берем бешеные 50-100%,<br/> работаем дистанционно и до полного заселения.</p>
						<a class="btn btn-dark px-5" data-bs-target="#popup-tarif-max-2" data-bs-toggle="modal" data-bs-dismiss="modal">Перейти к оплате</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	document.addEventListener('DOMContentLoaded', () => {

		$('#tarif-max__form').submit(function (event) {
			if (this.checkValidity()) {
				Modal.getOrCreateInstance($('#popup-tarif-max-2')).hide()
				pay(user_id);
			}
			$(this).addClass('was-validated')

			event.preventDefault()
			event.stopPropagation()

		})

	})
</script>
<div class="modal fade main-modal" id="popup-tarif-max-2" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="popup__wrp">
				<form id="tarif-max__form" class="popup__content" novalidate>
					<div class="popup__title">Оплатите тариф и пользуйтесь сервисом без ограничений до полного заселения</div>
					<div class="popup__title text-primary">Уважаемый Иван</div>
					<div class="popup__text">Выберите дату в которую желаете заселиться, активируйте тариф "Найдётся всё" и получите подборку подходящих вариантов, 98% пользователей заселяются в желаемый день.</div>
					<div class="popup__subtitle">Выберите дату в которую вы желаете заселиться:</div>

					<div class="mb-3">
						<input type="date" name="date" placeholder="19.10.2021"
							class="form-control">
						<div class="invalid-feedback"></div>
					</div>
					<div class="row mb-3">
						<div class="col-auto">
							<div class="form-check form-check-box mb-2">
								<input class="form-check-input" type="checkbox" value="" name="date-checkbox-1" id="tarif-max__checkbox-1" checked>
								<label class="form-check-label fs-14" for="tarif-max__checkbox-1">
									Как можно быстрее
								</label>
							</div>
						</div>
						<div class="col-auto">
							<div class="form-check form-check-box mb-2">
								<input class="form-check-input" type="checkbox" value="" name="date-checkbox-2" id="tarif-max__checkbox-2">
								<label class="form-check-label fs-14" for="tarif-max__checkbox-2">
									Сегодня
								</label>
							</div>
						</div>
						<div class="col-auto">
							<div class="form-check form-check-box mb-2">
								<input class="form-check-input" type="checkbox" value="" name="date-checkbox-3" id="tarif-max__checkbox-3">
								<label class="form-check-label fs-14" for="tarif-max__checkbox-3">
									Завтра
								</label>
							</div>
						</div>
					</div>
					<div class="popup__buttons">
						<button type="submit" class="btn btn-primary px-5">Выбрать способ оплаты</button>
					
						<div class="form-check form-check-box mt-5 tarif-max__terms">
							<input class="form-check-input" type="checkbox" value="" name="terms" id="tarif-max__terms" checked required>
							<div class="invalid-feedback text-primary">
								<div class="d-flex align-items-center">
									<img src="/images/icons/arrow-down-green.svg">Чтобы продолжить пользоваться сервисом, необходимо согласиться с условиями и порядком оплаты услуг
								</div>
							</div>
							<label class="form-check-label text-dark fs-10" for="tarif-max__terms">
								Подтверждаю, что уведомлен и согласен с условиями и порядком оплаты услуг, а так же обязуюсь оплатить тариф "Максимальный" стоимостью 7 990 рублей автоматическим платежом в выбранный день в независимости от факта заселения с банковской карты привязанной к сервису после первой оплаты. Гарантии.
							</label>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>