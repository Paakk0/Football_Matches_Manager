document.addEventListener("DOMContentLoaded", function () {
    for (let teamId in teams) {
        const team = teams[teamId];
        const canvas = document.getElementById("footballField" + teamId);
        const ctx = canvas.getContext("2d");

        const fieldWidth = 600;
        const fieldHeight = 400;

        function drawField() {
            ctx.fillStyle = "#2c6e49";
            ctx.fillRect(0, 0, fieldWidth, fieldHeight);

            ctx.fillStyle = "#ffffff";
            ctx.fillRect(0, fieldHeight / 4, 50, fieldHeight / 2);
            ctx.fillRect(fieldWidth - 50, fieldHeight / 4, 50, fieldHeight / 2);

            ctx.beginPath();
            ctx.arc(fieldWidth / 2, fieldHeight / 2, 50, 0, 2 * Math.PI);
            ctx.strokeStyle = "#ffffff";
            ctx.stroke();
        }

        function drawPlayers() {
            team.players.forEach(player => {
                const playerPosition = player.position.toLowerCase();
                let x, y;

                switch (playerPosition) {
                    case 'goalkeeper':
                        x = fieldWidth * 0.1;
                        y = fieldHeight / 2;
                        break;
                    case 'defender':
                        x = fieldWidth * 0.3;
                        y = fieldHeight / 3;
                        break;
                    case 'midfielder':
                        x = fieldWidth / 2;
                        y = fieldHeight / 2;
                        break;
                    case 'forward':
                        x = fieldWidth * 0.7;
                        y = fieldHeight * 0.7;
                        break;
                    default:
                        x = fieldWidth / 2;
                        y = fieldHeight / 2;
                        break;
                }

                ctx.beginPath();
                ctx.arc(x, y, 5, 0, 2 * Math.PI);
                ctx.fill();
            });
        }

        drawField();
        drawPlayers();
    }
});
