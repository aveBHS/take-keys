// // Import vendor jQuery plugin example
// import '~/app/libs/mmenu/dist/mmenu.js'
import $ from 'jquery'
window.jQuery = $
window.$ = $
//window.jquery = $

// Alert, Button, Carousel, Collapse, Dropdown, Modal, Offcanvas, Popover, ScrollSpy, Tab, Toast, Tooltip
import { Popover, Modal } from 'bootstrap'
import { offset } from '@popperjs/core'
//bootstrap.use([Popover, Collapse, Modal])
window.Modal = Modal

import { Swiper, Parallax, Navigation, Pagination, EffectFade, Autoplay, Lazy } from 'swiper'
Swiper.use([Parallax, Navigation, Pagination, EffectFade, Autoplay, Lazy])

import validator from 'validator'
window.isEmail = validator.isEmail
window.isMobilePhone = validator.isMobilePhone
window.isEmpty = validator.isEmpty

import '../../libs/js.js'

import IMask from 'imask'
window.IMask = IMask

import 'ion-rangeslider'
//import { data } from 'autoprefixer'

document.addEventListener('DOMContentLoaded', () => {

	$('[data-mask]').each(function () {
		IMask(this, { mask: $(this).data('mask'), lazy: true, placeholderChar: '#' })
	})
	$('[data-mask-date]').each(function () {
		IMask(this, {
			mask: 'MM/YY',
			blocks: {
				YY: {
					mask: '00',
				},
				MM: {
					mask: IMask.MaskedRange,
					from: 1,
					to: 12
				}
			}
		})
	})

	if (smallDev()) {
		$('.desc [data-bs-toggle="collapse"]').addClass('collapsed')
		$('.desc .collapse.show').removeClass('show')
	}

	const swiper = new Swiper('.item-slider', {
		// Optional parameters

		parallax: true,
		loop: true,
		speed: smallDev() ? $('.item-slider').data('swiper-speed') / 3 : $('.item-slider').data('swiper-speed'),
		preloadImages: false,
		lazy: {
			loadPrevNext: true,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination-custom',
			clickable: true,
			bulletClass: 'slider__gallery__thumb',
			type: 'bullets',
			renderBullet: function (index, className) {
				let slide = $('.item-slider .item-slider__bg').eq(index + 1)
				let thumb = slide.data('thumb')
				if (thumb == undefined) thumb = slide.css('background-image')
				else thumb = 'url("' + thumb + '")'

				return '<span class="' + className + '" style=\'background-image: ' + thumb + ';\'></span>';
			},

		},
		autoplay: true,
		on: {
			init: function (swiper) {
				//let slide_total = swiper.loopedSlides ? swiper.slides.length - 2 : swiper.slides.length
				let slide_total = $(swiper.el).find('.swiper-slide').not('.swiper-slide-duplicate').length
				$(swiper.el).find('.total').html(slide_total)
				$('.slider__gallery .total').html(slide_total)
			},
			slideChange: function (swiper) {
				let current = swiper.realIndex + 1
				$(swiper.el).find('.current').html(current)
			}
		},
	});
	
	const modal_swiper = new Swiper('.modal-swiper', {
		parallax: true,
		allowTouchMove: false,
		navigation: {
			prevEl: '.popup-owner-questions__back',
			nextEl: '.popup-owner-questions__next',
		},
		on: {
			init: function (swiper) {
				let total = $(swiper.el).find('.swiper-slide').not('.swiper-slide-duplicate').length
				let current = swiper.realIndex + 1
				let width_drag = Math.round( 10000 * current / total ) / 100
				$(swiper.el).find('.swiper-scrollbar-drag').css("width", width_drag + "%")
				console.log(total)
			},

			slideChange: function (swiper) {
				let total = $(swiper.el).find('.swiper-slide').not('.swiper-slide-duplicate').length
				let current = swiper.realIndex + 1
				let width_drag = Math.round( 10000 * current / total ) / 100
				$(swiper.el).find('.swiper-scrollbar-drag').css("width", width_drag + "%")
			}
		},
		speed: smallDev() ? $('.modal-swiper').data('swiper-speed') / 3 : $('.modal-swiper').data('swiper-speed'),
	});

	function lazyAjaxCatalog(container = '', url = '', data = {}) {
		if(container == '' || url == '') return

		if( lazyShow( $(container) ) ) {
			$.ajax({
				url: url,
				data: data,
				success: data => {
					$(container).html(data)
					lazySwiper()
				}
			})
		}
	}
	window.lazyAjaxCatalog = lazyAjaxCatalog

	function lazyShow(element, shift = 400) {
		
		if(element === undefined || element.length < 1) return false
		if(element.hasClass('lazy-loaded')) return false

		let wt = $(window).scrollTop();
		let wh = $(window).height();
		let dh = $(document).height();

		let et = element.offset().top;
		let eh = element.outerHeight();
		if (wt + wh + shift >= et || wh + wt == dh || eh + et < wh) {
			element.addClass('lazy-loaded')
			return true
		}
		return false
	}
	window.lazyShow = lazyShow

	function lazySwiper() {

		$('.catalog__item-slider').each(function () {
			lazyShow( $(this) )
		});

		const catalog_swiper = new Swiper('.catalog__item-slider.lazy-loaded:not(.swiper-initialized)', {
			loop: false,
			speed: 100,
			grabCursor: true,
			effect: 'fade',
			preloadImages: false,
			lazy: true,
			fadeEffect: {
				crossFade: true
			},
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
				type: 'bullets',
			},
			on: {
				init: function (swiper) {
					let slide_total = $(swiper.el).find('.swiper-slide').not('.swiper-slide-duplicate').length
					$(swiper.el).find('.total').html(slide_total)
				},
				slideChange: function (swiper) {
					let current = swiper.realIndex + 1
					$(swiper.el).find('.current').html(current)

					if (swiper.lazyDone === undefined) {
						swiper.lazyDone = 1
						let slide_total = $(swiper.el).find('.swiper-slide').not('.swiper-slide-duplicate').length
						setTimeout(() => {
							for (let i = 0; i < slide_total; i++) {
								swiper.lazy.loadInSlide(i)
							}
						}, 200);
					}
				}
			},
		});
	}
	window.lazySwiper = lazySwiper
	lazySwiper()

	$(window).scroll(function () {

		lazySwiper()

	})


	$("body").on('mouseenter', '.catalog__item .swiper-pagination-bullet', function () {
		$(this).click()
	})

	$('.row-scroll-x').bind('mousewheel', function (e) {

		if (e.originalEvent.wheelDelta < 0 && $(this).scrollLeft() + 3 + this.clientWidth > this.scrollWidth) return
		else if (e.originalEvent.wheelDelta > 0 && $(this).scrollLeft() == 0) return

		$(this).scrollLeft(this.scrollLeft + (-e.originalEvent.wheelDelta))
		e.preventDefault();
	});

	// $('.row-scroll-x').mousewheel(function(e, delta) {
	// 	$(this).scrollLeft(this.scrollLeft + (-delta * 40));
	// 	e.preventDefault();
	// });


	const reg_steps = new Swiper('.auth__steps-reg', {
		loop: false,
		parallax: true,
		allowTouchMove: false,
		navigation: {
			prevEl: '.auth__back-reg',
		}
	});

	const signin_steps = new Swiper('.auth__steps-signin', {
		loop: false,
		parallax: true,
		allowTouchMove: false,
		navigation: {
			prevEl: '.auth__back-signin',
		}
	});

	$('.auth input').keypress(function (event) {
		if (event.keyCode == 13) {
			event.preventDefault()
			let form = $(this).parents('form')
			if (form !== undefined) form.submit()
		}
	});

	$('.needs-validation').submit(function (event) {
		if (!this.checkValidity()) {
			event.preventDefault()
			event.stopPropagation()
		}
		$(this).addClass('was-validated')
	})
	$('.js-validation').submit(function (event) {
		if (!checkValidate(this)) {
			event.preventDefault()
			event.stopPropagation()
		}
	})
	function checkValidate (form) {
		let valid = true
		$(form).find('[required]:not([type="checkbox"]):not([type="radio"])').each(function () {
			if (isEmpty($(this).val())) { class_invalid(this); valid = false }
			else class_valid(this)
		})
		$(form).find('[type="email"]').each(function () {
			if (!isEmail($(this).val())) { class_invalid(this); valid = false }
			else class_valid(this)
		})
		$(form).find('[type="tel"]').each(function () {
			if (!isMobilePhone($(this).val().replace(/[^\d+]/g, ''), 'ru-RU')) { class_invalid(this); valid = false }
			else class_valid(this)
		})
		return valid
	}
	window.checkValidate = checkValidate

	$('body').on('change', '[novalidate] [required]', function () {
		if ($(this).attr('type') == 'checkbox' || $(this).attr('type') == 'radio') return

		if (isEmpty($(this).val())) class_invalid(this)
		else class_valid(this)
	})
	$('body').on('change', '[novalidate] [type="email"]', function () {
		if (!isEmail($(this).val())) class_invalid(this)
		else class_valid(this)
	})
	$('body').on('change', '[novalidate] [type="tel"]', function () {
		if (!isMobilePhone($(this).val().replace(/[^\d+]/g, ''), 'ru-RU')) class_invalid(this)
		else class_valid(this)
	})

	function class_invalid (e) {
		$(e).parents('form').addClass('is-invalid')
		$(e).addClass('is-invalid')
		$(e).removeClass('is-valid')
	}
	function class_valid (e) {
		$(e).parents('form').removeClass('is-invalid')
		$(e).removeClass('is-invalid')
		$(e).addClass('is-valid')
	}


	document.getElementById('topline-menu').addEventListener('show.bs.collapse', function () {
		$('.topline .hamburger').addClass('is-active')
	})
	document.getElementById('topline-menu').addEventListener('hide.bs.collapse', function () {
		$('.topline .hamburger').removeClass('is-active')
	})
	
	// $('.popup-notification').click(function (e) {
	// 	let notif_modal = new Modal(document.getElementById('popup-notification'))
	// 	notif_modal.show()
	// 	if($(this).data('action') == 'off') {
	// 		$('.notif-off').each(function () {
	// 			let notif_collapse = new Collapse(this, {toggle: false})
	// 			notif_collapse.show()
	// 		});
	// 	}
	// 	else {
	// 		$('.notif-on').each(function () {
	// 			let notif_collapse = new Collapse(this, {toggle: false})
	// 			notif_collapse.show()
	// 		});
	// 	} 
	// })

	$('body').on('click', '[data-collapse]', function () {
		let target = $(this).attr('data-collapse')
		let parent = $(target).attr('data-parent')

		let duration = $(this).attr('data-collapse-duration')
		duration = duration === undefined ? 0 : parseInt(duration);

		if($(parent) !== undefined) {
			$(target).parents(parent).find('[data-parent="'+ parent +'"]').not($(target)).slideUp(duration)
		}

		if($(this).attr('data-collapse-toggle') !== undefined) $(target).slideToggle(duration)
		else $(target).slideDown(duration)
	})

	$(".js-range-slider").ionRangeSlider({
		skin: "round",
		hide_min_max: true
	})


})

function smallDev () {
	return !($(window).width() >= 992);
}
