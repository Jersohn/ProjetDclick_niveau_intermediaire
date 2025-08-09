function appliquerTheme(theme) {
    // Sauvegarde du thème dans localStorage
    localStorage.setItem('theme', theme);
    
    // Application le thème à la page
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
    // Vérification du navigateur 
    if (typeof(Storage) !== "undefined") {
        // Récupération du thème sauvegardé ou utilisatn de 'jour' par défaut
        const theme = localStorage.getItem('theme') || 'jour';
        appliquerTheme(theme);
    } else {
        alert("Votre navigateur ne supporte pas l'API Local Storage");
        document.getElementById('maPage').className = 'jour';
    }
    
    ajouterEcouteursEvenements();
}

// Démarage de l'appli
initialiser();