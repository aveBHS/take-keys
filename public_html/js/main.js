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