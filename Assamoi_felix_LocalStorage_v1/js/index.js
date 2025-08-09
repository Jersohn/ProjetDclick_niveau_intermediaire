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

function dessinerGraphique() {
    const canvas = document.getElementById('themeCanvas');
    const ctx = canvas.getContext('2d');
    
    // Effacer le canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Couleurs basées sur le thème actuel
    const theme = localStorage.getItem('theme') || 'jour';
    let colors = [];
    
    switch(theme) {
        case 'jour':
            colors = ['#FFC107', '#FF9800', '#FF5722'];
            break;
        case 'nuit':
            colors = ['#673AB7', '#3F51B5', '#2196F3'];
            break;
        case 'nature':
            colors = ['#4CAF50', '#8BC34A', '#CDDC39'];
            break;
        case 'techno':
            colors = ['#2196F3', '#00BCD4', '#009688'];
            break;
    }
    
    // Dessiner un graphique à barres
    const barWidth = 80;
    const startX = 50;
    
    colors.forEach((color, index) => {
        const height = 50 + Math.random() * 100;
        ctx.fillStyle = color;
        ctx.fillRect(startX + (index * (barWidth + 30)), canvas.height - height, barWidth, height);
        
        // Texte
        ctx.fillStyle = '#000';
        ctx.font = '12px Arial';
        ctx.fillText(`Bar ${index+1}`, startX + (index * (barWidth + 30)), canvas.height - height - 10);
    });
    
    // Titre
    ctx.fillStyle = '#000';
    ctx.font = '16px Arial';
    ctx.fillText(`Graphique Thème ${theme}`, 100, 30);
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
     document.getElementById('genererGraphique').addEventListener('click', dessinerGraphique);
    
    // Générer un graphique au chargement
    dessinerGraphique();
    
    ajouterEcouteursEvenements();
}

// Démarage de l'appli
initialiser();