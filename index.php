<?php

include 'db_connect.php';


$hero_query = $conn->query("SELECT * FROM hero LIMIT 1");
if ($hero_query) {
    $my_hero_data = $hero_query->fetch_assoc();
} else {
    $my_hero_data = null;
}

$about_query = $conn->query("SELECT * FROM about LIMIT 1");
if ($about_query) {
    $my_about_data = $about_query->fetch_assoc();
} else {
    $my_about_data = null;
}

$contact_query = $conn->query("SELECT * FROM contact LIMIT 1");
if ($contact_query) {
    $my_contact_data = $contact_query->fetch_assoc();
} else {
    $my_contact_data = null;
}


if ($my_hero_data) {
    $hero_name     = htmlspecialchars($my_hero_data['name']);
    $hero_title    = htmlspecialchars($my_hero_data['title']);
    $hero_location = htmlspecialchars($my_hero_data['location']);
    $hero_image    = htmlspecialchars($my_hero_data['image_url']);
    $hero_linkedin = htmlspecialchars($my_hero_data['linkedin_url']);
} else {
    $hero_name     = 'Portfolio';
    $hero_title    = 'Your Title';
    $hero_location = 'Location';
    $hero_image    = '';
    $hero_linkedin = '#';
}

if ($my_about_data) {
    $about_text = $my_about_data['description'];
} else {
    $about_text = 'No about information available.';
}


if ($my_contact_data) {
    $contact_email    = htmlspecialchars($my_contact_data['email']);
    $contact_phone    = htmlspecialchars($my_contact_data['phone']);
    $contact_li_url   = htmlspecialchars($my_contact_data['linkedin_url']);
    $contact_li_name  = htmlspecialchars($my_contact_data['linkedin_name']);
    $contact_location = htmlspecialchars($my_contact_data['location']);
    $coop_path        = $my_contact_data['coop_letter_path'];
} else {
    $contact_email    = '';
    $contact_phone    = '';
    $contact_li_url   = '#';
    $contact_li_name  = '';
    $contact_location = '';
    $coop_path        = '';
}


