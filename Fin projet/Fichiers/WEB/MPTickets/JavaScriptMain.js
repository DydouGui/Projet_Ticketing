// Fonction pour les menu déroulants
$(function () {
	$('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
		if (!$(this).next().hasClass('show')) {
			$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
		}
		var $subMenu = $(this).next(".dropdown-menu");
		$subMenu.toggleClass('show'); 			// appliqué au ul
		$(this).parent().toggleClass('show'); 	// appliqué au li parent

		$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
			$('.dropdown-submenu .show').removeClass('show'); 	// appliqué au ul
			$('.dropdown-submenu.show').removeClass('show'); 		// appliqué au li parent
		});
		return false;
	});
});

$(document).ready(function () {
	$('.radio').click(function () {
		$('.radio').not(this).prop('checked', false);
	});
});

// Ajouter la catégorie dans l'input après son choix
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