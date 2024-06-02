<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
	<link href="styles_compte.css" rel="stylesheet" type="text/css"/>
    <title>Mon compte</title>
</head>
<body>
    <div id = header>
  		<h2>Mon compte </h2>
        <img src="logo.png" alt="tout parcourir" height="150" width="150"> 
       

    </div>
    	
 


<div class="header">
    <h1>Agenda</h1>
    <div class="navigation">
        <button id="prev" class="nav-btn">◀︎</button>
        <div id="month-year">
            <span id="month-name">Août</span>
            <span id="year-number" style="font-size:18px">2021</span>
        </div>
        <button id="next" class="nav-btn">▶</button>
    </div>
</div>

<div class="agenda">
    <table id="agenda-table">
        <thead>
            <tr>
                <th></th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
                <th>Dimanche</th>
            </tr>
            <tr id="date-row">
                <!-- Dates seront insérées ici par JavaScript -->
            </tr>
        </thead>
        <tbody id="agenda-body">
            <!-- Les heures de 8h à 20h -->
            <!-- Contenu dynamique généré par JavaScript -->

        </tbody>
    </table>
</div>

<div class="form-container">
    <h2>Ajouter un événement</h2>
    <form id="event-form">
        <label for="event-date">Date (jj/mm/aaaa):</label>
        <input type="date" id="event-date" required><br>
        <label for="event-time">Heure (hh:mm):</label>
        <input type="time" id="event-time" required><br>
        <label for="event-duration">Durée (en heures):</label>
        <input type="number" id="event-duration" required><br>
        <label for="event-description">Description:</label>
        <input type="text" id="event-description" required><br>
        <button type="submit">Ajouter</button>
    </form>
</div>




<script src="java.js"></script>



    <!-- Footer avec navigation -->
    <footer>
        <div>
            <a href="accueil.html">retour à l'accueil</a> | 
        </div>
        <div>
            coordonnées?
        </div>
    </footer>
</body>
</html>
