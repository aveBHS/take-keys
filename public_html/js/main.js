// select
const rentSelect = document.querySelector('.rent__select')
const rentInput = document.querySelector('.rent__select-input')
const rentDropdown = document.querySelector('.rent__select-dropdown')
const rentOverlay = document.querySelector('.rent__select-overlay')
const rentDropdownH = rentDropdown.scrollHeight
const rentUnits = document.querySelectorAll('.rent__select-radio')

function openRentSelect () {
	rentSelect.classList.add('_open')
	rentDropdown.style.height = rentDropdownH + 'px'
}
function closeRentSelect () {
	rentSelect.classList.remove('_open')
	rentDropdown.style.height = null
}
rentInput.addEventListener('click', () => {
	if(rentSelect.classList.contains('_open')) {
		closeRentSelect()
	} else {
		openRentSelect()
	}
})
rentOverlay.addEventListener('click', closeRentSelect)
rentUnits.forEach((item) => {
	item.addEventListener('change', () => {
		rentInput.value = item.value
		closeRentSelect()
	})
})
// 
const cardSlider = document.querySelector('.card__slider')
const cardSwiper = new Swiper(cardSlider, {
	wrapperClass: 'card__slider-inner',
	slideClass: 'card__slider-item',
	slidesPerView: 1
})

const paginationItems = document.querySelectorAll('.card__pagination-item')
const paginationSum = document.querySelector('.card__pagination-sum')
paginationSum.innerText = paginationItems.length

const cardPaginationSlider = document.querySelector('.card__pagination-slider')

function mobilePagination () {
	if(window.innerWidth <= 992 && cardPaginationSlider.dataset.mobile == 'false') {
		let cardPaginationSwiper = new Swiper(cardPaginationSlider, {
			wrapperClass: 'card__pagination-inner',
			slideClass: 'card__pagination-item',
			slidesPerView: 7,
			spaceBetween: 8
		})
		cardPaginationSlider.dataset.mobile = 'true'
	}
	if(window.innerWidth > 992) {
		cardPaginationSlider.dataset.mobile = 'false'
		if(cardPaginationSlider.classList.contains('swiper-initialized')) {
			cardPaginationSwiper.destroy()
		}
	}
}
mobilePagination()
document.addEventListener('resize', mobilePagination)
