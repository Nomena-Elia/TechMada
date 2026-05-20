document.addEventListener('DOMContentLoaded', function(){
    const canvas = document.getElementById("congeMois");
    const ctx = canvas.getContext('2d');

    const labels = JSON.parse(document.getElementById("chartLabel"));
    const totals = JSON.parse(document.getElementById("chartTotal"));

    const congeMoisChart = new Chart(ctx, {
        type : 'bar',
        // label = Utils.months({count:12}),
        data : {
            labels : labels,
            datasets : [{
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
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],

                barThickness : 6,
                maxbarThickness : 8
            }],
        }
    });
})