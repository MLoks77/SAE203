<?php 

session_start();

include "../include/navbar.php";
/**include "../include/navbaradmin.php"; mettre le code pour choisir suivant l'ID de l'utilisateur connecté **/
include "../include/PlanningHero.php";
include "../configdb/connexion.php"
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

<!-- Liens calendrier : 
 https://youtu.be/SgynWhEgvlw?si=BkOqTV_Z0es00jkf 
 https://youtube.com/playlist?list=PLulnbIOAgre5M65C5mnKzCAbwER8Va-Ru&si=ROsMlg8xdPjt8vdi
-->

<?php
$reservations = [
    '2025-04-02' => ['student' => '12345', 'motif' => 'Projet X'],
    '2025-04-10' => ['student' => '67890', 'motif' => 'Séance photo'],
    '2025-04-15' => ['student' => '11223', 'motif' => 'Tournage vidéo'],
    '2025-04-16' => ['student' => '33445', 'motif' => 'Réunion'],
    '2025-04-17' => ['student' => '55667', 'motif' => 'Workshop'],
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calendrier de Réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CSS pour cette page, mettez à côté si vous voulez -->

    <style>
        .calendar { table-layout: fixed; }
        .calendar td { height: 80px; cursor: pointer; }
        .reserved { background-color: #ecf0f1; color: black; text-align: center; }
        .weekend { background-color: #bdc3c7; pointer-events: none; }
        .reservation-info { background: #ecf0f1; color: black; padding: 20px; border-radius: 8px; }
        .button {
    box-shadow: 6px 6px 12px rgba(74, 74, 74, 0.5);
    border: 1px solid black;
    background-color: #16425B;
    color: white;
    border-radius: 5px;
    padding: 10px 20px;
    font-family: Arial, Helvetica, sans-serif;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    }

    .button:hover {
       transform: scale(1.05);
    }

    </style>



</head>
<body class="bg-fond">
<section class="extra-space"></section>
<div class="bg-light pt-3">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mt-3">
        <label for="reservationFilter" class="form-label me-2">Réservation</label>
        <select id="reservationFilter" class="form-select w-auto">
            <option>Toutes les réservations</option>
            <option>Réservation de salles</option>
            <option>Réservation de matériels</option>
        </select>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <button class="btn btn-light" id="prevMonth">&lt;</button>
        <h4 id="monthYear"></h4>
        <button class="btn btn-light" id="nextMonth">&gt;</button>
        <section class="extra-space"></section>
        <button class="btn btn-primary" id="todayBtn">Aujourd'hui</button>
    </div>

    <table class="table table-bordered calendar bg-white text-dark">
        <thead>
            <tr>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th class="text-muted">Samedi</th>
                <th class="text-muted">Dimanche</th>
            </tr>
        </thead>
        <tbody id="calendarBody"></tbody>
    </table>

<!--Faire en sorte que toute cette sections apparaisse si on est ID AGENT, faire sois un include sois un truc plus long et compliqué, privilégier le include -->

    <div class="reservation-info mt-4">
        <div class="row mb-2">
            <div class="col-3">Date de réservation :</div>
            <div class="col-9"><input type="text" class="form-control" id="resDate" readonly></div>
        </div>
        <div class="row mb-2">
            <div class="col-3">Réservé par :</div>
            <div class="col-9"><input type="text" class="form-control" id="resBy" readonly></div>
        </div>
        <div class="row mb-2">
            <div class="col-3">Motif :</div>
            <div class="col-9"><textarea class="form-control" id="resReason" rows="3" readonly></textarea></div>
        </div>
        <button class="btn btn-dark mt-2">Installer le PDF</button>
    </div>
    <section class="extra-space"></section>
</div>
<div>
<?php include "../include/footer.php" ?>
<script>
const reservations = <?php echo json_encode($reservations); ?>;
const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
let currentDate = new Date(2025, 3); // Avril 2025

function renderCalendar(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    document.getElementById('monthYear').textContent = `${monthNames[month]} ${year}`;

    const firstDay = new Date(year, month, 1).getDay() || 7;
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const calendarBody = document.getElementById('calendarBody');
    calendarBody.innerHTML = '';

    let row = document.createElement('tr');
    let dayCount = 0;

    for (let i = 1; i < firstDay; i++) {
        row.appendChild(document.createElement('td'));
        dayCount++;
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement('td');
        const dateStr = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

        const dayOfWeek = (dayCount % 7);
        if (dayOfWeek === 5 || dayOfWeek === 6) {
            cell.classList.add('weekend');
            cell.textContent = day;
        } else if (reservations[dateStr]) {
            cell.classList.add('reserved');
            cell.textContent = 'Réservé';
            cell.dataset.date = dateStr;
        } else {
            cell.textContent = day;
            cell.dataset.date = dateStr;
        }

        cell.addEventListener('click', () => {
            if (!cell.dataset.date) return;
            document.getElementById('resDate').value = cell.dataset.date;
            if (reservations[cell.dataset.date]) {
                document.getElementById('resBy').value = reservations[cell.dataset.date].student;
                document.getElementById('resReason').value = reservations[cell.dataset.date].motif;
            } else {
                document.getElementById('resBy').value = '';
                document.getElementById('resReason').value = '';
            }
        });

        row.appendChild(cell);
        dayCount++;

        if (dayCount % 7 === 0) {
            calendarBody.appendChild(row);
            row = document.createElement('tr');
        }
    }

    if (row.children.length > 0) {
        while (row.children.length < 7) {
            row.appendChild(document.createElement('td'));
        }
        calendarBody.appendChild(row);
    }
}

document.getElementById('prevMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});
document.getElementById('nextMonth').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});
document.getElementById('todayBtn').addEventListener('click', () => {
    currentDate = new Date();
    renderCalendar(currentDate);
});

renderCalendar(currentDate);
</script>
    

</body>


</html>