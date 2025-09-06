// Fonction pour charger les livres populaires sur la page d'accueil
function loadFeaturedBooks() {
	fetch("php/get_all_books.php?featured=true")
		.then((response) => response.json())
		.then((books) => {
			const container = document.querySelector(".books-container");
			container.innerHTML = "";

			books.forEach((book) => {
				const bookCard = createBookCard(book);
				container.appendChild(bookCard);
			});
		})
		.catch((error) => console.error("Erreur:", error));
}

// Fonction pour charger les résultats de recherche
function loadSearchResults(query) {
	fetch(`php/search.php?query=${encodeURIComponent(query)}`)
		.then((response) => response.json())
		.then((books) => {
			const container = document.querySelector(".results-container");
			container.innerHTML = "";

			if (books.length === 0) {
				container.innerHTML = "<p>Aucun résultat trouvé.</p>";
				return;
			}

			books.forEach((book) => {
				const bookCard = createBookCard(book);
				container.appendChild(bookCard);
			});
		})
		.catch((error) => console.error("Erreur:", error));
}

// Fonction pour créer une carte de livre
function createBookCard(book) {
	const card = document.createElement("div");
	card.className = "book-card";

	card.innerHTML = `
        <div class="book-info">
            <h3 class="book-title">${book.titre}</h3>
            <p class="book-author">${book.auteur}</p>
            <a href="details.html?id=${book.id}" class="btn">Voir détails</a>
        </div>
    `;

	return card;
}

// Fonction pour charger les détails d'un livre
function loadBookDetails(bookId) {
	fetch(`php/get_book_details.php?id=${bookId}`)
		.then((response) => response.json())
		.then((book) => {
			document.getElementById("book-title").textContent = book.titre;
			document.getElementById("book-author").textContent = book.auteur;
			document.getElementById("book-description").textContent =
				book.description;
			document.getElementById("book-publisher").textContent =
				book.maison_edition;
			document.getElementById("book-copies").textContent =
				book.nombre_exemplaire;

			// Ajouter l'ID du livre au bouton "Ajouter à ma liste"
			const addButton = document.getElementById("add-to-wishlist");
			addButton.dataset.bookId = book.id;
		})
		.catch((error) => console.error("Erreur:", error));
}

// Fonction pour charger la liste de lecture de l'utilisateur
function loadWishlist() {
	// utilsateur connecté ou non
	const userId = localStorage.getItem("user_id");
	if (!userId) {
		window.location.href = "login.html";
		return;
	}

	fetch(`php/get_wishlist.php?user_id=${userId}`)
		.then((response) => response.json())
		.then((books) => {
			const container = document.querySelector(".wishlist-container");
			container.innerHTML = "";

			if (books.length === 0) {
				container.innerHTML = "<p>Votre liste de lecture est vide.</p>";
				return;
			}

			books.forEach((book) => {
				const bookCard = document.createElement("div");
				bookCard.className = "book-card";
				bookCard.innerHTML = `
                    <div class="book-info">
                        <h3 class="book-title">${book.titre}</h3>
                        <p class="book-author">${book.auteur}</p>
                        <p class="borrow-date">Emprunté le: ${book.date_emprunt}</p>
                        <button class="btn btn-danger" onclick="removeFromWishlist(${book.wishlist_id})">Retirer</button>
                    </div>
                `;
				container.appendChild(bookCard);
			});
		})
		.catch((error) => console.error("Erreur:", error));
}

// Fonction pour ajouter un livre à la liste de lecture
function addToWishlist(bookId) {
	const userId = localStorage.getItem("user_id");
	if (!userId) {
		alert(
			"Veuillez vous connecter pour ajouter des livres à votre liste de lecture."
		);
		window.location.href = "login.html";
		return;
	}

	fetch("php/add_to_wishlist.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({
			book_id: bookId,
			user_id: userId,
		}),
	})
		.then((response) => response.json())
		.then((data) => {
			if (data.success) {
				alert("Livre ajouté à votre liste de lecture!");
			} else {
				alert("Erreur: " + data.message);
			}
		})
		.catch((error) => console.error("Erreur:", error));
}

// Fonction pour retirer un livre de la liste de lecture
function removeFromWishlist(wishlistId) {
	fetch("php/remove_from_wishlist.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({
			wishlist_id: wishlistId,
		}),
	})
		.then((response) => response.json())
		.then((data) => {
			if (data.success) {
				alert("Livre retiré de votre liste de lecture!");
				loadWishlist(); // Recharger la liste
			} else {
				alert("Erreur: " + data.message);
			}
		})
		.catch((error) => console.error("Erreur:", error));
}

// Charger les livres populaires au chargement de la page d'accueil
if (document.querySelector(".books-container")) {
	document.addEventListener("DOMContentLoaded", loadFeaturedBooks);
}

// Gérer l'ajout à la liste de lecture sur la page de détails
if (document.getElementById("add-to-wishlist")) {
	document
		.getElementById("add-to-wishlist")
		.addEventListener("click", function () {
			const bookId = this.dataset.bookId;
			addToWishlist(bookId);
		});
}
// Fonction pour vérifier si l'utilisateur est connecté
function checkAuth() {
	const userId = localStorage.getItem("user_id");
	if (!userId) {
		const protectedPages = ["wishlist.html"];
		const currentPage = window.location.pathname.split("/").pop();

		if (protectedPages.includes(currentPage)) {
			alert("Veuillez vous connecter pour accéder à cette page.");
			window.location.href = "login.html";
		}
	}
}

// Vérifier l'authentification au chargement de chaque page
document.addEventListener("DOMContentLoaded", checkAuth);

// Fonction pour se déconnecter
function logout() {
	localStorage.removeItem("user_id");
	window.location.href = "index.html";
}
