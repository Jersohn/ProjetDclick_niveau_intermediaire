function appliquerTheme(theme) {
    // Sauvegarder le thème dans localStorage
    localStorage.setItem('theme', theme);
    
    // Appliquer le thème à la page
    document.getElementById('maPage').className = theme;
}

function ajouterEcouteursEvenements() {
    document.getElementById('b1').addEventListener('click', function() {
        appliquerTheme('jour');
    });
    
    document.getElementById('b2').addEventListener('click', function() {
        appliquerTheme('nuit');
    });
    
    document.getElementById('b3').addEventListener('click', function() {
        appliquerTheme('nature');
    });
    
    document.getElementById('b4').addEventListener('click', function() {
        appliquerTheme('techno');
    });
}

function sauvegarderTexte() {
    const nouveauTexte = document.getElementById('nouveauTexte').value;
    if (nouveauTexte.trim() !== '') {
        localStorage.setItem('contenuParagraphe', nouveauTexte);
        document.getElementById('content').textContent = nouveauTexte;
        document.getElementById('nouveauTexte').value = '';
    }
}

function initialiser() {
    
    if (typeof(Storage) !== "undefined") {
        // Récupérer le thème sauvegardé ou utiliser 'jour' par défaut
        const theme = localStorage.getItem('theme') || 'jour';
        appliquerTheme(theme);
        
        // Récupérer le texte sauvegardé ou utiliser le texte par défaut
        const texte = localStorage.getItem('contenuParagraphe') || 
            "Ceci est un exemple d'utilisation de l'API Local Storage de HTML5";
        document.getElementById('content').textContent = texte;
    } else {
        alert("Votre navigateur ne supporte pas l'API Local Storage");
        document.getElementById('maPage').className = 'jour';
    }
    
    ajouterEcouteursEvenements();
    
    // Ajouter l'écouteur pour le bouton de sauvegarde
    document.getElementById('sauvegarderTexte').addEventListener('click', sauvegarderTexte);
}

// Démarrer l'application
initialiser();