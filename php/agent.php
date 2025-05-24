<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'agent') {
    header('Location: ../index.php');
    exit;
}

include "../include/navbaragent.php";
include "../include/AgentHero.php";
include "../configdb/connexion.php";

// Récupération de toutes les réservations
$sqlreservations = "SELECT r.ID_reservation, 
                           r.Date, 
                           CONCAT(u.Nom, ' ', u.Prenom) AS student, 
                           r.Motif AS motif,
                           r.salle,
                           r.H_debut,
                           r.H_fin,
                           m.Reference AS nom_materiel,
                           m.Type AS type_materiel,
                           m.Etat_global AS etat_materiel
                    FROM reservation r
                    LEFT JOIN utilisateur u ON r.ID_utilisateur = u.ID_utilisateur
                    LEFT JOIN materiel m ON r.materiel = m.ID_materiel
                    ORDER BY r.Date DESC, r.H_debut";

$stmtreservations = $pdo->query($sqlreservations);
$reservations = [];
while ($row = $stmtreservations->fetch(PDO::FETCH_ASSOC)) {
    $reservations[] = [
        'id' => $row['ID_reservation'],
        'date' => $row['Date'],
        'student' => $row['student'],
        'motif' => $row['motif'],
        'salle' => $row['salle'],
        'materiel' => $row['nom_materiel'],
        'type' => $row['type_materiel'],
        'etat' => $row['etat_materiel'],
        'heure_debut' => $row['H_debut'],
        'heure_fin' => $row['H_fin']
    ];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau Agent</title>
    <link rel="stylesheet" href="../css/Admin.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }
    </style>
</head>

<body class="custom text-white">
    <main>
        <div class="container mt-4">
            <div class="filters-container mb-4 bg-white p-4 rounded shadow">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="reservationFilter" class="form-label mb-0 text-dark">Filtrer les réservations :</label>
                    <select id="reservationFilter" class="form-select w-auto">
                        <option value="all">Toutes les réservations</option>
                        <option value="salle">Réservation de salles</option>
                        <option value="materiel">Réservation de matériels</option>
                        <option value="combined">Réservations salle & matériel</option>
                    </select>
                </div>
            </div>

            <div class="reservations-container bg-white p-4 rounded shadow">
                <div id="noReservationMessage" class="alert alert-info d-none" role="alert">
                    Aucune réservation ne correspond aux critères de filtrage.
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="reservationTable">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Réservé par</th>
                                <th scope="col">Type</th>
                                <th scope="col">Détails</th>
                                <th scope="col">Horaires</th>
                                <th scope="col">Motif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $reservation):
                                $dateObj = new DateTime($reservation['date']);
                                $type = '';
                                if ($reservation['salle'] && $reservation['materiel']) {
                                    $type = 'combined';
                                } elseif ($reservation['materiel']) {
                                    $type = 'materiel';
                                } elseif ($reservation['salle']) {
                                    $type = 'salle';
                                }
                            ?>
                                <tr data-date="<?php echo $reservation['date']; ?>"
                                    data-type="<?php echo $type; ?>">
                                    <td class="date-cell"><?php echo $dateObj->format('d/m/Y'); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['student']); ?></td>
                                    <td>
                                        <?php
                                        if ($type === 'combined') {
                                            echo '<span class="badge bg-primary">Salle & Matériel</span>';
                                        } elseif ($type === 'materiel') {
                                            echo '<span class="badge bg-success">Matériel</span>';
                                        } else {
                                            echo '<span class="badge bg-info">Salle</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $details = [];
                                        if ($reservation['salle']) {
                                            $details[] = '<span class="badge bg-light text-dark">Salle ' . htmlspecialchars($reservation['salle']) . '</span>';
                                        }
                                        if ($reservation['materiel']) {
                                            $details[] = '<span class="badge bg-light text-dark">' . htmlspecialchars($reservation['materiel']) . '</span>';
                                        }
                                        echo implode(' + ', $details);
                                        ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark">
                                            <?php echo $reservation['heure_debut'] . ' - ' . $reservation['heure_fin']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($reservation['motif']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination-container d-flex justify-content-between align-items-center mt-3">
                    <div class="pagination-info text-dark">
                        Affichage de <span id="startIndex">1</span> à <span id="endIndex">5</span> sur <span id="totalItems">0</span> réservations
                    </div>
                    <nav aria-label="Navigation des réservations">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <button class="page-link" id="prevPage" aria-label="Page précédente">&laquo;</button>
                            </li>
                            <li class="page-item">
                                <button class="page-link" id="nextPage" aria-label="Page suivante">&raquo;</button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="extra-space"></div>
        </div>
    </main>

    <?php include "../include/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const reservations = <?php echo json_encode($reservations); ?>;
        const itemsPerPage = 5;
        let currentPage = 1;
        let filteredReservations = [];

        function formatDateFr(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('fr-FR', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }

        function filterReservations() {
            const filterValue = document.getElementById('reservationFilter').value;
            const rows = document.querySelectorAll('#reservationTable tbody tr');
            const noReservationMessage = document.getElementById('noReservationMessage');
            filteredReservations = [];

            rows.forEach(row => {
                if (row.dataset.date) {
                    const rowType = row.dataset.type;
                    const dateFr = formatDateFr(row.dataset.date);
                    const dateCell = row.querySelector('.date-cell');
                    dateCell.textContent = dateFr;

                    let shouldShow = false;

                    if (filterValue === 'all') {
                        shouldShow = true;
                    } else {
                        shouldShow = (rowType === filterValue);
                    }

                    if (shouldShow) {
                        filteredReservations.push(row);
                    }
                    row.style.display = 'none';
                }
            });

            if (filteredReservations.length === 0) {
                noReservationMessage.classList.remove('d-none');
                document.getElementById('reservationTable').classList.add('d-none');
                document.querySelector('.pagination-container').classList.add('d-none');
            } else {
                noReservationMessage.classList.add('d-none');
                document.getElementById('reservationTable').classList.remove('d-none');
                document.querySelector('.pagination-container').classList.remove('d-none');
                currentPage = 1;
                displayPage();
            }
        }

        function displayPage() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = Math.min(startIndex + itemsPerPage, filteredReservations.length);

            document.getElementById('startIndex').textContent = filteredReservations.length > 0 ? startIndex + 1 : 0;
            document.getElementById('endIndex').textContent = endIndex;
            document.getElementById('totalItems').textContent = filteredReservations.length;

            filteredReservations.forEach(row => {
                row.style.display = 'none';
            });

            for (let i = startIndex; i < endIndex; i++) {
                if (filteredReservations[i]) {
                    filteredReservations[i].style.display = '';
                }
            }

            const prevButton = document.getElementById('prevPage').parentElement;
            const nextButton = document.getElementById('nextPage').parentElement;

            prevButton.classList.toggle('disabled', currentPage === 1);
            nextButton.classList.toggle('disabled', endIndex >= filteredReservations.length);

            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = endIndex >= filteredReservations.length;
        }

        document.getElementById('reservationFilter').addEventListener('change', filterReservations);
        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                displayPage();
            }
        });
        document.getElementById('nextPage').addEventListener('click', () => {
            if (currentPage * itemsPerPage < filteredReservations.length) {
                currentPage++;
                displayPage();
            }
        });

        // Initialisation
        filterReservations();
    </script>
</body>

</html>