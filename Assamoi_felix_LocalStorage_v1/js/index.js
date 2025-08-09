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

function initialiser() {
    // Vérifier si le navigateur supporte localStorage
    if (typeof(Storage) !== "undefined") {
        // Récupérer le thème sauvegardé ou utiliser 'jour' par défaut
        const theme = localStorage.getItem('theme') || 'jour';
        appliquerTheme(theme);
    } else {
        alert("Votre navigateur ne supporte pas l'API Local Storage");
        document.getElementById('maPage').className = 'jour';
    }
    
    ajouterEcouteursEvenements();
}

// Démarrer l'application
initialiser();