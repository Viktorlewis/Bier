<?php
require '../php/header.php';
?> 
<h1 class = "central">Contact us</h1>


  <div class="row">
       <div class="columnl">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2508.910065531223!2d3.7409011518125532!3d51.03628175275898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c376aa041f98b5%3A0x220ed0842106383a!2sKleine%20Kerkstraat%207%2C%209050%20Gent!5e0!3m2!1sen!2sbe!4v1579102980098!5m2!1sen!2sbe" class="map" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
       </div>
     <div class="columnr">
        <ul class="itsme">
    <li>Bier.punt Gent</li>
    <li>Gebroeders De Smetstraat</li> 
    
    <li><a href="gmail.com" id="mymail">info@bierpunt.be</a></li>
  </ul>
     </div>
  </div>
<form method="POST" action="../php/contactform.php"> 
    <fieldset>
      <legend>Drop us a line!</legend>
      <p>
        <label for="name"></label>
        <input type="text" id="name" name="name" value="Enter your name.">
      </p>
      <p>
        <label for="name"></label>
        <input type="text" id="mail" name="name" value="Enter email address.">
      </p>
      <p>
        <label for="name"></label>
        <input type="text" id="subject" name="name" value="What's up">
      </p>
    </fieldset>
        </form>
<a id="myBtn" href="#top">Back to top</a>

<?php
require '../php/footer.php';
?> 