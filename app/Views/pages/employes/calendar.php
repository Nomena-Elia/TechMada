<?= $this->extend('pages/employes/sidebar') ?>

<?= $this->section('css') ?>

    <link rel="stylesheet" href="/assets/css/calendar.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<script src="/assets/js/dist/index.global.min.js"></script>
<div class="main col-8 mx-auto">
    <h2 class="">Mon calendrier de conges</h2>
    <div id="calendar" class=""></div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const calendarEl = document.getElementById('calendar');
        const cal = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'en',

            headerToolbar: {
                left: 'prev,next prevYear,nextYear today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            events: [
                <?php foreach($data as $d) : 
                    $color = "";
                    $textColor = "";
                    switch ($d['statut']) {
                        case 'En attente':
                            $color = "#f5ebd7";
                            $textColor = "#b8750a";
                            break;
                        case 'Refuse':
                            $color = "#fdf0ee";
                            $textColor = "#c0392b";
                            break;
                        case 'Approuve':
                            $color = "#edf7f2";
                            $textColor = "#1e6b3f";
                            break;
                        default:
                            # code...
                            break;
                    }
                    ?>
                    {
                        title: 'Conge - Statut: <?= $d['statut'] ?>',
                        start: '<?= $d['date_debut'] ?>',
                        end: '<?= $d['date_fin'] ?>',
                        color: '<?= $color ?>',
                        textColor: '<?= $textColor ?>'
                    },
                <?php endforeach ?>
            ]
        });
        cal.render();
    });
</script>
<?= $this->endSection() ?>