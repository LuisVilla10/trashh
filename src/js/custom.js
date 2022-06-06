window.addEventListener('load', () => {
	let isUserMenuOpen = false;

	// Label con informacion de usuario
	const userLabel = document.querySelector('.user-menu-label');
	userLabel.addEventListener('mouseover', (e) => {
		if (!isUserMenuOpen && e.target.classList.contains('user-menu-label')) {
			isUserMenuOpen = true;
			e.target.children[2].style.display = 'block';
			setTimeout(() => {
				e.target.children[2].style.opacity = 100;
			}, 5);
		}
	});

	userLabel.addEventListener('mouseleave', (e) => {
		if (isUserMenuOpen) {
			isUserMenuOpen = false;
			e.target.children[2].style.opacity = 0;
			
			setTimeout(() => {
				e.target.children[2].style.display = 'none';
			}, 200);
		}
	});

	// Hamburguer menu
	(() => {
		let isHamMenuOpen = false;

		const hamMenu = document.querySelector('.ham-menu');
		if (hamMenu === null) return;

		hamMenu.addEventListener('mouseover', (e) => {
			if (!isHamMenuOpen && e.target.classList.contains('ham-menu')) {
				isHamMenuOpen = true;
				e.target.children[1].style.display = 'grid';
				setTimeout(() => {
					e.target.children[1].style.height = '12%';
				}, 5);
			}
		});

		hamMenu.addEventListener('mouseleave', (e) => {
			if (isHamMenuOpen) {
				isHamMenuOpen = false;
				e.target.children[1].style.height = '0px';
				
				setTimeout(() => {
					e.target.children[1].style.display = 'none';
				}, 200);
			}
		});
	})();
});
