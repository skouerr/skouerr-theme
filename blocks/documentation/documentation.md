# Documentation pour le block "documentation"

## Définition du Block (block.json)

Le fichier `block.json` contient les informations de configuration pour le bloc "documentation". Ce fichier définit les paramètres et attributs nécessaires pour que le bloc soit correctement intégré dans l'éditeur Gutenberg. Il référence également d'autres fichiers comme les styles, scripts et templates associés au bloc.

**Description Supplémentaire :** Le fichier `block.json` inclut le titre, la description, les styles de l'éditeur et de la vue, le script, la catégorie, les icônes et les mots-clés du bloc. De plus, il configure l'ACF (Advanced Custom Fields) pour rendre le bloc éditable et spécifie le fichier de template de rendu.

## Contrôleur (documentation.controller.php)

Le fichier `documentation.controller.php` agit comme le contrôleur pour le bloc "documentation". Il est responsable de récupérer les données nécessaires depuis WordPress, telles que le contenu du fichier README, et de les préparer pour être utilisées dans le bloc.

**Données Gérées par le Contrôleur :** Le contrôleur gère les données incluant le contenu du README et sa hiérarchie après analyse HTML. Ces données sont ensuite mises dans un format utile pour être affichées par le template.

**Description Supplémentaire :** Le contrôleur utilise la classe `Parsedown` pour convertir le contenu Markdown en HTML. Il crée également une hiérarchie des titres du fichier README pour la navigation interne du bloc. Les données sont ensuite définies pour le template avec des méthodes de la classe `Skouerr_Block`.

## Template (documentation.template.php)

Le fichier `documentation.template.php` définit la structure HTML du bloc "documentation". Il inclut des éléments clés tels que la navigation et le contenu principal.

**Structure du Template :** Le template comprend une section pour la navigation qui liste les titres et sous-titres du README et une section pour le contenu principal qui affiche le contenu HTML du README.

**Description Supplémentaire :** Ce template utilise les données fournies par le contrôleur pour générer dynamiquement la navigation et le contenu. Il inclut également des scripts et styles externes pour la mise en forme et la coloration syntaxique du code.

## Style (documentation.style.scss)

Le fichier `documentation.style.scss` contient les règles CSS qui définissent l'apparence visuelle du bloc "documentation". Il gère des propriétés de style telles que la largeur, l'affichage flex, et les marges.

**Principales Règles de Style :** Les styles principales incluent la mise en forme de la navigation, les titres, le contenu, et les éléments de code. Une attention particulière est accordée à la réactivité pour différentes tailles d'écran.

**Description Supplémentaire :** Les styles sont conçus pour rendre le bloc réactif et esthétique sur tous les types d'écrans, en veillant à ce que la navigation reste visible sur les grands écran mais soit cachée sur les petits écrans.

## Script (documentation.script.js)

Le fichier `documentation.script.js` contient le code JavaScript qui ajoute des fonctionnalités interactives au bloc "documentation". Par exemple, il gère des événements comme le clic sur les éléments de navigation et la copie de code.

**Fonctionnalités Interactives :** Les fonctionnalités JavaScript incluent la gestion des scrolls pour mettre à jour les éléments de navigation actifs, la manipulation des titres d'éléments de contenu, et la copie de contenu de code dans le presse-papiers avec un retour visuel via des tooltips.

**Description Supplémentaire :** Ce script assure une expérience utilisateur fluide et dynamique, en manipulant les classes actives des éléments de navigation et en utilisant la bibliothèque Highlight.js pour la coloration syntaxique des blocs de code.

----------

Cela conclut la documentation pour le bloc "documentation" dans le thème WordPress.

**Généré par Skouerr Docs Generator (avec OpenAI)***