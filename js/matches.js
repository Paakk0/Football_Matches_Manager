document.addEventListener("DOMContentLoaded", () => {
    const teamFilter = document.getElementById("teamFilter");
    const countryFilter = document.getElementById("countryFilter");
    const dateFilter = document.getElementById("dateFilter");
    const dateFilterOption = document.getElementById("dateFilterOption");

    function filterTable() {
        const teamValue = teamFilter.value.toLowerCase();
        const countryValue = countryFilter.value.toLowerCase();
        const dateValue = dateFilter.value;
        const dateOptionValue = dateFilterOption.value;

        document.querySelectorAll("#futureMatches .league-table tbody tr").forEach((row) => {
            const team1 = row.getAttribute("data-team1").toLowerCase();
            const team2 = row.getAttribute("data-team2").toLowerCase();
            const country1 = row.getAttribute("data-country1").toLowerCase();
            const country2 = row.getAttribute("data-country2").toLowerCase();
            const matchDate = row.querySelector("td:nth-child(1)").textContent.trim();

            const matchDateFormatted = new Date(matchDate).toISOString().split('T')[0];

            const matchesTeam = team1.includes(teamValue) || team2.includes(teamValue);
            const matchesCountry = country1.includes(countryValue) || country2.includes(countryValue);

            let matchesDate = false;
            if (dateValue !== "") {
                switch (dateOptionValue) {
                    case "before":
                        matchesDate = matchDateFormatted < dateValue;
                        break;
                    case "after":
                        matchesDate = matchDateFormatted > dateValue;
                        break;
                    case "exact":
                    default:
                        matchesDate = matchDateFormatted === dateValue;
                        break;
                }
            } else {
                matchesDate = true;
            }

            const visible = matchesTeam && matchesCountry && matchesDate;
            row.style.display = visible ? "" : "none";
        });

        document.querySelectorAll("#pastMatches .league-table tbody tr").forEach((row) => {
            const team1 = row.getAttribute("data-team1").toLowerCase();
            const team2 = row.getAttribute("data-team2").toLowerCase();
            const country1 = row.getAttribute("data-country1").toLowerCase();
            const country2 = row.getAttribute("data-country2").toLowerCase();
            const matchDate = row.querySelector("td:nth-child(1)").textContent.trim();

            const matchDateFormatted = new Date(matchDate).toISOString().split('T')[0];

            const matchesTeam = team1.includes(teamValue) || team2.includes(teamValue);
            const matchesCountry = country1.includes(countryValue) || country2.includes(countryValue);

            let matchesDate = false;
            if (dateValue !== "") {
                switch (dateOptionValue) {
                    case "before":
                        matchesDate = matchDateFormatted < dateValue;
                        break;
                    case "after":
                        matchesDate = matchDateFormatted > dateValue;
                        break;
                    case "exact":
                    default:
                        matchesDate = matchDateFormatted === dateValue;
                        break;
                }
            } else {
                matchesDate = true;
            }

            const visible = matchesTeam && matchesCountry && matchesDate;
            row.style.display = visible ? "" : "none";
        });
    }

    teamFilter.addEventListener("input", filterTable);
    countryFilter.addEventListener("change", filterTable);
    dateFilter.addEventListener("change", filterTable);
    dateFilterOption.addEventListener("change", filterTable);
});
