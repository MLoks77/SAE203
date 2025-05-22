<?php
session_start();
if ($_SESSION['role'] == 'admin') {
    include "../include/navbaradmin.php";
} elseif ($_SESSION['role'] == 'etudiant' || $_SESSION['role'] == 'enseignant') {
    include "../include/navbar.php";
} elseif ($_SESSION['role'] == 'agent') {
    include "../include/navbar.php"; 
} else {
    include "../include/navbar.php"; 
}

include "../include/AdminHero.php";
include "../configdb/connexion.php";

// Suppression de réservation si demandé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_reservation_id'])) {
    $idToDelete = intval($_POST['delete_reservation_id']);
    $stmtDelete = $pdo->prepare("DELETE FROM reservation WHERE ID_reservation = ?");
    $stmtDelete->execute([$idToDelete]);
    // Redirection avec un paramètre GET pour éviter le rechargement infini
    header("Location: " . $_SERVER['PHP_SELF'] . "?deleted=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau Admin</title>
    <link rel="stylesheet" href="../css/Admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

</head>
<body class="custom text-white">
    <ul class="nav nav-pills mb-3 justify-content-center" id="admin-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="planning-tab" data-bs-toggle="pill" data-bs-target="#planning" type="button" role="tab" aria-controls="planning" aria-selected="true">Planning</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="demandes-tab" data-bs-toggle="pill" data-bs-target="#demandes" type="button" role="tab" aria-controls="demandes" aria-selected="false">Demandes</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ajouter-tab" data-bs-toggle="pill" data-bs-target="#ajouter" type="button" role="tab" aria-controls="ajouter" aria-selected="false">Ajouter du matériel</button>
        </li>
    </ul>
    <div class="tab-content" id="admin-tabContent">
        <!-- Tab Planning -->
        <div class="tab-pane fade show active" id="planning" role="tabpanel" aria-labelledby="planning-tab">
            <section class="extra-space"></section>
            <div class="bg-light pt-3">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-4 text-dark">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-light me-2" id="prevMonth" aria-label="Mois précédent">&lt;</button>
                            <h4 id="monthYear" class="mb-0"></h4>
                            <button class="btn btn-light ms-2" id="nextMonth" aria-label="Mois suivant">&gt;</button>
                        </div>
                        <button class="btn btn-dark" id="todayBtn">Aujourd'hui</button>
                    </div>

                    <div class="calendar-container mb-4">
                        <table class="table table-bordered calendar bg-white text-dark" role="grid">
                            <thead>
                                <tr>
                                    <th scope="col">Lundi</th>
                                    <th scope="col">Mardi</th>
                                    <th scope="col">Mercredi</th>
                                    <th scope="col">Jeudi</th>
                                    <th scope="col">Vendredi</th>
                                    <th scope="col" class="text-muted">Samedi</th>
                                    <th scope="col" class="text-muted">Dimanche</th>
                                </tr>
                            </thead>
                            <tbody id="calendarBody"></tbody>
                        </table>
                    </div>

                    <div class="filters-container mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="reservationFilter" class="form-label mb-0">Filtrer les réservations :</label>
                            <select id="reservationFilter" class="form-select w-auto">
                                <option value="all">Toutes les réservations</option>
                                <option value="salle">Réservation de salles</option>
                                <option value="materiel">Réservation de matériels</option>
                                <option value="combined">Réservations salle & matériel</option>
                            </select>
                        </div>
                    </div>

                    <div class="reservations-container">
                        <div id="noReservationMessage" class="alert alert-info d-none" role="alert">
                            Aucune réservation ne correspond aux critères de filtrage pour ce mois.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="reservationTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Réservé par</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Détails</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sqlreservations = "SELECT r.ID_reservation, r.Date, CONCAT(u.Nom, ' ', u.Prenom) AS student, r.Motif AS motif, r.salle, r.H_debut, r.H_fin, m.Reference AS nom_materiel, m.Type AS type_materiel, m.Etat_global AS etat_materiel FROM reservation r LEFT JOIN utilisateur u ON r.ID_utilisateur = u.ID_utilisateur LEFT JOIN materiel m ON r.materiel = m.ID_materiel ORDER BY r.Date, r.H_debut";
                                    $stmtreservations = $pdo->query($sqlreservations);
                                    $reservations = [];
                                    while ($row = $stmtreservations->fetch(PDO::FETCH_ASSOC)) {
                                        $reservations[] = [
                                            'ID_reservation' => $row['ID_reservation'],
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
                                    foreach ($reservations as $reservation):
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
                                    <tr data-date="<?php echo $reservation['date']; ?>" data-type="<?php echo $type; ?>">
                                        <td class="date-cell"><?php echo $dateObj->format('d/m/Y'); ?></td>
                                        <td><?php echo htmlspecialchars($reservation['student']); ?></td>
                                        <td><?php
                                            if ($type === 'combined') {
                                                echo 'Salle & Matériel';
                                            } elseif ($type === 'materiel') {
                                                echo 'Matériel';
                                            } else {
                                                echo 'Salle';
                                            }
                                        ?></td>
                                        <td><?php
                                            $details = [];
                                            if ($reservation['salle']) {
                                                $details[] = 'Salle ' . htmlspecialchars($reservation['salle']);
                                            }
                                            if ($reservation['materiel']) {
                                                $details[] = htmlspecialchars($reservation['materiel']);
                                            }
                                            echo implode(' + ', $details);
                                        ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $reservation['ID_reservation']; ?>">
                                                Supprimer
                                            </button>
                                            <!-- Modal de confirmation -->
                                            <div class="modal fade" id="deleteModal<?php echo $reservation['ID_reservation']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $reservation['ID_reservation']; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark" id="deleteModalLabel<?php echo $reservation['ID_reservation']; ?>">Confirmer la suppression</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                        </div>
                                                        <div class="modal-body text-dark">
                                                            Êtes-vous sûr de vouloir supprimer cette réservation ? Cette action est irréversible.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            <form method="post" style="display:inline;">
                                                                <input type="hidden" name="delete_reservation_id" value="<?php echo $reservation['ID_reservation']; ?>">
                                                                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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
                                        <button class="page-link text-dark" id="prevPage" aria-label="Page précédente">&laquo;</button>
                                    </li>
                                    <li class="page-item">
                                        <button class="page-link text-dark" id="nextPage" aria-label="Page suivante">&raquo;</button>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'agent'): ?>
                    <div class="reservation-info mt-5">
                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="selectedDate" class="form-label text-dark mb-0">Date sélectionnée :</label>
                            </div>
                            
                            <div class="col-9">
                                <input type="text" class="form-control" id="selectedDate" readonly>
                                <section class="extra-space"></section>
                            </div>
                        </div>
                        <div id="reservationDetails" class="mt-3">
                            <!-- Les détails des réservations seront injectés ici -->
                        </div>
                    </div>
                    <?php endif; ?>
                    <section class="extra-space"></section>
                </div>
            </div>
            <script>
            const reservations = <?php echo json_encode($reservations); ?>;
            const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            let currentDate = new Date();
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
                const currentMonth = currentDate.getMonth();
                const currentYear = currentDate.getFullYear();
                
                const rows = document.querySelectorAll('#reservationTable tbody tr');
                const noReservationMessage = document.getElementById('noReservationMessage');
                filteredReservations = [];
                
                rows.forEach(row => {
                    if (row.dataset.date) {
                        const rowDate = new Date(row.dataset.date);
                        const isCurrentMonth = rowDate.getMonth() === currentMonth && rowDate.getFullYear() === currentYear;
                        const rowType = row.dataset.type;
                        
                        const dateFr = formatDateFr(row.dataset.date);
                        const dateCell = row.querySelector('.date-cell');
                        dateCell.textContent = dateFr;
                        
                        let shouldShow = false;
                        
                        if (isCurrentMonth) {
                            if (filterValue === 'all') {
                                shouldShow = true;
                            } else {
                                shouldShow = (rowType === filterValue);
                            }
                        }
                        
                        if (shouldShow) {
                            filteredReservations.push(row);
                        }
                        row.style.display = 'none'; // Cacher toutes les lignes initialement
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
                
                // Mettre à jour les informations de pagination
                document.getElementById('startIndex').textContent = filteredReservations.length > 0 ? startIndex + 1 : 0;
                document.getElementById('endIndex').textContent = endIndex;
                document.getElementById('totalItems').textContent = filteredReservations.length;
                
                // Cacher toutes les lignes
                filteredReservations.forEach(row => {
                    row.style.display = 'none';
                });
                
                // Afficher les lignes de la page courante
                for (let i = startIndex; i < endIndex; i++) {
                    if (filteredReservations[i]) {
                        filteredReservations[i].style.display = '';
                    }
                }
                
                // Mettre à jour l'état des boutons de pagination
                const prevButton = document.getElementById('prevPage').parentElement;
                const nextButton = document.getElementById('nextPage').parentElement;
                
                prevButton.classList.toggle('disabled', currentPage === 1);
                nextButton.classList.toggle('disabled', endIndex >= filteredReservations.length);
                
                // Désactiver les boutons si nécessaire
                document.getElementById('prevPage').disabled = currentPage === 1;
                document.getElementById('nextPage').disabled = endIndex >= filteredReservations.length;
            }

            function showReservationsModal(reservations) {
                const detailsContainer = document.getElementById('reservationDetails');
                detailsContainer.innerHTML = '';

                if (reservations.length === 0) {
                    detailsContainer.innerHTML = '<div class="alert alert-info">Aucune réservation pour cette date</div>';
                    return;
                }

                reservations.forEach((reservation, index) => {
                    const card = document.createElement('div');
                    card.className = 'card mb-3';
                    
                    let typeReservation = '';
                    if (reservation.salle && reservation.materiel) {
                        typeReservation = 'Salle & Matériel';
                    } else if (reservation.materiel) {
                        typeReservation = 'Matériel';
                    } else if (reservation.salle) {
                        typeReservation = 'Salle';
                    }
                    
                    card.innerHTML = `
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title mb-0">Réservation ${index + 1} - ${typeReservation}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-4"><strong>Réservé par :</strong></div>
                                <div class="col-8">${reservation.student || '-'}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>Horaires :</strong></div>
                                <div class="col-8">
                                    <span class="badge bg-dark">
                                        ${reservation.heure_debut || '00:00'} - ${reservation.heure_fin || '00:00'}
                                    </span>
                                </div>
                            </div>
                            ${reservation.salle ? `
                            <div class="row mb-2">
                                <div class="col-4"><strong>Salle :</strong></div>
                                <div class="col-8">
                                    <span class="badge bg-primary">Salle ${reservation.salle}</span>
                                </div>
                            </div>
                            ` : ''}
                            ${reservation.materiel ? `
                            <div class="row mb-2">
                                <div class="col-4"><strong>Matériel :</strong></div>
                                <div class="col-8">
                                    <span class="badge bg-info">${reservation.materiel}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>Type :</strong></div>
                                <div class="col-8">
                                    <span class="badge bg-secondary">${reservation.type || '-'}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4"><strong>État :</strong></div>
                                <div class="col-8">
                                    <span class="badge ${getBadgeClass(reservation.etat)}">${reservation.etat || '-'}</span>
                                </div>
                            </div>
                            ` : ''}
                            <div class="row mb-2">
                                <div class="col-4"><strong>Motif :</strong></div>
                                <div class="col-8">
                                    <div class="alert alert-light border">
                                        ${reservation.motif || '-'}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="extra-space"></section>
                    `;
                    
                    detailsContainer.appendChild(card);
                });
            }

            function getBadgeClass(etat) {
                switch(etat?.toLowerCase()) {
                    case 'neuf':
                        return 'bg-success';
                    case 'excellent':
                        return 'bg-info';
                    case 'super':
                        return 'bg-primary';
                    case 'bon':
                        return 'bg-warning';
                    case 'mauvais':
                        return 'bg-danger';
                    default:
                        return 'bg-secondary';
                }
            }

            function renderCalendar(date) {
                const year = date.getFullYear();
                const month = date.getMonth();
                document.getElementById('monthYear').textContent = `${monthNames[month]} ${year}`;

                const currentMonthReservations = reservations.filter(res => {
                    const resDate = new Date(res.date);
                    return resDate.getMonth() === month && resDate.getFullYear() === year;
                });

                const firstDay = new Date(year, month, 1).getDay() || 7;
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                const calendarBody = document.getElementById('calendarBody');
                calendarBody.innerHTML = '';

                let row = document.createElement('tr');
                let dayCount = 0;

                for (let i = 1; i < firstDay; i++) {
                    const cell = document.createElement('td');
                    cell.classList.add('bg-light');
                    row.appendChild(cell);
                    dayCount++;
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const cell = document.createElement('td');
                    const dateStr = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                    
                    cell.innerHTML = `<div class="day-number">${day}</div>`;
                    
                    const dayReservations = currentMonthReservations.filter(res => res.date === dateStr);

                    const dayOfWeek = (dayCount % 7);
                    
                    if (dayOfWeek === 5 || dayOfWeek === 6) {
                        cell.classList.add('weekend');
                    } else if (dayReservations.length > 0) {
                        cell.classList.add('has-reservations');
                        cell.dataset.date = dateStr;
                        
                        const reservationCount = document.createElement('div');
                        reservationCount.className = 'reservation-count';
                        reservationCount.textContent = `${dayReservations.length} réservation(s)`;
                        cell.appendChild(reservationCount);

                        const reservationsList = document.createElement('div');
                        reservationsList.className = 'reservations-list d-none';
                        dayReservations.forEach(res => {
                            const resItem = document.createElement('div');
                            resItem.className = 'reservation-item';
                            
                            if (res.salle) {
                                const salleSpan = document.createElement('span');
                                salleSpan.textContent = `Salle ${res.salle}`;
                                resItem.appendChild(salleSpan);
                            }
                            
                            if (res.materiel) {
                                const materielSpan = document.createElement('span');
                                materielSpan.textContent = res.materiel;
                                resItem.appendChild(materielSpan);
                            }
                            
                            if (res.heure_debut && res.heure_fin) {
                                const horaireSpan = document.createElement('span');
                                horaireSpan.textContent = `${res.heure_debut} - ${res.heure_fin}`;
                                resItem.appendChild(horaireSpan);
                            }
                            
                            reservationsList.appendChild(resItem);
                        });
                        cell.appendChild(reservationsList);

                        cell.dataset.reservations = JSON.stringify(dayReservations);
                    }

                    cell.addEventListener('click', () => {
                        if (cell.classList.contains('weekend')) return;
                        
                        if (cell.dataset.reservations) {
                            const dayReservations = JSON.parse(cell.dataset.reservations);
                            document.getElementById('selectedDate').value = formatDateFr(dateStr);
                            showReservationsModal(dayReservations);
                        } else {
                            document.getElementById('selectedDate').value = formatDateFr(dateStr);
                            document.getElementById('reservationDetails').innerHTML = '<div class="alert alert-info">Aucune réservation pour cette date</div>';
                        }
                    });

                    cell.addEventListener('mouseenter', () => {
                        const list = cell.querySelector('.reservations-list');
                        if (list) list.classList.remove('d-none');
                    });

                    cell.addEventListener('mouseleave', () => {
                        const list = cell.querySelector('.reservations-list');
                        if (list) list.classList.add('d-none');
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
                        const cell = document.createElement('td');
                        cell.classList.add('bg-light');
                        row.appendChild(cell);
                    }
                    calendarBody.appendChild(row);
                }

                filterReservations();
            }

            document.getElementById('reservationFilter').addEventListener('change', filterReservations);

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

            // Ajouter les événements pour la pagination
            document.getElementById('prevPage').addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    displayPage();
                }
            });

            document.getElementById('nextPage').addEventListener('click', () => {
                const maxPage = Math.ceil(filteredReservations.length / itemsPerPage);
                if (currentPage < maxPage) {
                    currentPage++;
                    displayPage();
                }
            });

            renderCalendar(currentDate);

            document.addEventListener('DOMContentLoaded', () => {
                filterReservations();
            });
            </script>
        </div>
        <!-- Tab Demandes -->
        <div class="tab-pane fade" id="demandes" role="tabpanel" aria-labelledby="demandes-tab">
            <!-- Contenu à venir -->
        </div>
        <!-- Tab Ajouter du matériel -->
        <div class="tab-pane fade" id="ajouter" role="tabpanel" aria-labelledby="ajouter-tab">
            <!-- Contenu à venir -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>
<?php include "../include/footer.php"; ?>