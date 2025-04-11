document.addEventListener("DOMContentLoaded", function () {
    for (let teamId in teams) {
        const team = teams[teamId];
        const canvas = document.getElementById("formation-" + team['id']);
        const ctx = canvas.getContext("2d");

        const fieldWidth = 400;
        const fieldHeight = 250;

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

        function getFormationPositions(formation) {
            const positions = {
                "4-3-3": [
                    { x: 0.1, y: 0.5 },
                    { x: 0.3, y: 0.2 }, { x: 0.3, y: 0.4 }, { x: 0.3, y: 0.6 }, { x: 0.3, y: 0.8 },
                    { x: 0.5, y: 0.2 }, { x: 0.5, y: 0.5 }, { x: 0.5, y: 0.8 },
                    { x: 0.75, y: 0.3 }, { x: 0.75, y: 0.5 }, { x: 0.75, y: 0.7 }
                ],
                "4-2-3-1": [
                    { x: 0.1, y: 0.5 },
                    { x: 0.25, y: 0.2 }, { x: 0.25, y: 0.4 }, { x: 0.25, y: 0.6 }, { x: 0.25, y: 0.8 },
                    { x: 0.45, y: 0.35 }, { x: 0.45, y: 0.65 },
                    { x: 0.6, y: 0.25 }, { x: 0.6, y: 0.5 },{ x: 0.6, y: 0.75 }, 
                    { x: 0.75, y: 0.5 }
                ],
                "3-4-3": [
                    { x: 0.1, y: 0.5 },
                    { x: 0.3, y: 0.25 }, { x: 0.3, y: 0.5 }, { x: 0.3, y: 0.75 },
                    { x: 0.5, y: 0.2 }, { x: 0.5, y: 0.4 }, { x: 0.5, y: 0.6 }, { x: 0.5, y: 0.8 },
                    { x: 0.7, y: 0.3 }, { x: 0.7, y: 0.5 },{ x: 0.7, y: 0.7 }
                ],
                "4-4-2": [
                    { x: 0.1, y: 0.5 }, 
                    { x: 0.3, y: 0.2 }, { x: 0.3, y: 0.4 }, { x: 0.3, y: 0.6 }, { x: 0.3, y: 0.8 }, 
                    { x: 0.5, y: 0.2 }, { x: 0.5, y: 0.4 }, { x: 0.5, y: 0.6 }, { x: 0.5, y: 0.8 },
                    { x: 0.7, y: 0.3 }, { x: 0.7, y: 0.7 }
                ],
                "3-5-2": [
                    { x: 0.1, y: 0.5 },
                    { x: 0.3, y: 0.3 }, { x: 0.3, y: 0.5 }, { x: 0.3, y: 0.7 },
                    { x: 0.5, y: 0.1 }, { x: 0.5, y: 0.3 }, { x: 0.5, y: 0.5 }, { x: 0.5, y: 0.7 }, { x: 0.5, y: 0.9 },
                    { x: 0.7, y: 0.3 }, { x: 0.7, y: 0.7 }
                ]
            };
        
            return positions[formation] || positions["4-3-3"];
        }
        

        function drawPlayers() {
            const formationPositions = getFormationPositions(team.formation);
            
            team.players.forEach((player, index) => {
                if (index >= formationPositions.length) return;

                const { x, y } = formationPositions[index];

                ctx.beginPath();
                ctx.arc(x * fieldWidth, y * fieldHeight, 10, 0, 2 * Math.PI);
                ctx.fillStyle = "#ffcc00";
                ctx.fill();

                ctx.fillStyle = "#000000";
                ctx.font = "12px Arial";
                ctx.textAlign = "center";
                ctx.fillText(player.name, x , y - 12);
            });
        }

        drawField();
        drawPlayers();
    }
});
