jQuery(document).ready(function ($) {
	const selectors = '.woocommerce-notices-wrapper .woocommerce-error, .woocommerce-notices-wrapper .woocommerce-info, .woocommerce-notices-wrapper .woocommerce-message';

	$(selectors).each(function () {
		const $notice = $(this);

		if (!$notice.find('.close-notice').length) {
			$notice.prepend('<div class="close-notice"></div>');
		}

		setTimeout(function () {
			$notice.fadeOut(400);
		}, 10000);
	});

	$(document).on('click', '.close-notice', function () {
		$(this).closest('.woocommerce-error, .woocommerce-info, .woocommerce-message').fadeOut(300);
	});
});

document.addEventListener('DOMContentLoaded', function () {

	//плюс - минус
	const minusBtns = document.querySelectorAll('.qty-btn.minus');
	const plusBtns = document.querySelectorAll('.qty-btn.plus');

	minusBtns.forEach((minusBtn) => {
		minusBtn.addEventListener('click', function () {
			const qtyInput = this.parentElement.querySelector('.qty');
			let current = parseFloat(qtyInput.value);
			let min = parseFloat(qtyInput.getAttribute('min')) || 1;
			if (current > min) {
				qtyInput.value = current - 1;
				qtyInput.dispatchEvent(new Event('change'));
			}
		});
	});

	plusBtns.forEach((plusBtn) => {
		plusBtn.addEventListener('click', function () {
			const qtyInput = this.parentElement.querySelector('.qty');
			let current = parseFloat(qtyInput.value);
			let max = parseFloat(qtyInput.getAttribute('max')) || 9999;
			if (current < max) {
				qtyInput.value = current + 1;
				qtyInput.dispatchEvent(new Event('change'));
			}
		});
	});

	//работа вкладок для вариативного товара
	const tabs = document.querySelectorAll('.variation-tabs .tabs a');
	const contents = document.querySelectorAll('.variation-tab-content');

	tabs.forEach(tab => {
		tab.addEventListener('click', function (e) {
			e.preventDefault();

			// Скрываем весь контент вкладок
			contents.forEach(content => {
				content.style.display = 'none';
			});

			// Удаляем класс active у всех вкладок
			tabs.forEach(t => t.classList.remove('active'));

			// Показываем нужный контент
			const targetContent = document.querySelector(this.getAttribute('href'));
			if (targetContent) {
				targetContent.style.display = 'block';
			}

			// Добавляем класс active к нажатой вкладке
			this.classList.add('active');
		});
	});

	// Активируем первую вкладку при загрузке
	if (tabs.length > 0) {
		const firstTab = tabs[0];
		const firstContent = document.querySelector(firstTab.getAttribute('href'));

		tabs.forEach(t => t.classList.remove('active'));
		contents.forEach(content => content.style.display = 'none');

		firstTab.classList.add('active');
		if (firstContent) {
			firstContent.style.display = 'block';
		}
	}

});
