<?php if (!$loggedIn): ?>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><?php echo __('Robot Box'); ?> </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#about"><?php echo __('About'); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#services"><?php echo __('Services'); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#contact"><?php echo __('Contribute'); ?></a>
        </li>
        <li class="nav-item">
           <?= $this->Html->link(__('SIGN UP'), ['action' => 'add', 'controller' => 'Users'], ['class' => 'nav-link']) ?>
         </li>
        <li class="nav-item">
          <?= $this->Html->link(__('LOGIN'), ['action' => 'login', 'controller' => 'Users'], ['class' => 'nav-link']) ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<header class="masthead text-center text-white d-flex">
  <div class="container my-auto">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <h1 class="text-uppercase">
          <strong><?php echo __('Your Favorite Visualizer For Your Robot'); ?></strong>
        </h1>
        <hr>
      </div>
      <div class="col-lg-8 mx-auto">
        <p class="text-faded mb-5"><?php echo __('Robot Box can help you manage your robots better! Just add your robot and start going, no strings attached!'); ?></p>
        <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about"><?php echo __('Find Out More'); ?></a>
      </div>
    </div>
  </div>
</header>

<section class="bg-primary" id="about">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-heading text-white"><?php echo __('We have got what you need!'); ?></h2>
        <hr class="light my-4">
        <p class="text-faded mb-4"><?php echo __('Robot Box has everything you need to visualize your robots environment in no time! All of the codes on ROS Kinetic Visualizer are open source. No strings attached!'); ?></p>
        <a class="btn btn-light btn-xl js-scroll-trigger" href="#contact"><?php echo __('Develop With Us!'); ?></a>
      </div>
    </div>
  </div>
</section>

<section id="services">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading"><?php echo __('At Your Service'); ?></h2>
        <hr class="my-4">
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 text-center">
        <div class="service-box mt-5 mx-auto">
          <i class="fa fa-4x fa-diamond text-primary mb-3 sr-icons"></i>
          <h3 class="mb-3"><?php echo __('Sturdy Design'); ?></h3>
          <p class="text-muted mb-0"><?php echo __('Commonly used topics and messages are updated regularly so you dont need to add them manually.'); ?></p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <div class="service-box mt-5 mx-auto">
          <i class="fa fa-4x fa-paper-plane text-primary mb-3 sr-icons"></i>
          <h3 class="mb-3"><?php echo __('Flexible and Adaptable'); ?></h3>
          <p class="text-muted mb-0"><?php echo __('You can use commonly used topic and messages as is, or you can make changes, or add new ones!'); ?></p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <div class="service-box mt-5 mx-auto">
          <i class="fa fa-4x fa-newspaper-o text-primary mb-3 sr-icons"></i>
          <h3 class="mb-3"><?php echo __('Up to Date'); ?></h3>
          <p class="text-muted mb-0"><?php echo __('We update dependencies to keep things fresh.'); ?></p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <div class="service-box mt-5 mx-auto">
          <i class="fa fa-4x fa-heart text-primary mb-3 sr-icons"></i>
          <h3 class="mb-3"><?php echo __('Made with Love'); ?></h3>
          <p class="text-muted mb-0"><?php echo __('You have to make things with love these days!'); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="contact">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-heading"><?php echo __('Lets Get In Touch!'); ?></h2>
        <hr class="my-4">
        <p class="mb-5"><?php echo __('Ready to contribute to the project? That is great! Send a pull request on GitHub or send us an email and we will get back to you as soon as possible!'); ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 ml-auto text-center">
        <i class="fa fa-3x fa-github mb-3 sr-contact"></i>
        <p>
          <a href="https://www.github.com/mabdullahsoyturk/ui-for-warehouse-robot"><?php echo __('Robot Box'); ?></a>
        </p>
      </div>
      <div class="col-lg-4 mr-auto text-center">
        <i class="fa fa-envelope-o fa-3x mb-3 sr-contact"></i>
        <p>
          <a href="mailto:contribute@robotbox.com"><?php echo __('contribute@robotbox.com'); ?></a>
        </p>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>