$form_message_output = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $form_name    = htmlspecialchars(strip_tags($_POST['name']));
    $form_email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $form_message = htmlspecialchars(strip_tags($_POST['message']));


    if (!filter_var($form_email, FILTER_VALIDATE_EMAIL)) {
        $form_message_output = "<p class='contact-message-error'>Invalid email format.</p>";
    } else {
        $form_message_output = "<p class='contact-message-success'>Thank you, $form_name. Your message has been received!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="dark">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $hero_name ?> | Portfolio</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>


  <nav class="navbar" id="navbar">
    <a href="#hero" class="nav-logo"><?= $hero_name ?></a>

    <div style="display: flex; align-items: center; gap: 1rem;">
      <button id="themeToggle" class="theme-toggle" aria-label="Toggle theme" style="background: none; border: none; cursor: pointer; font-size: 1.2rem; color: var(--clr-text);">
        <i class="fas fa-sun" id="themeIcon"></i>
      </button>
      <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
        <span></span><span></span><span></span>
      </button>
    </div>

    <ul class="nav-links" id="navLinks">
      <li><a href="#hero" class="active">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#experience">Experience</a></li>
      <li><a href="#education">Education</a></li>
      <li><a href="#skills">Skills</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>

  <section class="hero" id="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <div class="profile-img-wrapper">
        <img src="<?= $hero_image ?>" alt="Profile Picture" class="profile-img" id="profileImg" />
      </div>
      <h1 class="hero-name"><?= $hero_name ?></h1>
      <p class="hero-title"><?= $hero_title ?></p>
      <p class="hero-location">
        <i class="fas fa-map-marker-alt"></i> <?= $hero_location ?>
      </p>
      <div class="hero-buttons">
        <a href="<?= $hero_linkedin ?>" target="_blank" class="btn btn-linkedin">
          <i class="fab fa-linkedin"></i> LinkedIn
        </a>
        <a href="#contact" class="btn btn-contact">
          <i class="fas fa-envelope"></i> Contact Me
        </a>
      </div>
    </div>
  </section>


  <section class="section page-section" id="about">
    <div class="container">
      <h2 class="section-title">About Me</h2>
      <div class="section-line"></div>
      <div class="about-card">
        <i class="fas fa-user-graduate about-icon"></i>
        <p class="about-text"><?= $about_text ?></p>
      </div>

      <h3 class="subsection-title" style="margin-top: 3rem; text-align: center;">Recommendations &amp; References</h3>
      <div class="contact-grid" style="margin-top: 2rem;">
        <?php
          
          $rec_query = $conn->query("SELECT * FROM recommendations");
          if ($rec_query && $rec_query->num_rows > 0) {
              while ($rec_row = $rec_query->fetch_assoc()) {
                  $pdf_url   = 'view_pdf.php?file=' . urlencode($rec_row['file_path']);
                  $rec_title = htmlspecialchars($rec_row['title']);
                  $rec_icon  = htmlspecialchars($rec_row['icon']);
                  $rec_color = htmlspecialchars($rec_row['color']);

                  echo '<a href="' . $pdf_url . '" target="_blank" class="contact-card">';
                  echo '<div class="contact-icon"><i class="' . $rec_icon . '" style="color: ' . $rec_color . ';"></i></div>';
                  echo '<span class="contact-label">' . $rec_title . '</span>';
                  echo '<span class="contact-value">View PDF</span>';
                  echo '</a>';
              }
          }
        ?>
      </div>
    </div>
  </section>


  <section class="section page-section" id="experience">
    <div class="container">
      <h2 class="section-title">Experience</h2>
      <div class="section-line"></div>
      <div class="timeline">
        <?php
          $exp_query = $conn->query("SELECT * FROM experience");
          if ($exp_query && $exp_query->num_rows > 0) {
              while ($exp_row = $exp_query->fetch_assoc()) {
                  $exp_period   = htmlspecialchars($exp_row["period"]);
                  $exp_title    = htmlspecialchars($exp_row["job_title"]);
                  $exp_company  = htmlspecialchars($exp_row["company"]);
                  $exp_desc     = $exp_row["description"];

                  echo '<div class="timeline-item">';
                  echo '<div class="timeline-dot"></div>';
                  echo '<div class="timeline-card">';
                  echo '<span class="timeline-date"><i class="far fa-calendar-alt"></i> ' . $exp_period . '</span>';
                  echo '<h3 class="timeline-title">' . $exp_title . '</h3>';
                  echo '<p class="timeline-company"><i class="fas fa-building"></i> ' . $exp_company . '</p>';
                  echo $exp_desc;
                  echo '</div></div>';
              }
          }
        ?>
      </div>
    </div>
  </section>


  <section class="section page-section" id="education">
    <div class="container">
      <h2 class="section-title">Education &amp; Certifications</h2>
      <div class="section-line"></div>
      <?php
          $edu_query = $conn->query("SELECT * FROM education");
          if ($edu_query && $edu_query->num_rows > 0) {
              while ($edu_row = $edu_query->fetch_assoc()) {
                  $edu_degree     = htmlspecialchars($edu_row['degree']);
                  $edu_university = htmlspecialchars($edu_row['university']);
                  $edu_period     = htmlspecialchars($edu_row['period']);
                  $edu_gpa        = htmlspecialchars($edu_row['gpa']);

                  echo '<div class="edu-card">';
                  echo '<i class="fas fa-university edu-icon"></i>';
                  echo '<div class="edu-details" style="width: 100%;">';
                  echo '<h3 class="edu-degree">' . $edu_degree . '</h3>';
                  echo '<p class="edu-university">' . $edu_university . '</p>';
                  echo '<p class="edu-date"><i class="far fa-calendar-alt"></i> ' . $edu_period . '</p>';
                  echo '<div class="gpa-wrapper"><span class="gpa-label">Current GPA: ' . $edu_gpa . '</span></div>';
                  echo '</div></div>';
              }
          }
      ?>

      <h3 class="subsection-title" style="margin-top: 3rem;">Certifications &amp; Courses</h3>
      <div class="courses-grid">
        <?php
          $courses_query = $conn->query("SELECT * FROM courses");
          if ($courses_query && $courses_query->num_rows > 0) {
              while ($course_row = $courses_query->fetch_assoc()) {
                  $course_icon     = htmlspecialchars($course_row['icon']);
                  $course_name     = htmlspecialchars($course_row['name']);
                  $course_provider = htmlspecialchars($course_row['provider']);
                  $course_desc     = $course_row['description'];

                  echo '<div class="course-card">';
                  echo '<i class="' . $course_icon . ' course-icon"></i>';
                  echo '<h4 class="course-name">' . $course_name . '</h4>';
                  echo '<p class="course-provider"><i class="fas fa-certificate"></i> ' . $course_provider . '</p>';
                  echo $course_desc;
                  echo '</div>';
              }
          }
        ?>
      </div>
    </div>
  </section>


  <section class="section page-section" id="skills">
    <div class="container">
      <h2 class="section-title">Skills</h2>
      <div class="section-line"></div>
      <div class="skills-wrapper">

        <div class="skills-group">
          <h3 class="skills-group-title"><i class="fas fa-star"></i> Technical &amp; Personal Skills</h3>
          <div class="skills-tags">
            <?php
              $tech_query = $conn->query("SELECT * FROM skills WHERE type='tech'");
              if ($tech_query && $tech_query->num_rows > 0) {
                  while ($tech_row = $tech_query->fetch_assoc()) {
                      echo '<span class="skill-tag tech">' . htmlspecialchars($tech_row['name']) . '</span>';
                  }
              }
            ?>
          </div>
        </div>

        <div class="skills-group">
          <h3 class="skills-group-title"><i class="fas fa-language"></i> Languages</h3>
          <div class="skills-tags">
            <?php
              $lang_query = $conn->query("SELECT * FROM skills WHERE type='lang'");
              if ($lang_query && $lang_query->num_rows > 0) {
                  while ($lang_row = $lang_query->fetch_assoc()) {
                      echo '<span class="skill-tag lang">' . htmlspecialchars($lang_row['name']) . '</span>';
                  }
              }
            ?>
          </div>
        </div>

      </div>
    </div>
  </section>


  <section class="section page-section" id="contact">
    <div class="container">
      <h2 class="section-title">Contact</h2>
      <div class="section-line"></div>

      <div class="contact-grid">
        <a href="mailto:<?= $contact_email ?>" class="contact-card">
          <div class="contact-icon"><i class="fas fa-envelope"></i></div>
          <span class="contact-label">Email</span>
          <span class="contact-value"><?= $contact_email ?></span>
        </a>
        <a href="tel:<?= $contact_phone ?>" class="contact-card">
          <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
          <span class="contact-label">Phone</span>
          <span class="contact-value"><?= $contact_phone ?></span>
        </a>
        <a href="<?= $contact_li_url ?>" target="_blank" class="contact-card">
          <div class="contact-icon"><i class="fab fa-linkedin-in"></i></div>
          <span class="contact-label">LinkedIn</span>
          <span class="contact-value"><?= $contact_li_name ?></span>
        </a>
        <div class="contact-card">
          <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
          <span class="contact-label">Location</span>
          <span class="contact-value"><?= $contact_location ?></span>
        </div>
      </div>

      <?php if (!empty($coop_path)): ?>
      <h3 class="subsection-title" style="margin-top: 3rem; text-align: center;">Co-op Training Documents</h3>
      <div class="contact-grid" style="margin-top: 2rem;">
        <a href="view_pdf.php?file=<?= urlencode($coop_path) ?>" target="_blank" class="contact-card">
          <div class="contact-icon"><i class="fas fa-file-signature" style="color: #6c63ff;"></i></div>
          <span class="contact-label">Co-op Request Letter</span>
          <span class="contact-value">View PDF</span>
        </a>
      </div>
      <?php endif; ?>

      <h3 class="subsection-title" style="margin-top: 3rem; text-align: center;">Send a Message</h3>
      <div class="contact-form-wrapper">


        <?= $form_message_output ?>

        <form action="#contact" method="post" class="contact-form">
          <div class="contact-form-group">
            <label for="name" class="contact-form-label">Name</label>
            <input type="text" id="name" name="name" required class="contact-form-input">
          </div>
          <div class="contact-form-group">
            <label for="email" class="contact-form-label">Email</label>
            <input type="email" id="email" name="email" required class="contact-form-input">
          </div>
          <div class="contact-form-group">
            <label for="message" class="contact-form-label">Message</label>
            <textarea id="message" name="message" rows="4" required class="contact-form-textarea"></textarea>
          </div>
          <button type="submit" class="btn btn-contact" style="width: 100%; justify-content: center;">Send Message</button>
        </form>
      </div>

    </div>
  </section>

  <footer class="footer">
    <p>© <span id="year"></span> <?= $hero_name ?>. All rights reserved.</p>
  </footer>

  <script src="script.js"></script>

</body>
</html>
