<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Match Statistics</title>
    <link rel="stylesheet" href="../css/navbar.css?v=1.0">
    <link rel="stylesheet" href="../css/schedule_matches.css?v=1.0">
</head>
<body>
    <?php 
    include 'navbar.php'; 
    include '../actions/admin/add_match_statistics_functions.php';

    if (!$user->getRole()) {
        alertAndRedirect("You are not supposed to be here!", "home.php", "error");
    }
    ?>
    <h1><?php echo htmlspecialchars($match['Team1_Name'] . "  VS " . $match['Team2_Name']); ?></h1>
    <form method="POST" actions="../actions/admin/add_match_statistics_functions.php">
        <h2>Goals</h2>
        <div id="goals_container">
        </div>
        <button type="button" id="add_goal_form">Add Goal</button>

        <h2>Cards</h2>
        <div id="cards_container">
        </div>
        <button type="button" id="add_card_form">Add Card</button>

        <button type="submit" name="add_stats">Save Stats</button>
    </form>

    <script>
        document.getElementById("add_goal_form").addEventListener("click", function() {
            let goalDiv = document.createElement("div");
            goalDiv.classList.add("goal_entry");

            let playerSelect = createPlayerDropdown("goal_player[]");
            let minuteInput = createNumberInput("goal_minute[]", 0, 90);

            let removeButton = createRemoveButton(goalDiv);

            goalDiv.appendChild(playerSelect);
            goalDiv.appendChild(minuteInput);
            goalDiv.appendChild(removeButton);

            document.getElementById("goals_container").appendChild(goalDiv);
        });

        document.getElementById("add_card_form").addEventListener("click", function() {
            let cardDiv = document.createElement("div");
            cardDiv.classList.add("card_entry");
        
            let playerSelect = createPlayerDropdown("card_player[]");
            let cardTypeSelect = createCardTypeDropdown("card_type[]");
            let minuteInput = createNumberInput("card_minute[]", 0, 90);

            let removeButton = createRemoveButton(cardDiv);
        
            cardDiv.appendChild(playerSelect);
            cardDiv.appendChild(cardTypeSelect);
            cardDiv.appendChild(minuteInput);
            cardDiv.appendChild(removeButton);
        
            document.getElementById("cards_container").appendChild(cardDiv);
        });

        function createPlayerDropdown(name) {
            let select = document.createElement("select");
            select.name = name;
            players.forEach(player => {
                let option = document.createElement("option");
                option.value = player.Id;
                option.textContent = player.Name;
                select.appendChild(option);
            });
            return select;
        }

        function createCardTypeDropdown(name) {
            let select = document.createElement("select");
            select.name = name;
        
            let yellowCard = document.createElement("option");
            yellowCard.value = "1";
            yellowCard.textContent = "Yellow Card";
        
            let redCard = document.createElement("option");
            redCard.value = "2";
            redCard.textContent = "Red Card";
        
            select.appendChild(yellowCard);
            select.appendChild(redCard);
        
            return select;
        }

        function createNumberInput(name, min, max) {
            let input = document.createElement("input");
            input.type = "number";
            input.name = name;
            input.min = min;
            input.max = max;
            input.required = true;
            return input;
        }

        function createRemoveButton(parentDiv) {
            let button = document.createElement("button");
            button.type = "button";
            button.textContent = "Remove";
            button.style.marginLeft = "10px";
            button.addEventListener("click", function() {
                parentDiv.remove();
            });
            return button;
        }
    </script>
</body>
</html>