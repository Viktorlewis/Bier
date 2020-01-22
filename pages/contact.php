<?php
require '../php/header.php';
?>
<!--pagina-->
<div id="contact-page">
  <!--titel-->
  <div class="title">
    <h1>Contact us</h1>
  </div>
 <div class="info">

     <p>
       info@bierpunt.org<br />
       Gebroeders de Smetstraat 1, 9000 Gent
     </p>
   </div>
   <div class="info-map">

  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2507.6089275452596!2d3.7078220513671702!3d51.060308451013974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c371139ada40bb%3A0x8dccd6d33d74f19!2sGebroeders%20de%20Smetstraat%201%2C%209000%20Gent!5e0!3m2!1snl!2sbe!4v1578655805329!5m2!1snl!2sbe"></iframe>
   </div>


<div class="contact-form">
  <h3>Contact us</h3>
  <form method="POST" action="../php/contactform.php">
      <fieldset>


          <label for="name"></label>
          <input type="text" id="name" name="naam" placeholder="Naam">


          <label for="name"></label>
          <input type="text" id="mail" name="mail" placeholder="E-mail">


          <label for="name"></label>
          <textarea  placeholder="Typ uw bericht"></textarea>
      </fieldset>
          </form>
</div>

</div>






<?php
require '../php/footer.php';
?>
