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
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            events: [
                <?php foreach($data as $d) : ?>
                    {
                        title: 'Conge - Statut: <?= $d['statut'] ?>',
                        start: '<?= $d['date_debut'] ?>',
                        end: '<?= $d['date_fin'] ?>'
                    },
                <?php endforeach ?>
            ]
        });
        cal.render();
    });
</script>
<?= $this->endSection() ?>