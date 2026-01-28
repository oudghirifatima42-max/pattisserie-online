// 🛒 Chargement du panier depuis le localStorage, ou initialisation vide
let panier = JSON.parse(localStorage.getItem("panier")) || [];  /*localStorage stocke les info qui choisie deja dans le panier */

// ➕ Ajouter un produit au panier
function ajouterPanier(produit, prix) {
    const index = panier.findIndex(item => item.produit === produit);  /*findIndex CHERCHER si le produit existe dans le panier ou non (item.produit === produit:wch le produit dans le panier exactement le produit qui me donne dans parametre) */

    if (index !== -1) {
        // Si le produit existe déjà, on augmente la quantité
        panier[index].quantite += 1; 
    } else {
        // Sinon, on ajoute un nouveau produit
        panier.push({ produit, prix, quantite: 1 });
    }

    localStorage.setItem("panier", JSON.stringify(panier));  /* localStorage pour enregistrer les modifications dans le panier, en l'enregistrant sous forme de chaîne de caractères */
    afficherPanier();  /*Cette fonction affiche le contenu du panier (ça va mettre à jour la page avec le produit ajouté) */
    updateEmptyMessage(); /*Si le panier est vide, elle affiche le message, sinon elle le cache.*/
}

// 👁 Affiche tous les éléments du panier dans la page
function afficherPanier() {
    const liste = document.getElementById("liste-panier");
    if (!liste) return;

    liste.innerHTML = "";
    let total = 0;

    panier.forEach((item, index) => {
        const li = document.createElement("li");
        li.innerHTML = `
            ${item.produit} 
            <input type="number" min="1" value="${item.quantite}" onchange="changerQuantite(${index}, this.value)" style="width: 40px; margin: 0 5px;">
            - ${item.prix * item.quantite} DH
            <button onclick="supprimerProduit(${index})"
                style="background: transparent; color: red; border: none; margin-left: 10px; font-size: 18px; cursor: pointer;">
                🗑
            </button>
        `;
        liste.appendChild(li);
        total += item.prix * item.quantite;
    });

    const totalElement = document.getElementById("total");
    if (totalElement) totalElement.textContent = `Total : ${total} DH`;
}

// 🔄 Changer la quantité d'un produit dans le panier
function changerQuantite(index, nouvelleQuantite) {
    nouvelleQuantite = parseInt(nouvelleQuantite);

    if (nouvelleQuantite > 0) {
        panier[index].quantite = nouvelleQuantite;
        localStorage.setItem("panier", JSON.stringify(panier));
        afficherPanier();
    } else {
        alert("La quantité doit être supérieure à 0.");
    }
}

// ❌ Supprimer un produit du panier
function supprimerProduit(index) {
    panier.splice(index, 1);
    localStorage.setItem("panier", JSON.stringify(panier));
    afficherPanier();
    updateEmptyMessage();
}

// ℹ️ Affiche un message si le panier est vide
function updateEmptyMessage() {
    const emptyMsg = document.querySelector(".empty-message");
    if (emptyMsg) {
        emptyMsg.style.display = panier.length > 0 ? "none" : "block";
    }
}

// ✅ Rediriger vers la page de commande si le panier n’est pas vide
function commander() {
    if (panier.length === 0) {
        alert("Votre panier est vide. Ajoutez des produits avant de continuer.");
        return;
    }
    localStorage.setItem("panier", JSON.stringify(panier));
    window.location.href = "Formulaire.html";
}

// 🔁 Initialisation au chargement de la page
window.onload = function () {
    afficherPanier();
    updateEmptyMessage();
};
