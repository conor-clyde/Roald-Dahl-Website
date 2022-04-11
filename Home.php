<?=template_header('Home')?>

<?php

// echo $_SESSION['user_Id']; //Prints the logged in users' Customer_ID
if (isset($_SESSION['user_Id']))
{
}
else
{
      //session_destroy();
      //header("Location:logIn.php");
}?>
<div class="home">
      <div id="top-left">
        <img id="logo" src="resources/images/new-logo2.png">
        <hr/>
        <h2>-Novelist, Poet, Screenwriter, Figher Pilot and the worlds No. 1 Storyteller!-</h1>
      </div>

      <div id="top-right">
        <div class="slide-container">
          <img class="Slides" src="resources/images/Slideshow image 1.png" style="width:100%; height: 435px;">
          <img class="Slides" src="resources/images/Slideshow image 2.png" style="width:100%; height: 435px;">
          <img class="Slides" src="resources/images/Slideshow image 3.png" style="width:100%; height: 435px;">

          <!-- slide count -->
            <div style="text-align:center">
                <span class="slide-count" onclick="currentSlide(1)"></span>
                <span class="slide-count" onclick="currentSlide(2)"></span>
                <span class="slide-count" onclick="currentSlide(3)"></span>
                <span class="slide-count" onclick="currentSlide(4)"></span>
            </div>
        </div>
      </div>


    </header>

    <div class="page">
      <br>

      <div id="intro">
        <h1>Page Intro</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>

      <br>

      <div id="main-container">
        <div class="opt-container" id="Signup">
          <h1>Sign Up Now!</h1>
          <h2>Register a new account so you can start shopping!</h2>
        </div>

        <div class="opt-container" id="Store">
          <h1>Store</h1>
          <h2>Shop from a wide range of imaginative stories for that can be enjoyed by all ages!</h2>
        </div>

      </div>

      <div class="main-container">
        <h1>All time Bestsellers</h1>
        <div class="bestseller">
          <img src="resources/images/Matilda.jpg">
          <h2>Matilda</h2>
          <h3>Price: £9.99</h3>
          <button class="cart-add">Add to Cart</button>
        </div>

        <div class="bestseller">
          <img src="resources/images/The witches.jpg">
          <h2>The Witches</h2>
          <h3>Price: £9.99</h3>
          <button class="cart-add">Add to Cart</button>
        </div>

        <div class="bestseller">
          <img src="resources/images/Charlie.jpg">
          <h2>Charlie and the Choclate Factory</h2>
          <h3>Price: £9.99</h3>
          <button class="cart-add">Add to Cart</button>
        </div>

        <div class="bestseller">
          <img src="resources/images/Mrfox.jpg">
          <h2>Fantastic Mr.Fox</h2>
          <h3>Price: £9.99</h3>
          <button class="cart-add">Add to Cart</button>
        </div>

      </div>

      <hr>

      <br>

    </div>


    <div id="bottom-left">
      <h2>About Roald Dahl</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    </div>

    <div id="bottom-right">
      <img src="">

    </div>
  </div>

  <script src="javaTEST.js"></script>
