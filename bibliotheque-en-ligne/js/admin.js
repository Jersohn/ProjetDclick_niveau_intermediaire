// Charger tous les livres
function loadAllBooks() {
	fetch("php/get_all_books.php")
		.then((response) => response.json())
		.then((books) => {
			const tbody = document.querySelector("#books-table tbody");
			tbody.innerHTML = "";

			books.forEach((book) => {
				const row = document.createElement("tr");
				row.innerHTML = `
                    <td>${book.titre}</td>
                    <td>${book.auteur}</td>
                    <td>${book.maison_edition}</td>
                    <td>${book.nombre_exemplaire}</td>
                    <td>
                        <button class="btn btn-edit" onclick="editBook(${book.id})">Modifier</button>
                        <button class="btn btn-danger" onclick="deleteBook(${book.id})">Supprimer</button>
                    </td>
                `;
				tbody.appendChild(row);
			});
		})
		.catch((error) => console.error("Erreur:", error));
}

// Afficher le formulaire d'ajout
document.getElementById("add-book-btn").addEventListener("click", function () {
	document.getElementById("book-form").style.display = "block";
	document.getElementById("form-title").textContent = "Ajouter un livre";
	document.getElementById("book-id").value = "";
	document.getElementById("book-form-data").reset();
});

// Annuler le formulaire
function cancelForm() {
	document.getElementById("book-form").style.display = "none";
}

// Soumettre le formulaire (ajout ou modification)
document
	.getElementById("book-form-data")
	.addEventListener("submit", function (e) {
		e.preventDefault();

		const bookId = document.getElementById("book-id").value;
		const formData = {
			titre: document.getElementById("titre").value,
			auteur: document.getElementById("auteur").value,
			description: document.getElementById("description").value,
			maison_edition: document.getElementById("maison_edition").value,
			nombre_exemplaire: document.getElementById("nombre_exemplaire").value,
		};

		const url = bookId ? "php/update_book.php" : "php/add_book.php";
		const method = bookId ? "PUT" : "POST";

		if (bookId) {
			formData.id = bookId;
		}

		fetch(url, {
			method: method,
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify(formData),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					alert(data.message);
					document.getElementById("book-form").style.display = "none";
					loadAllBooks(); // Recharger la liste
				} else {
					alert("Erreur: " + data.message);
				}
			})
			.catch((error) => console.error("Erreur:", error));
	});

// Modifier un livre
function editBook(bookId) {
	fetch(`php/get_book_details.php?id=${bookId}`)
		.then((response) => response.json())
		.then((book) => {
			document.getElementById("book-form").style.display = "block";
			document.getElementById("form-title").textContent = "Modifier le livre";
			document.getElementById("book-id").value = book.id;
			document.getElementById("titre").value = book.titre;
			document.getElementById("auteur").value = book.auteur;
			document.getElementById("description").value = book.description;
			document.getElementById("maison_edition").value = book.maison_edition;
			document.getElementById("nombre_exemplaire").value =
				book.nombre_exemplaire;
		})
		.catch((error) => console.error("Erreur:", error));
}

// Supprimer un livre
function deleteBook(bookId) {
	if (confirm("Êtes-vous sûr de vouloir supprimer ce livre?")) {
		fetch("php/delete_book.php", {
			method: "DELETE",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify({ id: bookId }),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					alert(data.message);
					loadAllBooks(); // Recharger la liste
				} else {
					alert("Erreur: " + data.message);
				}
			})
			.catch((error) => console.error("Erreur:", error));
	}
}

// Charger tous les livres au démarrage
document.addEventListener("DOMContentLoaded", loadAllBooks);
