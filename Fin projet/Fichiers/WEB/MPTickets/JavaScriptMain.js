// Fonction pour les menu d�roulants
$(function () {
	$('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
		if (!$(this).next().hasClass('show')) {
			$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
		}
		var $subMenu = $(this).next(".dropdown-menu");
		$subMenu.toggleClass('show'); 			// appliqu� au ul
		$(this).parent().toggleClass('show'); 	// appliqu� au li parent

		$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
			$('.dropdown-submenu .show').removeClass('show'); 	// appliqu� au ul
			$('.dropdown-submenu.show').removeClass('show'); 		// appliqu� au li parent
		});
		return false;
	});
});

$(document).ready(function () {
	$('.radio').click(function () {
		$('.radio').not(this).prop('checked', false);
	});
});

// Ajouter la cat�gorie dans l'input apr�s son choix
function get_idCategory(nameCheckbox, nameCategory) {
	if (document.getElementById(nameCheckbox).checked == true) {
		document.getElementById("id_Category").value = nameCheckbox;
		document.getElementById("Categorie").value = nameCategory;
	}
	else {
		document.getElementById("id_Category").value = '';
		document.getElementById("Categorie").value = '';
    }
}

// Faire que l'input Categorie soit en requit et readonly
$(".readonly").keydown(function (e) {
	e.preventDefault();
});