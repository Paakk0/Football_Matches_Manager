<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/matches.css?v=1.0">    
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">    
</head>
<body>
    <?php 
    include 'navbar.php'; 
    include '../actions/get_table_data_functions.php';

    $leagues = getLeagues();
    $league = isset($_GET['league']) ? $_GET['league'] : null;
    $team = isset($_GET['team']) ? $_GET['team'] : null;
    $country = isset($_GET['country']) ? $_GET['country'] : null;
    $dateFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : null;
    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;

    $matches = getMatches($league, $team, $country, $dateFilter, $startDate);

    $pastMatches = [];
    $futureMatches = [];

    foreach ($matches as $match) {
        $matchDate = new DateTime($match['match_date']);
        $currentDate = new DateTime();

        if ($matchDate < $currentDate) {
            $pastMatches[] = $match;
        } else {
            $futureMatches[] = $match;
        }
    }
    ?>

    <div class="page-wrapper">
        <h1 class="page-title">Matches</h1>

        <form id="filterForm" class="filter-form">
            <div class="form-group">
                <label for="league">League:</label>
                <select id="league" name="league">
                    <option value="">Select League</option>
                    <?php foreach ($leagues as $leagueName => $teams): ?>
                        <option value="<?= $leagueName ?>" <?= $league == $leagueName ? 'selected' : '' ?>><?= $leagueName ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="team">Team:</label>
                <input type="text" id="team" name="team" value="<?= $team ?>" placeholder="Enter team name">
            </div>

            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?= $country ?>" placeholder="Enter country name">
            </div>

            <div class="form-group">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate" value="<?= $startDate ?>">
            </div>

            <div class="form-group">
                <label for="dateFilter">Date Filter:</label>
                <select id="dateFilter" name="dateFilter">
                    <option value="">Select Date</option>
                    <option value="before" <?= $dateFilter == 'before' ? 'selected' : '' ?>>Before</option>
                    <option value="after" <?= $dateFilter == 'after' ? 'selected' : '' ?>>After</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="filter-btn">Apply Filters</button>
            </div>
        </form>

        <div class="league-card">
            <h2 class="league-name">Upcoming Matches</h2>
            <div class="table-wrapper">
                <table class="league-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Team 1</th>
                            <th>Team 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($futureMatches as $match): ?>
                            <tr>
                                <td><?= $match['match_date'] ?></td>
                                <td><?= $match['team1'] ?> (<?= $match['country1'] ?>)</td>
                                <td><?= $match['team2'] ?> (<?= $match['country2'] ?>)</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="league-card">
            <h2 class="league-name">Past Matches</h2>
            <div class="table-wrapper">
                <table class="league-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Team 1</th>
                            <th>Team 2</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pastMatches as $match): ?>
                            <tr>
                                <td><?= $match['match_date'] ?></td>
                                <td><?= $match['team1'] ?> (<?= $match['country1'] ?>)</td>
                                <td><?= $match['team2'] ?> (<?= $match['country2'] ?>)</td>
                                <td><a href="match_stats.php?id_match=<?= $match['match_id'] ?>" class="btn-details">View Stats</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            let params = $(this).serialize();
            window.location.href = "matches.php?" + params;
        });
    </script>
</body>
</html>
