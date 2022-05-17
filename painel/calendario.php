<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='./lib/main.css' rel='stylesheet' />
<script src='./lib/main.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear today',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay'
      },
      initialDate: '<?php echo date("Y-m-d") ?>',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: [
        <?php include 'conexao/conexao.php'; 
          $sql = "SELECT * FROM payment WHERE status = 'Pendente'";
          $busca = mysqli_query($conexao,$sql);

          while ($dados = mysqli_fetch_array($busca)) {
              $status = $dados['status'];
              $data = $dados['dateend'];
              $code = $dados['code'];
          

          ?>
        {


          title: 'Pagamento: <?php echo $status ?> - <?php echo $code ?>',
          color: '#ffa500',
          url: 'project_details.php?code=<?php echo $code ?>',
          start: '<?php echo $data ?>'
        },
      <?php } ?>


      <?php include 'conexao/conexao.php'; 
          $sql = "SELECT * FROM event";
          $busca = mysqli_query($conexao,$sql);

          while ($dados = mysqli_fetch_array($busca)) {
              $titulo = $dados['titulo'];
              $data = $dados['dateevent'];
              $type = $dados['type'];
              $hour = $dados['hour'];
          

          ?>
        {


          title: '<?php echo $titulo ?> - <?php echo $hour?>',
          <?php 
            if($type == 'Atividade') {?>
            color: '#A6341B',
         <?php }  elseif ($type == 'Evento') {?>
           color: '#60371E',
       <?php  } else { ?>

            color: '#3EB595',
    <?php   }    ?>
          
          
          start: '<?php echo $data ?>'
        },
      <?php } ?>



        /*{
          title: 'Long Event',
          start: '2020-09-07',
          end: '2020-09-10'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2020-09-09T16:00:00'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2020-09-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2020-09-11',
          end: '2020-09-13'
        },
        {
          title: 'Meeting',
          start: '2020-09-12T10:30:00',
          end: '2020-09-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2020-09-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2020-09-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2020-09-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2020-09-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2020-09-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2020-09-28'
        } */
      ]
    });

    calendar.render();
  });

</script>
<style>




</style>
</head>
<body>

  <div id='calendar'></div>

</body>
</html>
