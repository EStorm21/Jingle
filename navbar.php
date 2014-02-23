<?php
?>
<div class="navbar navbar-inverse  navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="display.php"><?php echo $name ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?=echoActiveClassIfRequestMatches("display")?>><a href="display.php">Home</a></li>
            <li <?=echoActiveClassIfRequestMatches("about")?>><a href="about.php">About</a></li>
            <li <?=echoActiveClassIfRequestMatches("sleep")?>><a href="sleep.php">Sleep History</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


