document.addEventListener('DOMContentLoaded', function(){ 
    const canvas = document.getElementById("congeMois"); 
    if (!canvas) return; // Sécurité : évite une erreur si le canvas n'existe pas sur la page

    const ctxMois = canvas.getContext('2d'); 
    const labels = JSON.parse(canvas.getAttribute('data-labels') || '[]'); 
    const totals = JSON.parse(canvas.getAttribute('data-values') || '[]'); 

    const congeMoisChart = new Chart(ctxMois, { 
        type : 'bar', 
        data : { 
            labels : labels, 
            datasets : [{ 
                label: 'Nombre de congés',
                data : totals, 
                backgroundColor : [ 
                    'rgba(255, 99, 132, 0.2)', 
                    'rgba(255, 159, 64, 0.2)', 
                    'rgba(255, 205, 86, 0.2)', 
                    'rgba(75, 192, 192, 0.2)', 
                    'rgba(54, 162, 235, 0.2)', 
                    'rgba(153, 102, 255, 0.2)', 
                    'rgba(201, 203, 207, 0.2)' 
                ], 
                borderColor : [ 
                    'rgb(255, 99, 132)', // Optionnel : Bordures plus opaques pour un meilleur rendu
                    'rgb(255, 159, 64)', 
                    'rgb(255, 205, 86)', 
                    'rgb(75, 192, 192)', 
                    'rgb(54, 162, 235)', 
                    'rgb(153, 102, 255)', 
                    'rgb(201, 203, 207)' 
                ], 
                borderWidth: 1
            }], 
        },
        options: {
            responsive: true,
            plugins : {
                legend : {
                    display : true
                }
            },
            scales : {
                y : {
                    beginAtZero : true
                }
            }
        }
    }); 

    const jourCanvas = document.getElementById("congeJour");
    const ctx = jourCanvas.getContext('2d');

    const labelJour = JSON.parse(jourCanvas.getAttribute("data-labels"));
    const dataJour = JSON.parse(jourCanvas.getAttribute("data-values"));

    const congeJourChart = new Chart(ctx, {
        type : "pie",
        data :{
            labels : labelJour,
            datasets : [{
                data : dataJour,
                backgroundColor :[
                    'rgba(255, 99, 132, 0.2)', 
                    'rgba(255, 159, 64, 0.2)', 
                    'rgba(255, 205, 86, 0.2)', 
                    'rgba(75, 192, 192, 0.2)', 
                    'rgba(54, 162, 235, 0.2)', 
                    'rgba(153, 102, 255, 0.2)', 
                    'rgba(201, 203, 207, 0.2)' 
                ],
                borderColor : [
                    'rgb(255, 99, 132)', // Optionnel : Bordures plus opaques pour un meilleur rendu
                    'rgb(255, 159, 64)', 
                    'rgb(255, 205, 86)', 
                    'rgb(75, 192, 192)', 
                    'rgb(54, 162, 235)', 
                    'rgb(153, 102, 255)', 
                    'rgb(201, 203, 207)' 
                ],
                borderWidth : 1
            }]
        },

        options : {
            responsive : true,
            plugins : {
                legend : {
                    display : true
                }
            },
            // scales : {
            //     y : {
            //         beginAtZero : true
            //     }
            // }
        }
    })
});
